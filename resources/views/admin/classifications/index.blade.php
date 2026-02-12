@extends('layouts.admin')

@section('title', 'Clasificaciones (Tipos y Etiquetas)')
@section('page_title', 'Clasificaciones')

@push('head')
<style>
  .font-display{ font-family: Manrope, sans-serif; }

  /* (Opcional) si quieres un fondo suave en la parte superior */
  .bg-soft-top {
    background: linear-gradient(to bottom, rgba(239, 37, 60, .08), transparent);
  }
</style>
@endpush

@section('content')
@php
  $types = [
    ['name'=>'Informe Anual',         'status'=>'Activo',  'meta'=>'Creado 10 Ene, 2024 • Predeterminado del sistema', 'deletable'=>false],
    ['name'=>'Estado Financiero',     'status'=>'Activo',  'meta'=>'Creado 14 Feb, 2024 • Restringido',                 'deletable'=>true],
    ['name'=>'Encuesta de Campo',     'status'=>'Activo',  'meta'=>'Creado 22 Mar, 2024',                               'deletable'=>true],
    ['name'=>'Propuesta de Proyecto', 'status'=>'Borrador','meta'=>'Creado 05 Jun, 2024',                               'deletable'=>true],
    ['name'=>'Acta de Reunión',       'status'=>'Activo',  'meta'=>'Creado 12 Ago, 2024',                               'deletable'=>true],
  ];

  $tags = [
    ['name'=>'Educación',              'category'=>'Área de Programa',     'usage'=>'234 docs', 'dot'=>'bg-blue-500'],
    ['name'=>'Región Cusco',           'category'=>'Ubicación',            'usage'=>'156 docs', 'dot'=>'bg-purple-500'],
    ['name'=>'Iniciativas de Salud',   'category'=>'Área de Programa',     'usage'=>'98 docs',  'dot'=>'bg-green-500'],
    ['name'=>'T3-2023',                'category'=>'Periodo de Reporte',   'usage'=>'45 docs',  'dot'=>'bg-orange-500'],
    ['name'=>'Urubamba',               'category'=>'Ubicación',            'usage'=>'32 docs',  'dot'=>'bg-indigo-500'],
    ['name'=>'Medio Ambiente',         'category'=>'Área de Programa',     'usage'=>'12 docs',  'dot'=>'bg-teal-500'],
  ];
@endphp

