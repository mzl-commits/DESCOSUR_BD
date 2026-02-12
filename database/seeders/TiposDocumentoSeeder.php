<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $tipos = [
            'Informe',
            'Acta',
            'Convenio',
            'Evidencia Fotográfica',
            'Plan de Trabajo',
            'Presupuesto',
            'Comprobante',
            'Cronograma',
            'Lista de Asistencia',
            'Ficha de Beneficiario',
            'Reporte de Campo',
            'Otro',
        ];

        $rows = array_map(fn ($t) => [
            'nombre' => $t,
            'created_at' => $now,
            'updated_at' => $now,
        ], $tipos);

        DB::table('tipos_documento')->upsert($rows, ['nombre'], ['updated_at']);
    }
}
