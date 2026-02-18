@extends('layouts.usuario')


@section('title', 'Documentos - DESCOSUR')
@section('page_title', 'Documentos')

@push('head')
<style>
    /* Scrollbar fino para panel izquierdo */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
</style>
@endpush

@section('content')

@php
    $esEncargado = auth()->user()->rol === 'ENCARGADO';
@endphp

@php
    // Data demo (luego lo reemplazas por DB)   
    $tree = $tree ?? [
        [
            'sector' => 'Salud y Nutrición',
            'open' => true,
            'projects' => [
                ['name' => 'Proyecto Anemia Zero', 'active' => false],
                ['name' => 'Campaña Vacunación 2024', 'active' => true],
                ['name' => 'Infraestructura Médica', 'active' => false],
            ],
        ],
        [
            'sector' => 'Educación Rural',
            'open' => false,
            'projects' => [],
        ],
        [
            'sector' => 'Desarrollo Agrario',
            'open' => false,
            'projects' => [],
        ],
    ];

    $rows = $rows ?? [
        [
            'icon' => 'picture_as_pdf',
            'iconBg' => 'bg-red-50',
            'iconColor' => 'text-red-500',
            'name' => 'Informe_Técnico_Cusco_Q1.pdf',
            'meta' => '1.2 MB • Subido por Juan Perez',
            'date' => '24 Oct 2023',
            'tags' => [['Técnico','blue'], ['Q1','gray']],
            'ubigeo' => 'Cusco / San Je...',
            'ubigeoTitle' => 'Cusco / Cusco / San Jerónimo',
            'status' => ['Aprobado','green'],
            'selected' => false,
        ],
        [
            'icon' => 'description',
            'iconBg' => 'bg-blue-50',
            'iconColor' => 'text-blue-500',
            'name' => 'Presupuesto_Vacunacion_V2.docx',
            'meta' => '450 KB • Subido por Maria Lopez',
            'date' => '23 Oct 2023',
            'tags' => [['Finanzas','purple']],
            'ubigeo' => 'Lima / Mirafl...',
            'ubigeoTitle' => 'Lima / Lima / Miraflores',
            'status' => ['En Revisión','amber'],
            'selected' => false,
        ],
        [
            'icon' => 'table_chart',
            'iconBg' => 'bg-green-50',
            'iconColor' => 'text-green-600',
            'name' => 'Beneficiarios_Padron_Final.xlsx',
            'meta' => '2.1 MB • Subido por Admin',
            'date' => '20 Oct 2023',
            'tags' => [['Padrón','teal'], ['Confidencial','teal']],
            'ubigeo' => 'Arequipa / Chivay',
            'ubigeoTitle' => 'Arequipa / Caylloma / Chivay',
            'status' => ['Aprobado','green'],
            'selected' => false,
        ],
        [
            'icon' => 'image',
            'iconBg' => 'bg-gray-100',
            'iconColor' => 'text-gray-500',
            'name' => 'Evidencia_Campo_004.jpg',
            'meta' => '3.4 MB • Subido por Campo 2',
            'date' => '18 Oct 2023',
            'tags' => [['Fotografía','orange']],
            'ubigeo' => 'Cusco / Poroy',
            'ubigeoTitle' => 'Cusco / Cusco / Poroy',
            'status' => ['Borrador','gray'],
            'selected' => false,
        ],
        [
            'icon' => 'picture_as_pdf',
            'iconBg' => 'bg-red-50',
            'iconColor' => 'text-red-500',
            'name' => 'Acta_Reunion_Comunal.pdf',
            'meta' => '890 KB • Subido por Juan Perez',
            'date' => '15 Oct 2023',
            'tags' => [['Legal','blue'], ['Urgente','red']],
            'ubigeo' => 'Cusco / San Se...',
            'ubigeoTitle' => 'Cusco / Cusco / San Sebastián',
            'status' => ['Aprobado','green'],
            'selected' => true,
        ],
    ];

    $tagClass = function ($color) {
        return match($color) {
            'blue' => 'bg-blue-50 text-blue-600 border-blue-100',
            'gray' => 'bg-gray-100 text-gray-600 border-gray-200',
            'purple' => 'bg-purple-50 text-purple-600 border-purple-100',
            'teal' => 'bg-teal-50 text-teal-600 border-teal-100',
            'orange' => 'bg-orange-50 text-orange-600 border-orange-100',
            'red' => 'bg-red-50 text-red-600 border-red-100',
            default => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    };

    $statusClass = function ($color) {
        return match($color) {
            'green' => 'bg-green-50 text-green-700 border-green-100',
            'amber' => 'bg-amber-50 text-amber-700 border-amber-100',
            'gray' => 'bg-gray-100 text-gray-600 border-gray-200',
            default => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    };

    $dotClass = function ($color) {
        return match($color) {
            'green' => 'bg-green-500',
            'amber' => 'bg-amber-500',
            'gray' => 'bg-gray-400',
            default => 'bg-gray-400',
        };
    };

  $createUrl = route('usuario.documentos.store');
@endphp

{{-- Encabezado de página (dentro del content) --}}
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Explorador de Documentos</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Clasifica y encuentra archivos por sector, proyecto, etiquetas y UBIGEO.
        </p>
    </div>

    <div class="flex gap-3">
      @if($esEncargado)
@php
    $createUrl = route('usuario.documentos.create');
@endphp
<a href="{{ $createUrl }}"
   class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all text-sm">
    <span class="material-icons text-sm">cloud_upload</span>
    Subir documento
</a>
@endif
    </div>
</div>

{{-- Layout interno: panel izquierdo + tabla --}}
<div class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-6">

    {{-- Panel izquierdo (árbol) --}}
    <aside class="bg-white dark:bg-neutral-surface-dark border border-slate-200 dark:border-red-900/20 rounded-xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 dark:border-red-900/20">
            <div class="flex items-center gap-2 text-primary font-bold text-lg">
                <span class="material-icons">folder_shared</span>
                <span>DESCOSUR Docs</span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Navega por sectores y proyectos.
            </p>
        </div>

        @if($esEncargado)
<div class="p-4">
    <a href="{{ $createUrl }}"
       class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-sm shadow-primary/30">
        <span class="material-icons text-xl">add</span>
        Subir documento
    </a>
</div>
@endif
        <div class="px-3 pb-3">
            <h3 class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">General</h3>

            <a class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-white/5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 transition-colors"
               href="{{ route('usuario.dashboard') }}">
                <span class="material-icons text-slate-500">dashboard</span>
                Inicio
            </a>

            <a class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 rounded-lg transition-colors"
               href="#">
                <span class="material-icons text-slate-400">schedule</span>
                Recientes
            </a>

            <a class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 rounded-lg transition-colors"
               href="#">
                <span class="material-icons text-slate-400">star_outline</span>
                Destacados
            </a>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar px-3 py-2 space-y-2">
            <h3 class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Sectores y proyectos</h3>

            @foreach ($tree as $node)
                {{-- sector --}}
                <div class="space-y-1">
                    <button class="w-full flex items-center gap-2 px-3 py-2 text-sm font-medium
                        {{ $node['open'] ? 'text-primary bg-primary/5' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5' }}
                        rounded-lg transition-colors group">
                        <span class="material-icons text-lg {{ $node['open'] ? 'rotate-90' : '' }} transition-transform">
                            arrow_right
                        </span>
                        <span class="material-icons {{ $node['open'] ? 'text-primary' : 'text-slate-400' }}">
                            {{ $node['open'] ? 'folder_open' : 'folder' }}
                        </span>
                        <span class="truncate">{{ $node['sector'] }}</span>
                    </button>

                    @if (!empty($node['projects']) && $node['open'])
                        <div class="pl-9 space-y-1">
                            @foreach ($node['projects'] as $p)
                                <a href="#"
                                   class="flex items-center gap-2 px-3 py-1.5 text-sm rounded-md transition-colors
                                    {{ $p['active']
                                        ? 'font-medium text-primary bg-primary/10'
                                        : 'text-slate-600 dark:text-slate-300 hover:text-primary hover:bg-slate-50 dark:hover:bg-white/5'
                                    }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $p['active'] ? 'bg-primary' : 'bg-slate-300' }}"></span>
                                    <span class="truncate">{{ $p['name'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="p-4 border-t border-slate-100 dark:border-red-900/20 bg-slate-50/50 dark:bg-white/5">
            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-300 mb-1">
                <span>Almacenamiento</span>
                <span class="font-medium text-slate-700 dark:text-white">75%</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-white/10 rounded-full h-1.5">
                <div class="bg-primary h-1.5 rounded-full" style="width: 75%"></div>
            </div>
            <p class="text-[10px] text-slate-400 mt-1">15GB de 20GB usados</p>
        </div>
    </aside>

    {{-- Tabla + filtros --}}
    <section class="bg-white dark:bg-neutral-surface-dark border border-slate-200 dark:border-red-900/20 rounded-xl overflow-hidden">

        {{-- Barra filtros --}}
        <div class="border-b border-slate-200 dark:border-red-900/20 px-6 py-4 flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300 mr-2">
                <span class="material-icons text-slate-400">filter_list</span>
                <span class="font-medium">Filtros:</span>
            </div>

            <div class="relative">
                <select class="appearance-none bg-slate-50 dark:bg-black/20 hover:bg-slate-100 dark:hover:bg-black/30 border border-slate-200 dark:border-red-900/30 text-slate-700 dark:text-slate-200 py-1.5 pl-3 pr-8 rounded-lg text-xs font-medium focus:outline-none focus:border-primary cursor-pointer transition-colors">
                    <option>Tipo de archivo</option>
                    <option>PDF</option>
                    <option>Word</option>
                    <option>Excel</option>
                    <option>Imagen</option>
                </select>
                <span class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none material-icons text-sm text-slate-500">expand_more</span>
            </div>

            <div class="relative">
                <select class="appearance-none bg-slate-50 dark:bg-black/20 hover:bg-slate-100 dark:hover:bg-black/30 border border-slate-200 dark:border-red-900/30 text-slate-700 dark:text-slate-200 py-1.5 pl-3 pr-8 rounded-lg text-xs font-medium focus:outline-none focus:border-primary cursor-pointer transition-colors w-44">
                    <option>Ubicación (UBIGEO)</option>
                    <option>Cusco</option>
                    <option>Lima</option>
                    <option>Arequipa</option>
                </select>
                <span class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none material-icons text-sm text-slate-500">expand_more</span>
            </div>

            <button class="flex items-center gap-2 bg-slate-50 dark:bg-black/20 hover:bg-slate-100 dark:hover:bg-black/30 border border-slate-200 dark:border-red-900/30 text-slate-700 dark:text-slate-200 py-1.5 px-3 rounded-lg text-xs font-medium transition-colors">
                <span class="material-icons text-sm text-slate-400">calendar_today</span>
                <span>Últimos 30 días</span>
                <span class="material-icons text-sm text-slate-400">expand_more</span>
            </button>

            <div class="relative">
                <select class="appearance-none bg-slate-50 dark:bg-black/20 hover:bg-slate-100 dark:hover:bg-black/30 border border-slate-200 dark:border-red-900/30 text-slate-700 dark:text-slate-200 py-1.5 pl-3 pr-8 rounded-lg text-xs font-medium focus:outline-none focus:border-primary cursor-pointer transition-colors">
                    <option>Estado</option>
                    <option>Aprobado</option>
                    <option>En Revisión</option>
                    <option>Borrador</option>
                </select>
                <span class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none material-icons text-sm text-slate-500">expand_more</span>
            </div>

            <div class="h-6 w-px bg-slate-200 dark:bg-white/10 mx-1"></div>

            <button class="text-xs font-medium text-primary hover:text-primary-dark hover:underline transition-colors">
                Limpiar filtros
            </button>
        </div>

        {{-- Tabla --}}
        <div class="bg-slate-50 dark:bg-black/10 p-6">
            <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-white/5 text-xs uppercase text-slate-500 dark:text-slate-300 font-semibold border-b border-slate-100 dark:border-red-900/20">
                            <tr>
                                <th class="px-6 py-4 w-12 text-center">
                                    <input class="rounded border-slate-300 text-primary focus:ring-primary/20" type="checkbox"/>
                                </th>
                                <th class="px-6 py-4">Nombre</th>
                                <th class="px-6 py-4 w-32">Fecha</th>
                                <th class="px-6 py-4 w-48">Etiquetas</th>
                                <th class="px-6 py-4 w-48">Ubicación (UBIGEO)</th>
                                <th class="px-6 py-4 w-32">Estado</th>
                                <th class="px-6 py-4 w-16"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 dark:divide-red-900/10 text-sm text-slate-600 dark:text-slate-200">
                            @foreach ($rows as $r)
                                <tr class="{{ $r['selected'] ? 'bg-primary/5 border-l-2 border-primary' : '' }} hover:bg-slate-50/80 dark:hover:bg-white/5 transition-colors group">
                                    <td class="px-6 py-3 text-center">
                                        <input {{ $r['selected'] ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary/20" type="checkbox"/>
                                    </td>

                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded {{ $r['iconBg'] }} flex items-center justify-center flex-shrink-0">
                                                <span class="material-icons {{ $r['iconColor'] }} text-lg">{{ $r['icon'] }}</span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-800 dark:text-white group-hover:text-primary transition-colors">
                                                    {{ $r['name'] }}
                                                </p>
                                                <p class="text-xs text-slate-400">{{ $r['meta'] }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3 text-slate-500 dark:text-slate-300">{{ $r['date'] }}</td>

                                    <td class="px-6 py-3">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($r['tags'] as [$label,$color])
                                                <span class="px-2 py-0.5 rounded-md border text-[11px] font-medium {{ $tagClass($color) }}">
                                                    {{ $label }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-1 text-xs" title="{{ $r['ubigeoTitle'] }}">
                                            <span class="material-icons text-slate-400 text-sm">place</span>
                                            <span class="truncate max-w-[140px]">{{ $r['ubigeo'] }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3">
                                        @php [$st,$color] = $r['status']; @endphp
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusClass($color) }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass($color) }}"></span>
                                            {{ $st }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-3 text-right">
                                        <button class="p-1.5 rounded-full hover:bg-slate-200 dark:hover:bg-white/10 text-slate-400 hover:text-slate-600 transition-colors">
                                            <span class="material-icons text-lg">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Paginación (demo) --}}
                <div class="bg-white dark:bg-neutral-surface-dark border-t border-slate-200 dark:border-red-900/20 px-6 py-3 flex items-center justify-between">
                    <span class="text-xs text-slate-500 dark:text-slate-300">
                        Mostrando <span class="font-semibold text-slate-700 dark:text-white">1-5</span>
                        de <span class="font-semibold text-slate-700 dark:text-white">128</span> documentos
                    </span>

                    <div class="flex items-center gap-2">
                        <button class="p-1 rounded-md hover:bg-slate-100 dark:hover:bg-white/10 text-slate-400 hover:text-slate-600 disabled:opacity-50">
                            <span class="material-icons">chevron_left</span>
                        </button>
                        <button class="p-1 rounded-md hover:bg-slate-100 dark:hover:bg-white/10 text-slate-400 hover:text-slate-600">
                            <span class="material-icons">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
