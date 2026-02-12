@extends('layouts.admin')

@section('title', 'Proyectos - DESCOSUR')

@push('head')
<style>
    /* Scrollbar para listas/tablas */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #4b5563; }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(8px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    .animate-fade-in-right { animation: fadeInRight .25s ease-out; }
</style>
@endpush

@section('content')
@php
    // Mock (luego lo conectas a BD)
    $proyectos = $proyectos ?? [
        [
            'nombre' => 'Mejoramiento de Agua Potable',
            'id' => 'PRJ-2023-001',
            'sector' => 'Saneamiento',
            'sector_color' => 'blue',
            'distrito' => 'Cusco',
            'estado' => 'En Ejecución',
            'estado_color' => 'emerald',
            'docs' => 12,
            'selected' => true,
        ],
        [
            'nombre' => 'Capacitación Docente Rural',
            'id' => 'PRJ-2023-045',
            'sector' => 'Educación',
            'sector_color' => 'amber',
            'distrito' => 'Puno',
            'estado' => 'Planificación',
            'estado_color' => 'amber',
            'docs' => 4,
            'selected' => false,
        ],
        [
            'nombre' => 'Infraestructura Hospitalaria Local',
            'id' => 'PRJ-2023-089',
            'sector' => 'Salud',
            'sector_color' => 'rose',
            'distrito' => 'Lima',
            'estado' => 'Cerrado',
            'estado_color' => 'slate',
            'docs' => 28,
            'selected' => false,
        ],
        [
            'nombre' => 'Talleres de Nutrición Infantil',
            'id' => 'PRJ-2023-102',
            'sector' => 'Salud',
            'sector_color' => 'rose',
            'distrito' => 'Ayacucho',
            'estado' => 'En Ejecución',
            'estado_color' => 'emerald',
            'docs' => 8,
            'selected' => false,
        ],
    ];

    $proyectoActivo = collect($proyectos)->firstWhere('selected', true) ?? $proyectos[0];
@endphp

