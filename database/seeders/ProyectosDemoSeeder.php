<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosDemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Mapeo sector por nombre → id
        $sectorId = DB::table('sectores')->pluck('id', 'nombre');

        // Distritos (por UBIGEO 6 dígitos) para demo nacional
        // Asegúrate que estos códigos existan en tu CSV UBIGEO.
        $ubigeosDemo = [
            '150101', // Lima - Lima - Lima
            '040101', // Arequipa - Arequipa - Arequipa
            '080101', // Cusco - Cusco - Cusco
            '130101', // La Libertad - Trujillo - Trujillo
            '200101', // Piura - Piura - Piura
            '230101', // Tacna - Tacna - Tacna
            '010101', // Amazonas - Chachapoyas - Chachapoyas
        ];

        $distritoIdByCodigo = DB::table('distritos')->whereIn('codigo', $ubigeosDemo)->pluck('id', 'codigo');

        $proyectos = [
            [
                'sector' => 'Educación',
                'codigo' => 'EDU-001',
                'nombre' => 'Refuerzo Escolar Comunitario',
                'descripcion' => 'Acompañamiento académico y tutorías para escolares.',
                'ubigeo' => '040101',
            ],
            [
                'sector' => 'Salud',
                'codigo' => 'SAL-001',
                'nombre' => 'Campañas Preventivas de Salud',
                'descripcion' => 'Jornadas de prevención, charlas y tamizaje.',
                'ubigeo' => '150101',
            ],
            [
                'sector' => 'Medio Ambiente',
                'codigo' => 'MA-001',
                'nombre' => 'Reciclaje y Educación Ambiental',
                'descripcion' => 'Gestión de residuos y sensibilización ciudadana.',
                'ubigeo' => '080101',
            ],
            [
                'sector' => 'Desarrollo Social',
                'codigo' => 'DS-001',
                'nombre' => 'Soporte a Familias Vulnerables',
                'descripcion' => 'Acompañamiento social y articulación con servicios.',
                'ubigeo' => '200101',
            ],
            [
                'sector' => 'Emprendimiento',
                'codigo' => 'EMP-001',
                'nombre' => 'Capacitación Productiva Local',
                'descripcion' => 'Talleres para fortalecer habilidades y empleabilidad.',
                'ubigeo' => '130101',
            ],
            [
                'sector' => 'Gestión Institucional',
                'codigo' => 'GI-001',
                'nombre' => 'Alianzas y Convenios Interinstitucionales',
                'descripcion' => 'Gestión de convenios con municipalidades e instituciones.',
                'ubigeo' => '230101',
            ],
        ];

        $rows = [];

        foreach ($proyectos as $p) {
            $sid = $sectorId[$p['sector']] ?? null;
            $did = $distritoIdByCodigo[$p['ubigeo']] ?? null;

            // Si falta UBIGEO, no insertamos ese demo
            if (!$sid || !$did) continue;

            $rows[] = [
                'sector_id' => $sid,
                'distrito_id' => $did,
                'nombre' => $p['nombre'],
                'codigo' => $p['codigo'],
                'estado' => 'ACTIVO',
                'descripcion' => $p['descripcion'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Para evitar duplicados: unique(sector_id, nombre) ya existe
        // upsert por sector_id + nombre (clave compuesta) no es soportado directo con upsert,
        // así que hacemos insertOrIgnore y luego update por codigo si deseas.
        // En MVP: insertOrIgnore es suficiente.
        DB::table('proyectos')->insertOrIgnore($rows);
    }
}
