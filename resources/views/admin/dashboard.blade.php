@extends('layouts.admin')

@section('title', 'Panel - DESCOSUR')
@section('page_title', 'Resumen general')

@section('content')
@php
    $user = auth()->user();
    $name = $user->name ?? 'Usuario';

    // Demo por ahora (luego lo conectas a BD)
    $kpiDocs = 1248;
    $kpiProjects = 34;
    $kpiSectors = 8;
    $kpiDistricts = 15;
@endphp

<!-- Acciones rápidas -->
<section class="flex flex-wrap items-center justify-between gap-4">
    <div class="flex flex-col">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Bienvenido de nuevo, {{ $name }} 👋</h2>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Aquí tienes un resumen rápido del estado de los proyectos y documentos.</p>
    </div>

    <div class="flex gap-3">
        <a href="{{ url('/admin/ubigeo') }}"
           class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-black/20 border border-slate-200 dark:border-red-900/30 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 hover:border-slate-300 dark:hover:bg-red-900/10 transition-all text-sm shadow-sm">
            <span class="material-icons text-sm">map</span>
            Gestionar UBIGEO
        </a>

        <a href="{{ url('/admin/proyectos/create') }}"
           class="flex items-center gap-2 px-4 py-2.5 bg-primary/10 text-primary font-semibold rounded-lg hover:bg-primary/20 border border-primary/10 transition-all text-sm">
            <span class="material-icons text-sm">add_circle_outline</span>
            Crear proyecto
        </a>

        <a href="{{ url('/admin/documentos/create') }}"
           class="flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all text-sm">
            <span class="material-icons text-sm">cloud_upload</span>
            Subir documento
        </a>
    </div>
</section>

<!-- KPIs -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-5 border border-slate-100 dark:border-red-900/20 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg group-hover:bg-blue-100 dark:group-hover:bg-blue-900/30 transition-colors">
                <span class="material-icons text-blue-600 dark:text-blue-400">description</span>
            </div>
            <span class="flex items-center text-xs font-semibold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">
                <span class="material-icons text-[10px] mr-1">trending_up</span>
                +12%
            </span>
        </div>
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Total de documentos</p>
        <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($kpiDocs) }}</h3>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-5 border border-slate-100 dark:border-red-900/20 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary/10 rounded-lg group-hover:bg-primary/20 transition-colors">
                <span class="material-icons text-primary">folder_special</span>
            </div>
            <span class="flex items-center text-xs font-semibold text-slate-500 bg-slate-100 dark:bg-white/5 px-2 py-1 rounded-full">
                3 nuevos
            </span>
        </div>
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Proyectos activos</p>
        <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $kpiProjects }}</h3>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-5 border border-slate-100 dark:border-red-900/20 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg group-hover:bg-purple-100 dark:group-hover:bg-purple-900/30 transition-colors">
                <span class="material-icons text-purple-600 dark:text-purple-400">category</span>
            </div>
        </div>
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Sectores</p>
        <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ str_pad($kpiSectors, 2, '0', STR_PAD_LEFT) }}</h3>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl p-5 border border-slate-100 dark:border-red-900/20 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 transition-colors">
                <span class="material-icons text-orange-600 dark:text-orange-400">location_on</span>
            </div>
            <span class="flex items-center text-xs font-semibold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">
                <span class="material-icons text-[10px] mr-1">trending_up</span>
                +2
            </span>
        </div>
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Distritos (UBIGEO)</p>
        <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $kpiDistricts }}</h3>
    </div>
</section>

