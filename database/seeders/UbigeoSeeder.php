<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SplFileObject;

class UbigeoSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();

        $path = database_path('seeders/data/ubigeo_pe.csv');

        if (!file_exists($path)) {
            $this->command?->error("No existe el archivo: {$path}");
            return;
        }

        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        // Leer headers
        $headers = null;

        // Dedupe por código
        $departamentos = []; // [ "04" => "Arequipa" ]
        $provincias = [];    // [ "0401" => ["dep"=>"04","nombre"=>"Arequipa"] ]
        $distritos = [];     // [ "040101" => ["prov"=>"0401","nombre"=>"Arequipa"] ]

        foreach ($file as $row) {
            if ($row === [null] || $row === false) continue;

            // Primera fila = headers
            if ($headers === null) {
                $headers = array_map(fn ($h) => trim(mb_strtolower((string)$h)), $row);
                continue;
            }

            // Mapear fila por header
            $data = [];
            foreach ($headers as $i => $key) {
                $data[$key] = isset($row[$i]) ? trim((string)$row[$i]) : null;
            }

            $ubigeo = $data['ubigeo'] ?? null;
            $depName = $data['departamento'] ?? null;
            $provName = $data['provincia'] ?? null;
            $distName = $data['distrito'] ?? null;

            if (!$ubigeo || strlen($ubigeo) !== 6) continue;
            if (!$depName || !$provName || !$distName) continue;

            $depCode  = substr($ubigeo, 0, 2);
            $provCode = substr($ubigeo, 0, 4);
            $distCode = $ubigeo;

            $departamentos[$depCode] = $depName;

            if (!isset($provincias[$provCode])) {
                $provincias[$provCode] = [
                    'dep' => $depCode,
                    'nombre' => $provName,
                ];
            }

            if (!isset($distritos[$distCode])) {
                $distritos[$distCode] = [
                    'prov' => $provCode,
                    'nombre' => $distName,
                ];
            }
        }

        $now = now();

        // 1) Insert/Upsert Departamentos
        $depRows = [];
        foreach ($departamentos as $codigo => $nombre) {
            $depRows[] = [
                'codigo' => $codigo,
                'nombre' => $nombre,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($depRows, 1000) as $chunk) {
            DB::table('departamentos')->upsert($chunk, ['codigo'], ['nombre', 'updated_at']);
        }

        $depIdByCode = DB::table('departamentos')->pluck('id', 'codigo'); // [codigo => id]

        // 2) Insert/Upsert Provincias
        $provRows = [];
        foreach ($provincias as $codigo => $info) {
            $depId = $depIdByCode[$info['dep']] ?? null;
            if (!$depId) continue;

            $provRows[] = [
                'departamento_id' => $depId,
                'codigo' => $codigo,
                'nombre' => $info['nombre'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($provRows, 2000) as $chunk) {
            DB::table('provincias')->upsert(
                $chunk,
                ['codigo'],
                ['departamento_id', 'nombre', 'updated_at']
            );
        }

        $provIdByCode = DB::table('provincias')->pluck('id', 'codigo');

        // 3) Insert/Upsert Distritos
        $distRows = [];
        foreach ($distritos as $codigo => $info) {
            $provId = $provIdByCode[$info['prov']] ?? null;
            if (!$provId) continue;

            $distRows[] = [
                'provincia_id' => $provId,
                'codigo' => $codigo,
                'nombre' => $info['nombre'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($distRows, 3000) as $chunk) {
            DB::table('distritos')->upsert(
                $chunk,
                ['codigo'],
                ['provincia_id', 'nombre', 'updated_at']
            );
        }

        $this->command?->info("UBIGEO cargado: "
            .count($departamentos)." departamentos, "
            .count($provincias)." provincias, "
            .count($distritos)." distritos."
        );
    }
}
