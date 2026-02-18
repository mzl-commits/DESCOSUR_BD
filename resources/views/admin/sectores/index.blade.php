@extends('layouts.admin')

@section('title', 'Sectores - DESCOSUR')

@push('head')
<style>
    /* Scrollbar estética */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .dark ::-webkit-scrollbar-thumb { background: rgba(239, 35, 60, 0.18); }

    /* “line-clamp-2” sin plugin */
    .line-clamp-2{
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }
</style>
@endpush

@section('content')
@php
    // Mock (luego lo conectas a BD)
    $sectores = $sectores ?? [
        ['id'=>1,'nombre'=>'Educación Rural','descripcion'=>'Iniciativas para mejorar la infraestructura y calidad educativa en comunidades altoandinas.','icono'=>'school','color'=>'blue','proyectos'=>12],
        ['id'=>2,'nombre'=>'Salud y Nutrición','descripcion'=>'Programas de prevención de anemia y acceso a servicios básicos de salud materno-infantil.','icono'=>'local_hospital','color'=>'emerald','proyectos'=>8],
        ['id'=>3,'nombre'=>'Desarrollo Económico','descripcion'=>'Capacitación técnica y microcréditos para emprendedores locales en zonas rurales.','icono'=>'payments','color'=>'amber','proyectos'=>5],
        ['id'=>4,'nombre'=>'Medio Ambiente','descripcion'=>'Proyectos de reforestación, conservación de agua y gestión de residuos.','icono'=>'eco','color'=>'green','proyectos'=>15],
        ['id'=>5,'nombre'=>'Derechos Humanos','descripcion'=>'Asesoría legal y defensa de derechos fundamentales en poblaciones vulnerables.','icono'=>'gavel','color'=>'purple','proyectos'=>2],
    ];

    $sectorActivo = $sectorActivo ?? $sectores[0];

    $stats = [
        'total_sectores' => count($sectores),
        'proyectos_activos' => 42,
        'crecimiento_mes' => '+12%',
    ];

    $proyectosDelSector = $proyectosDelSector ?? [
        ['id'=>'PRJ-001','proyecto'=>'Escuela Segura Cusco','responsable'=>'María Lopez','inicial'=>'M','inicial_color'=>'purple','inicio'=>'12 Mar, 2023','estado'=>'En curso','estado_style'=>'emerald'],
        ['id'=>'PRJ-004','proyecto'=>'Capacitación Docente Puno','responsable'=>'Juan Perez','inicial'=>'J','inicial_color'=>'blue','inicio'=>'05 Abr, 2023','estado'=>'Planificación','estado_style'=>'amber'],
        ['id'=>'PRJ-008','proyecto'=>'Infraestructura Digital Ayacucho','responsable'=>'Ana Ruiz','inicial'=>'A','inicial_color'=>'pink','inicio'=>'20 Feb, 2023','estado'=>'Finalizado','estado_style'=>'slate'],
    ];
@endphp

{{-- Header (breadcrumb + acciones) --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
            <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Inicio</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 dark:text-white font-medium">Gestión de Sectores</span>
        </nav>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sectores Organizacionales</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Administra los sectores y su relación con proyectos en DESCOSUR.
        </p>
    </div>

    <div class="flex items-center gap-3 self-end sm:self-auto">
        <div class="relative hidden sm:block">
            <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input
                type="text"
                placeholder="Buscar sector..."
                class="pl-10 pr-4 py-2 bg-white dark:bg-neutral-surface-dark border border-slate-200 dark:border-red-900/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-64 shadow-sm"
            />
        </div>

        <button
            type="button"
            data-open-sector-modal
            class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg shadow-lg shadow-primary/20 transition-all active:scale-95 text-sm font-medium"
        >
            <span class="material-icons text-lg">add</span>
            <span>Crear sector</span>
        </button>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white dark:bg-neutral-surface-dark p-5 rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-300">
            <span class="material-icons">domain</span>
        </div>
        <div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Total sectores</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['total_sectores'] }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark p-5 rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-300">
            <span class="material-icons">folder_open</span>
        </div>
        <div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Proyectos activos</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['proyectos_activos'] }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark p-5 rounded-xl border border-slate-100 dark:border-red-900/20 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-300">
            <span class="material-icons">trending_up</span>
        </div>
        <div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Crecimiento (mes)</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['crecimiento_mes'] }}</p>
        </div>
    </div>
</div>