<!-- Gráficos -->
<section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Documentos por sector -->
    <div class="bg-white dark:bg-neutral-surface-dark p-6 rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-slate-800 dark:text-white">Documentos por sector</h3>
            <button class="text-sm text-primary hover:text-primary-dark font-medium">Ver reporte</button>
        </div>

        <div class="flex items-center gap-8">
            <div class="relative w-32 h-32 rounded-full flex-shrink-0"
                 style="background: conic-gradient(#ef253c 0% 40%, #fb923c 40% 70%, #3b82f6 70% 90%, #e2e8f0 90% 100%);">
                <div class="absolute inset-0 m-auto w-20 h-20 bg-white dark:bg-neutral-surface-dark rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold text-slate-500">Total %</span>
                </div>
            </div>

            <div class="flex-1 space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                        <span class="text-slate-600 dark:text-slate-300">Salud</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">40%</span>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-400"></span>
                        <span class="text-slate-600 dark:text-slate-300">Educación</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">30%</span>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-slate-600 dark:text-slate-300">Infraestructura</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">20%</span>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span>
                        <span class="text-slate-600 dark:text-slate-300">Otros</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">10%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentos por región -->
    <div class="bg-white dark:bg-neutral-surface-dark p-6 rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm flex flex-col justify-between">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-slate-800 dark:text-white">Documentos por región</h3>
            <button class="text-sm text-primary hover:text-primary-dark font-medium">Detalles</button>
        </div>

        <div class="space-y-4">
            @php
                $regions = [
                    ['name' => 'Lima', 'docs' => 450, 'w' => 75, 'class' => 'bg-primary'],
                    ['name' => 'Cusco', 'docs' => 280, 'w' => 55, 'class' => 'bg-primary/80'],
                    ['name' => 'Arequipa', 'docs' => 190, 'w' => 35, 'class' => 'bg-primary/60'],
                    ['name' => 'Piura', 'docs' => 120, 'w' => 20, 'class' => 'bg-primary/40'],
                ];
            @endphp

            @foreach($regions as $r)
                <div class="space-y-1">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600 dark:text-slate-300 font-medium">{{ $r['name'] }}</span>
                        <span class="text-slate-500">{{ $r['docs'] }} docs</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-white/5 rounded-full h-2.5">
                        <div class="{{ $r['class'] }} h-2.5 rounded-full" style="width: {{ $r['w'] }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Documentos recientes -->
<section class="bg-white dark:bg-neutral-surface-dark rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 dark:border-red-900/20 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h3 class="font-bold text-lg text-slate-800 dark:text-white">Documentos recientes</h3>

        <div class="flex items-center gap-3">
            <div class="relative">
                <span class="material-icons absolute left-2 top-2 text-slate-400 text-lg">filter_list</span>
                <select class="pl-8 pr-4 py-1.5 text-sm border border-slate-200 dark:border-red-900/30 rounded-lg bg-slate-50 dark:bg-black/20 text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-1 focus:ring-primary">
                    <option>Todos los proyectos</option>
                    <option>Proyecto Alpha</option>
                    <option>Salud rural</option>
                </select>
            </div>

            <a href="{{ url('/admin/documentos') }}" class="text-sm text-primary font-semibold hover:underline">Ver todo</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-slate-50/50 dark:bg-white/5 border-b border-slate-100 dark:border-red-900/20 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold">
                <th class="px-6 py-4 rounded-tl-lg">Nombre del documento</th>
                <th class="px-6 py-4">Proyecto</th>
                <th class="px-6 py-4">Sector</th>
                <th class="px-6 py-4">Fecha</th>
                <th class="px-6 py-4 text-center">Estado</th>
                <th class="px-6 py-4 text-right rounded-tr-lg">Acciones</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 dark:divide-red-900/10 text-sm">
            <tr class="hover:bg-slate-50 dark:hover:bg-red-900/5 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-500">
                            <span class="material-icons text-lg">picture_as_pdf</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">Reporte anual 2023.pdf</p>
                            <p class="text-xs text-slate-500">3.4 MB</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Operaciones generales</td>
                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-white/10 dark:text-white">
                        Administración
                    </span>
                </td>
                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">24/10/2023</td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                        Aprobado
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-1.5 text-slate-400 hover:text-primary transition-colors">
                            <span class="material-icons text-lg">download</span>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-primary transition-colors">
                            <span class="material-icons text-lg">visibility</span>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<div class="text-center text-slate-400 text-xs py-4">
    © {{ date('Y') }} DESCOSUR. Uso interno.
</div>
@endsection
