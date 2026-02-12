<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectoresSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $sectores = [
            ['nombre' => 'Educación', 'descripcion' => 'Programas de formación, tutorías y fortalecimiento escolar.'],
            ['nombre' => 'Salud', 'descripcion' => 'Campañas, prevención, intervención comunitaria y atención.'],
            ['nombre' => 'Medio Ambiente', 'descripcion' => 'Conservación, limpieza, sensibilización y proyectos verdes.'],
            ['nombre' => 'Desarrollo Social', 'descripcion' => 'Inclusión, bienestar, apoyo a familias y comunidades.'],
            ['nombre' => 'Emprendimiento', 'descripcion' => 'Capacitación productiva y fortalecimiento económico local.'],
            ['nombre' => 'Gestión Institucional', 'descripcion' => 'Administración, alianzas, legal, finanzas y logística.'],
        ];

        $rows = array_map(fn ($s) => [
            'nombre' => $s['nombre'],
            'descripcion' => $s['descripcion'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $sectores);

        DB::table('sectores')->upsert($rows, ['nombre'], ['descripcion', 'updated_at']);
    }
}