<div class="font-display p-4 lg:p-8 relative">
  <div class="absolute inset-x-0 top-0 h-64 -z-10 bg-soft-top pointer-events-none"></div>

  {{-- Breadcrumb + encabezado --}}
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
      <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
        <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="material-icons text-xs">chevron_right</span>
        <span class="text-slate-900 dark:text-white font-medium">Clasificaciones</span>
      </div>

      <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
        Clasificaciones (Tipos y Etiquetas)
      </h1>
      <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 max-w-3xl">
        Administra los tipos de documentos y las etiquetas (tags) para organizar, filtrar y auditar el conocimiento institucional.
      </p>
    </div>

    <div class="flex gap-3">
      <a
        href="{{ route('admin.audit.index') }}"
        class="inline-flex items-center rounded-lg bg-white dark:bg-neutral-surface-dark px-3 py-2 text-sm font-semibold text-slate-900 dark:text-slate-100 shadow-sm border border-slate-200 dark:border-red-900/20 hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors"
      >
        <span class="material-icons text-sm mr-2 text-slate-400">history</span>
        Ver auditoría
      </a>
    </div>
  </div>

  {{-- Grid principal --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- Izquierda: Tipos --}}
    <div class="lg:col-span-5 flex flex-col gap-6">
      <div class="bg-white dark:bg-neutral-surface-dark shadow-sm border border-slate-200 dark:border-red-900/20 rounded-xl overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-red-900/20 flex justify-between items-center bg-slate-50/50 dark:bg-red-900/10">
          <div>
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Tipos de documento</h3>
            <p class="text-xs text-slate-500 mt-1">Categorías base para tus archivos.</p>
          </div>

          <button
            class="rounded-lg bg-primary px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-primary-dark transition-colors flex items-center"
            type="button"
          >
            <span class="material-icons text-sm mr-1">add</span>
            Nuevo tipo
          </button>
        </div>

        <div class="px-6 py-3 border-b border-slate-100 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark">
          <div class="relative rounded-md">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="material-icons text-slate-400 text-sm">search</span>
            </div>
            <input
              class="block w-full rounded-lg border border-slate-200 dark:border-red-900/20 py-2 pl-10 pr-3 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/40 sm:text-sm"
              placeholder="Filtrar tipos..."
              type="text"
            />
          </div>
        </div>

        <ul class="divide-y divide-slate-100 dark:divide-red-900/20 overflow-auto max-h-[600px]" role="list">
          @foreach($types as $t)
            @php
              $isActive = $t['status'] === 'Activo';
              $badge = $isActive
                ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200/70 dark:border-emerald-800/40'
                : 'bg-amber-50 dark:bg-amber-900/20 text-amber-800 dark:text-amber-500 border border-amber-200/70 dark:border-amber-800/40';
            @endphp

            <li class="flex items-center justify-between gap-x-6 py-4 px-6 hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors group">
              <div class="min-w-0">
                <div class="flex items-start gap-x-3">
                  <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $t['name'] }}</p>

                  <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium {{ $badge }}">
                    {{ $t['status'] }}
                  </span>
                </div>

                <div class="mt-1 text-xs text-slate-500">
                  <p class="truncate">{{ $t['meta'] }}</p>
                </div>
              </div>

              <div class="flex flex-none items-center gap-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="text-slate-400 hover:text-primary transition-colors" type="button" title="Editar">
                  <span class="material-icons text-lg">edit</span>
                </button>

                @if($t['deletable'])
                  <button class="text-slate-400 hover:text-red-600 transition-colors" type="button" title="Eliminar">
                    <span class="material-icons text-lg">delete</span>
                  </button>
                @endif
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- Derecha: Etiquetas --}}
    <div class="lg:col-span-7 flex flex-col gap-6">
      <div class="bg-white dark:bg-neutral-surface-dark shadow-sm border border-slate-200 dark:border-red-900/20 rounded-xl overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-red-900/20 flex justify-between items-center bg-slate-50/50 dark:bg-red-900/10">
          <div>
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Etiquetas (Tags)</h3>
            <p class="text-xs text-slate-500 mt-1">Palabras clave para filtrar y buscar.</p>
          </div>

          <button
            class="rounded-lg bg-white dark:bg-neutral-surface-dark px-3 py-2 text-xs font-semibold text-slate-900 dark:text-white shadow-sm border border-slate-200 dark:border-red-900/20 hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors flex items-center"
            type="button"
          >
            <span class="material-icons text-sm mr-1 text-primary">sell</span>
            Nueva etiqueta
          </button>
        </div>

        <div class="px-6 py-3 border-b border-slate-100 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark flex gap-3">
          <div class="relative rounded-md flex-1">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="material-icons text-slate-400 text-sm">search</span>
            </div>
            <input
              class="block w-full rounded-lg border border-slate-200 dark:border-red-900/20 py-2 pl-10 pr-3 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/40 sm:text-sm"
              placeholder="Buscar etiquetas..."
              type="text"
            />
          </div>

          <select class="block rounded-lg border border-slate-200 dark:border-red-900/20 py-2 pl-3 pr-8 bg-white dark:bg-black/20 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/40 sm:text-sm">
            <option>Más usadas</option>
            <option>Alfabético</option>
            <option>Más nuevas</option>
          </select>
        </div>

        <div class="overflow-x-auto flex-1">
          <table class="min-w-full divide-y divide-slate-200 dark:divide-red-900/20">
            <thead class="bg-slate-50 dark:bg-red-900/10">
              <tr>
                <th class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold text-slate-900 dark:text-white">Nombre</th>
                <th class="px-3 py-3.5 text-left text-xs font-semibold text-slate-900 dark:text-white">Categoría</th>
                <th class="px-3 py-3.5 text-left text-xs font-semibold text-slate-900 dark:text-white">Uso</th>
                <th class="relative py-3.5 pl-3 pr-6"><span class="sr-only">Acciones</span></th>
              </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 dark:divide-red-900/20 bg-white dark:bg-neutral-surface-dark">
              @foreach($tags as $tag)
                <tr class="hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors group">
                  <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-slate-900 dark:text-white">
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full {{ $tag['dot'] }}"></span>
                      {{ $tag['name'] }}
                    </div>
                  </td>

                  <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                    {{ $tag['category'] }}
                  </td>

                  <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-1 text-xs font-medium text-primary border border-primary/20">
                      {{ $tag['usage'] }}
                    </span>
                  </td>

                  <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                    <button class="text-slate-400 hover:text-primary transition-colors" type="button" title="Más opciones">
                      <span class="material-icons text-lg">more_vert</span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="border-t border-slate-100 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark px-4 py-3 sm:px-6">
          <nav aria-label="Paginación" class="flex items-center justify-between">
            <div class="hidden sm:block">
              <p class="text-sm text-slate-700 dark:text-slate-300">
                Mostrando <span class="font-medium">1</span> a <span class="font-medium">6</span> de <span class="font-medium">24</span> etiquetas
              </p>
            </div>
            <div class="flex flex-1 justify-between sm:justify-end gap-2">
              <button class="relative inline-flex items-center rounded-md bg-white dark:bg-neutral-surface-dark px-3 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 border border-slate-200 dark:border-red-900/20 hover:bg-slate-50 dark:hover:bg-red-900/10" type="button">
                Anterior
              </button>
              <button class="relative inline-flex items-center rounded-md bg-white dark:bg-neutral-surface-dark px-3 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 border border-slate-200 dark:border-red-900/20 hover:bg-slate-50 dark:hover:bg-red-900/10" type="button">
                Siguiente
              </button>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>

  {{-- Estadísticas rápidas --}}
  <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-primary/5 rounded-xl p-6 border border-primary/10">
      <div class="flex items-center">
        <div class="p-3 rounded-lg bg-primary/20 text-primary">
          <span class="material-icons">description</span>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Documentos totales</p>
          <p class="text-2xl font-bold text-slate-900 dark:text-white">2,405</p>
        </div>
      </div>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-6 border border-slate-200 dark:border-red-900/20 shadow-sm">
      <div class="flex items-center">
        <div class="p-3 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
          <span class="material-icons">folder_open</span>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tipos activos</p>
          <p class="text-2xl font-bold text-slate-900 dark:text-white">12</p>
        </div>
      </div>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-6 border border-slate-200 dark:border-red-900/20 shadow-sm">
      <div class="flex items-center">
        <div class="p-3 rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
          <span class="material-icons">label</span>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Etiquetas totales</p>
          <p class="text-2xl font-bold text-slate-900 dark:text-white">24</p>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