{{-- Grid de sectores --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
    @foreach($sectores as $s)
        @php
            $c = $s['color'];
        @endphp

        <article class="group bg-white dark:bg-neutral-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-sm hover:shadow-md transition-all overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-{{ $c }}-400 to-{{ $c }}-600"></div>

            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-lg bg-{{ $c }}-50 dark:bg-{{ $c }}-900/20 flex items-center justify-center text-{{ $c }}-600 dark:text-{{ $c }}-300">
                        <span class="material-icons text-2xl">{{ $s['icono'] }}</span>
                    </div>

                    <button type="button" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1 rounded-full hover:bg-slate-100 dark:hover:bg-white/5">
                        <span class="material-icons">more_vert</span>
                    </button>
                </div>

                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                    {{ $s['nombre'] }}
                </h3>

                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 line-clamp-2">
                    {{ $s['descripcion'] }}
                </p>

                <div class="flex items-center justify-between border-t border-slate-100 dark:border-red-900/20 pt-4">
                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <span class="material-icons text-base">folder</span>
                        <span class="font-semibold">{{ $s['proyectos'] }}</span> proyectos
                    </div>

                    <button type="button"
                            class="text-xs font-semibold text-primary hover:text-primary-dark bg-primary/10 hover:bg-primary/20 px-3 py-1.5 rounded-full transition-colors">
                        Ver detalles
                    </button>
                </div>
            </div>
        </article>
    @endforeach

    {{-- Card placeholder --}}
    <button type="button" data-open-sector-modal
            class="group bg-slate-50 dark:bg-white/5 border-2 border-dashed border-slate-300 dark:border-red-900/20 rounded-xl flex flex-col items-center justify-center p-8 hover:border-primary hover:bg-primary/5 transition-all">
        <div class="w-14 h-14 rounded-full bg-white dark:bg-neutral-surface-dark shadow-sm flex items-center justify-center text-slate-400 group-hover:text-primary mb-3 transition-colors">
            <span class="material-icons text-3xl">add</span>
        </div>
        <span class="text-slate-500 dark:text-slate-400 font-medium group-hover:text-primary transition-colors">
            Agregar nuevo sector
        </span>
    </button>
</div>

{{-- Tabla de proyectos (sector seleccionado) --}}
<div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
            Proyectos en “{{ $sectorActivo['nombre'] }}”
        </h2>

        <div class="flex gap-2">
            <button type="button" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                <span class="material-icons">filter_list</span>
            </button>
            <button type="button" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                <span class="material-icons">download</span>
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-white/5 border-b border-slate-200 dark:border-red-900/20 text-xs uppercase text-slate-500 font-semibold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Proyecto</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4">Fecha inicio</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-red-900/10">
                    @foreach($proyectosDelSector as $p)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $p['id'] }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $p['proyecto'] }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-{{ $p['inicial_color'] }}-100 text-{{ $p['inicial_color'] }}-600 flex items-center justify-center text-xs font-bold">
                                        {{ $p['inicial'] }}
                                    </div>
                                    <span>{{ $p['responsable'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $p['inicio'] }}</td>
                            <td class="px-6 py-4">
                                @php $st = $p['estado_style']; @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    bg-{{ $st }}-100 text-{{ $st }}-700
                                    dark:bg-{{ $st }}-900/30 dark:text-{{ $st }}-300
                                    border border-{{ $st }}-200 dark:border-{{ $st }}-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-{{ $st }}-500"></span>
                                    {{ $p['estado'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button type="button" class="text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-icons text-lg">edit</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal: Crear sector --}}
<div id="sectorModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="sectorModalTitle">
    <div class="absolute inset-0 bg-black/60" data-close-sector-modal></div>

    <div class="relative min-h-screen flex items-end sm:items-center justify-center p-4">
        <div class="w-full sm:max-w-lg bg-white dark:bg-neutral-surface-dark rounded-xl shadow-2xl border border-slate-200 dark:border-red-900/20 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-red-900/20 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-icons text-primary">add_business</span>
                </div>
                <div class="flex-1">
                    <h3 id="sectorModalTitle" class="text-lg font-semibold text-slate-900 dark:text-white">Crear nuevo sector</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Completa la información para registrar el sector.</p>
                </div>

                <button type="button" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200" data-close-sector-modal>
                    <span class="material-icons">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="sector-name">Nombre del sector</label>
                    <input id="sector-name" type="text"
                           class="mt-1 block w-full rounded-md border-slate-300 dark:border-red-900/20 dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2 px-3"
                           placeholder="Ej: Innovación Digital">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="sector-desc">Descripción</label>
                    <textarea id="sector-desc" rows="3"
                              class="mt-1 block w-full rounded-md border-slate-300 dark:border-red-900/20 dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2 px-3"
                              placeholder="Breve descripción de las actividades del sector..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="sector-manager">Responsable</label>
                        <select id="sector-manager"
                                class="mt-1 block w-full rounded-md border-slate-300 dark:border-red-900/20 dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2 px-3">
                            <option>Seleccionar...</option>
                            <option>Carlos Mendez</option>
                            <option>Ana Ruiz</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ícono</label>
                        <div class="mt-1 flex gap-2 flex-wrap">
                            <button type="button" class="w-9 h-9 rounded bg-primary/10 text-primary border border-primary/40 flex items-center justify-center hover:bg-primary/20 transition">
                                <span class="material-icons text-sm">school</span>
                            </button>
                            <button type="button" class="w-9 h-9 rounded bg-slate-100 dark:bg-white/5 text-slate-500 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center transition">
                                <span class="material-icons text-sm">local_hospital</span>
                            </button>
                            <button type="button" class="w-9 h-9 rounded bg-slate-100 dark:bg-white/5 text-slate-500 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center transition">
                                <span class="material-icons text-sm">eco</span>
                            </button>
                            <button type="button" class="w-9 h-9 rounded bg-slate-100 dark:bg-white/5 text-slate-500 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center transition">
                                <span class="material-icons text-sm">add</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-white/5 border-t border-slate-200 dark:border-red-900/20 flex flex-col sm:flex-row-reverse gap-2">
                <button type="button" class="w-full sm:w-auto rounded-md px-4 py-2 bg-primary text-sm font-medium text-white hover:bg-primary-dark">
                    Guardar sector
                </button>
                <button type="button" data-close-sector-modal
                        class="w-full sm:w-auto rounded-md px-4 py-2 bg-white dark:bg-background-dark border border-slate-300 dark:border-red-900/20 text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/5">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const modal = document.getElementById('sectorModal');
        const openBtns = document.querySelectorAll('[data-open-sector-modal]');
        const closeBtns = document.querySelectorAll('[data-close-sector-modal]');

        const open = () => modal?.classList.remove('hidden');
        const close = () => modal?.classList.add('hidden');

        openBtns.forEach(b => b.addEventListener('click', open));
        closeBtns.forEach(b => b.addEventListener('click', close));

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') close();
        });
    })();
</script>
@endpush