<div class="flex flex-col lg:flex-row gap-6 h-[calc(100vh-10.5rem)] overflow-hidden">

    {{-- Panel Izquierdo: Lista --}}
    <section class="flex flex-col flex-1 bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 overflow-hidden h-full">

        {{-- Header + filtros --}}
        <div class="p-5 border-b border-slate-100 dark:border-red-900/20 flex flex-col gap-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">Listado de Proyectos</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Gestiona y monitorea los proyectos de DESCOSUR.
                    </p>
                </div>

                <button type="button"
                        class="bg-primary hover:bg-[color:var(--primary-dark,#d01a2f)] text-white px-4 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
                    <span class="material-icons text-base">add</span>
                    Crear proyecto
                </button>
            </div>

            <div class="flex flex-wrap items-center gap-3 mt-2">
                <div class="relative flex-1 min-w-[200px] max-w-sm">
                    <span class="material-icons absolute left-3 top-2.5 text-slate-400 text-lg">search</span>
                    <input
                        class="w-full pl-10 pr-4 py-2 bg-background-light dark:bg-background-dark border border-slate-200 dark:border-red-900/30 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder:text-slate-400 dark:text-white"
                        placeholder="Buscar por nombre, ID..."
                        type="text"
                    />
                </div>

                <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0 custom-scrollbar">
                    <select class="bg-background-light dark:bg-background-dark border border-slate-200 dark:border-red-900/30 text-slate-600 dark:text-slate-300 text-sm rounded-lg px-3 py-2 outline-none focus:border-primary cursor-pointer min-w-[140px]">
                        <option value="">Todos los sectores</option>
                        <option value="salud">Salud</option>
                        <option value="educacion">Educación</option>
                        <option value="infraestructura">Infraestructura</option>
                        <option value="saneamiento">Saneamiento</option>
                    </select>

                    <select class="bg-background-light dark:bg-background-dark border border-slate-200 dark:border-red-900/30 text-slate-600 dark:text-slate-300 text-sm rounded-lg px-3 py-2 outline-none focus:border-primary cursor-pointer min-w-[140px]">
                        <option value="">Estado: todos</option>
                        <option value="activo">En ejecución</option>
                        <option value="planificacion">Planificación</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="cerrado">Cerrado</option>
                    </select>

                    <select class="bg-background-light dark:bg-background-dark border border-slate-200 dark:border-red-900/30 text-slate-600 dark:text-slate-300 text-sm rounded-lg px-3 py-2 outline-none focus:border-primary cursor-pointer min-w-[140px]">
                        <option value="">Distrito</option>
                        <option value="cusco">Cusco</option>
                        <option value="puno">Puno</option>
                        <option value="lima">Lima</option>
                        <option value="ayacucho">Ayacucho</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Tabla --}}
        <div class="overflow-auto flex-1 custom-scrollbar relative">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background-light dark:bg-background-dark sticky top-0 z-10 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20">Proyecto</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20">Sector</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20">Distrito</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20">Estado</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20 text-center">Docs</th>
                        <th class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-red-900/10">
                    @foreach($proyectos as $p)
                        @php
                            $rowSelected = $p['selected'] ?? false;
                            $sectorColor = $p['sector_color'] ?? 'slate';
                            $estadoColor = $p['estado_color'] ?? 'slate';
                        @endphp

                        <tr class="group cursor-pointer transition-colors
                            {{ $rowSelected ? 'bg-primary/5 dark:bg-primary/10 relative' : 'hover:bg-slate-50 dark:hover:bg-white/5' }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($rowSelected)
                                        <div class="w-1 h-8 bg-primary absolute left-0 rounded-r"></div>
                                    @endif

                                    <div>
                                        <div class="font-semibold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            {{ $p['nombre'] }}
                                        </div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">
                                            ID: {{ $p['id'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium
                                    bg-{{ $sectorColor }}-50 text-{{ $sectorColor }}-700
                                    dark:bg-{{ $sectorColor }}-900/30 dark:text-{{ $sectorColor }}-300
                                    border border-{{ $sectorColor }}-100 dark:border-{{ $sectorColor }}-800">
                                    {{ $p['sector'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                {{ $p['distrito'] }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-{{ $estadoColor }}-500"></span>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                        {{ $p['estado'] }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-mono font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-black/20 px-2 py-1 rounded">
                                    {{ $p['docs'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 {{ $rowSelected ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity">
                                    <button type="button" class="text-slate-400 hover:text-primary transition-colors">
                                        <span class="material-icons text-lg">edit</span>
                                    </button>
                                    @if(!$rowSelected)
                                        <button type="button" class="text-slate-400 hover:text-red-500 transition-colors">
                                            <span class="material-icons text-lg">delete</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación mock --}}
        <div class="p-4 border-t border-slate-100 dark:border-red-900/20 flex items-center justify-between text-sm text-slate-500 dark:text-slate-400">
            <span>Mostrando 1-{{ count($proyectos) }} de 24 proyectos</span>
            <div class="flex items-center gap-2">
                <button type="button" class="p-1 rounded hover:bg-slate-100 dark:hover:bg-white/5 disabled:opacity-50">
                    <span class="material-icons text-lg">chevron_left</span>
                </button>
                <span class="font-medium text-slate-700 dark:text-slate-200">1</span>
                <button type="button" class="p-1 rounded hover:bg-slate-100 dark:hover:bg-white/5">
                    <span class="material-icons text-lg">chevron_right</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Panel Derecho: Detalle (solo desktop) --}}
    <aside class="hidden lg:flex flex-col w-[400px] xl:w-[450px] bg-white dark:bg-neutral-surface-dark rounded-xl shadow-lg border border-slate-200 dark:border-red-900/20 h-full animate-fade-in-right overflow-hidden">

        {{-- Header imagen --}}
        <div class="relative h-32 bg-slate-100 dark:bg-black/20 rounded-t-xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>

            <div class="w-full h-full bg-cover bg-center"
                 style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDq2dPSGbGB2QAhzko4EyXWHSKMXUlv0CINXExH3DkT9XMWURmxiB2-H65bE-Qz62i9pt2X6cmBeS3Y28oJyye3g_kP2c-6vEFuH_OX94VksC4ysuNaFTps8T4qA_KX6e51pHSae_c7vwKtZyfJKgdUNAbTlnmuuRovRbK3sl4I5-ydMGuObaIHN-nSyxFUSeYz3OIOX4suNSEKtFrQ1cVNUef1hH-dznUFU_jUiV_FGB0NTlcx5J-34EJtxZpc-BKO7Axz_JphKsoj');">
            </div>

            <div class="absolute bottom-4 left-4 z-20 text-white">
                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">
                        {{ $proyectoActivo['sector'] }}
                    </span>
                    <span class="text-xs font-medium text-white/90 bg-black/30 px-2 py-0.5 rounded backdrop-blur-sm">
                        {{ $proyectoActivo['distrito'] }}
                    </span>
                </div>
                <h2 class="text-lg font-bold leading-tight">{{ $proyectoActivo['nombre'] }}</h2>
            </div>

            <button type="button" class="absolute top-4 right-4 z-20 text-white/80 hover:text-white bg-black/20 hover:bg-black/40 rounded-full p-1 transition-colors" title="Cerrar">
                <span class="material-icons text-xl">close</span>
            </button>
        </div>

        {{-- Tabs --}}
        <div class="px-6 mt-4 border-b border-slate-100 dark:border-red-900/20">
            <nav class="flex gap-6">
                <button type="button" class="pb-3 text-sm font-medium border-b-2 border-primary text-primary">Documentos</button>
                <button type="button" class="pb-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">Resumen</button>
                <button type="button" class="pb-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">Configuración</button>
            </nav>
        </div>

        {{-- Contenido --}}
        <div class="flex-1 overflow-y-auto custom-scrollbar p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-background-light dark:bg-background-dark p-3 rounded-lg border border-slate-100 dark:border-red-900/20">
                    <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Total archivos</div>
                    <div class="text-xl font-bold text-slate-800 dark:text-white">{{ $proyectoActivo['docs'] }}</div>
                </div>
                <div class="bg-background-light dark:bg-background-dark p-3 rounded-lg border border-slate-100 dark:border-red-900/20">
                    <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Última actualización</div>
                    <div class="text-sm font-semibold text-slate-800 dark:text-white pt-1">Hace 2 horas</div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">Archivos recientes</h3>
                <button type="button" class="text-xs text-primary font-medium hover:underline flex items-center gap-1">
                    <span class="material-icons text-sm">upload_file</span>
                    Subir
                </button>
            </div>

            <div class="flex flex-col gap-3">
                @php
                    $archivos = [
                        ['tipo' => 'pdf',  'nombre' => 'Presupuesto_Anual_2023.pdf', 'meta' => '2.4 MB • 14 Oct 2023'],
                        ['tipo' => 'doc',  'nombre' => 'Informe_Impacto_Social.docx', 'meta' => '1.1 MB • 12 Oct 2023'],
                        ['tipo' => 'xls',  'nombre' => 'Cronograma_Obras_Fase2.xlsx', 'meta' => '856 KB • 10 Oct 2023'],
                        ['tipo' => 'pdf',  'nombre' => 'Acta_Conformidad_Comunal.pdf', 'meta' => '3.2 MB • 08 Oct 2023'],
                    ];
                @endphp

                @foreach($archivos as $a)
                    @php
                        $icon = $a['tipo'] === 'pdf' ? 'picture_as_pdf' : ($a['tipo'] === 'xls' ? 'grid_on' : 'description');
                        $bg   = $a['tipo'] === 'pdf' ? 'bg-red-50 text-red-500 dark:bg-red-900/20 dark:text-red-400'
                              : ($a['tipo'] === 'xls' ? 'bg-green-50 text-green-500 dark:bg-green-900/20 dark:text-green-400'
                              : 'bg-blue-50 text-blue-500 dark:bg-blue-900/20 dark:text-blue-400');
                    @endphp

                    <div class="group flex items-center p-3 rounded-lg border border-slate-100 dark:border-red-900/20 hover:border-primary/30 hover:shadow-md transition-all bg-white dark:bg-neutral-surface-dark cursor-pointer">
                        <div class="w-10 h-10 rounded-lg {{ $bg }} flex items-center justify-center mr-3">
                            <span class="material-icons">{{ $icon }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200 truncate group-hover:text-primary transition-colors">
                                {{ $a['nombre'] }}
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $a['meta'] }}</p>
                        </div>
                        <button type="button" class="text-slate-300 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                            <span class="material-icons">more_vert</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <div class="p-4 border-t border-slate-100 dark:border-red-900/20 bg-background-light dark:bg-background-dark/50">
            <button type="button"
                    class="w-full py-2 border border-slate-300 dark:border-red-900/30 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-white/5 hover:text-primary transition-all flex items-center justify-center gap-2">
                <span class="material-icons text-base">folder_open</span>
                Ver carpeta completa
            </button>
        </div>
    </aside>

</div>
@endsection
