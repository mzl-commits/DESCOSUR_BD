@extends('layouts.admin')

@section('title', 'UBIGEO - Explorador')

@push('head')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(239,35,60,.18); }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }

    /* line-clamp sin plugin */
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
    // ---------------------------
    // Params (para simular navegación real)
    // ---------------------------
    $dep  = request('dep',  '15'); // Lima por defecto
    $prov = request('prov', '01'); // Lima provincia
    $dist = request('dist', '22'); // Miraflores (mock)

    // ---------------------------
    // Mock data (luego esto sale de BD/tabla ubigeo)
    // ---------------------------
    $departamentos = [
        ['code' => '01', 'name' => 'Amazonas'],
        ['code' => '02', 'name' => 'Áncash'],
        ['code' => '03', 'name' => 'Apurímac'],
        ['code' => '04', 'name' => 'Arequipa'],
        ['code' => '05', 'name' => 'Ayacucho'],
        ['code' => '06', 'name' => 'Cajamarca'],
        ['code' => '08', 'name' => 'Cusco'],
        ['code' => '15', 'name' => 'Lima'],
    ];

    $provinciasPorDep = [
        '15' => [
            ['code'=>'01','name'=>'Lima'],
            ['code'=>'02','name'=>'Barranca'],
            ['code'=>'03','name'=>'Cajatambo'],
            ['code'=>'04','name'=>'Canta'],
            ['code'=>'05','name'=>'Cañete'],
            ['code'=>'06','name'=>'Huaral'],
            ['code'=>'07','name'=>'Huarochirí'],
            ['code'=>'08','name'=>'Huaura'],
        ],
    ];

    $distritosPorProv = [
        '1501' => [
            ['code'=>'01','name'=>'Lima (Cercado)'],
            ['code'=>'02','name'=>'Ancón'],
            ['code'=>'03','name'=>'Ate'],
            ['code'=>'04','name'=>'Barranco'],
            ['code'=>'22','name'=>'Miraflores'],
            ['code'=>'23','name'=>'Pachacámac'],
            ['code'=>'24','name'=>'Pucusana'],
            ['code'=>'25','name'=>'Pueblo Libre'],
        ],
    ];

    $depName  = collect($departamentos)->firstWhere('code',$dep)['name'] ?? '—';
    $provKey  = $dep.$prov; // ej: 1501
    $provName = collect($provinciasPorDep[$dep] ?? [])->firstWhere('code',$prov)['name'] ?? '—';
    $distName = collect($distritosPorProv[$provKey] ?? [])->firstWhere('code',$dist)['name'] ?? null;

    $ubigeo6 = $distName ? ($dep.$prov.$dist) : null;

    // helper para armar query
    $q = fn($arr) => route('admin.ubigeo.index', array_merge([
        'dep'=>$dep, 'prov'=>$prov, 'dist'=>$dist
    ], $arr));
@endphp

<div class="flex flex-col gap-6">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                <span class="material-icons">map</span>
            </div>
            <div>
                <h1 class="text-xl font-bold leading-tight text-slate-900 dark:text-white">UBIGEO Explorer</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Gestión interna • DESCOSUR</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden md:flex items-center px-3 py-1.5 bg-primary/10 text-primary rounded-full text-sm font-medium">
                <span class="w-2 h-2 rounded-full bg-primary mr-2 animate-pulse"></span>
                Sistema online
            </div>

            <button class="p-2 text-slate-400 hover:text-primary transition-colors" type="button">
                <span class="material-icons">notifications</span>
            </button>

            <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden relative">
                <span class="material-icons absolute top-1 left-1 text-slate-400 dark:text-slate-500">person</span>
            </div>
        </div>
    </div>

    {{-- Breadcrumbs + Search --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <nav class="flex text-sm font-medium text-slate-500 dark:text-slate-400">
            <ol class="flex items-center space-x-2">
                <li><span class="hover:text-primary transition-colors">Perú</span></li>
                <li><span class="material-icons text-base align-middle">chevron_right</span></li>
                <li><a class="hover:text-primary transition-colors {{ $dep ? 'text-primary' : '' }}" href="{{ $q(['dep'=>$dep,'prov'=>null,'dist'=>null]) }}">{{ $depName }}</a></li>

                @if($provName !== '—')
                    <li><span class="material-icons text-base align-middle">chevron_right</span></li>
                    <li><a class="hover:text-primary transition-colors {{ $prov ? 'text-primary' : '' }}" href="{{ $q(['prov'=>$prov,'dist'=>null]) }}">{{ $provName }}</a></li>
                @endif

                <li><span class="material-icons text-base align-middle">chevron_right</span></li>
                <li><span class="text-slate-800 dark:text-slate-200">{{ $distName ? $distName : 'Selecciona distrito' }}</span></li>
            </ol>
        </nav>

        <div class="relative w-full md:w-96 group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-icons text-slate-400 group-focus-within:text-primary transition-colors">search</span>
            </div>
            <input id="ubigeoSearch"
                   class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 dark:border-red-900/20 rounded-lg leading-5 bg-white dark:bg-surface-dark placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition shadow-sm"
                   placeholder="Buscar por código (150122) o nombre..."
                   type="text" />
            <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                <kbd class="hidden sm:inline-block border border-slate-200 dark:border-red-900/20 rounded px-1 text-xs font-mono text-slate-400">Ctrl K</kbd>
            </div>
        </div>
    </div>

    {{-- 3-column layout + detail --}}
    <div class="flex flex-col lg:flex-row gap-4 overflow-hidden">

        {{-- Column 1: Departamentos --}}
        <div class="flex-1 flex flex-col bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-sm overflow-hidden h-[420px] lg:h-[72vh]">
            <div class="px-4 py-3 border-b border-slate-200 dark:border-red-900/20 bg-slate-50/50 dark:bg-white/5 flex justify-between items-center">
                <h2 class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">01. Departamentos</h2>
                <span class="bg-slate-200 dark:bg-white/10 text-slate-600 dark:text-slate-300 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ count($departamentos) }}</span>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1">
                @foreach($departamentos as $d)
                    @php $active = $d['code']===$dep; @endphp
                    <a href="{{ route('admin.ubigeo.index', ['dep'=>$d['code']]) }}"
                       class="w-full text-left px-3 py-2.5 rounded-lg flex items-center justify-between group
                              {{ $active ? 'bg-primary/10 border border-primary/20 shadow-sm' : 'hover:bg-slate-50 dark:hover:bg-white/5 border border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <span class="font-mono text-xs {{ $active ? 'text-primary font-bold bg-white dark:bg-background-dark border border-primary/20' : 'text-slate-400 bg-slate-100 dark:bg-slate-800 group-hover:text-primary' }} px-1.5 py-0.5 rounded transition-colors">
                                {{ $d['code'] }}
                            </span>
                            <span class="{{ $active ? 'font-semibold text-primary' : 'text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white' }}">
                                {{ $d['name'] }}
                            </span>
                        </div>
                        @if($active)
                            <span class="material-icons text-primary text-sm">chevron_right</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Column 2: Provincias --}}
        <div class="flex-1 flex flex-col bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-sm overflow-hidden h-[420px] lg:h-[72vh]">
            <div class="px-4 py-3 border-b border-slate-200 dark:border-red-900/20 bg-slate-50/50 dark:bg-white/5 flex justify-between items-center">
                <h2 class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">02. Provincias</h2>
                <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $depName }}</span>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1">
                @foreach(($provinciasPorDep[$dep] ?? []) as $p)
                    @php $active = $p['code']===$prov; @endphp
                    <a href="{{ $q(['prov'=>$p['code'],'dist'=>null]) }}"
                       class="w-full text-left px-3 py-2.5 rounded-lg flex items-center justify-between group
                              {{ $active ? 'bg-primary/10 border border-primary/20 shadow-sm' : 'hover:bg-slate-50 dark:hover:bg-white/5 border border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <span class="font-mono text-xs {{ $active ? 'text-primary font-bold bg-white dark:bg-background-dark border border-primary/20' : 'text-slate-400 bg-slate-100 dark:bg-slate-800 group-hover:text-primary' }} px-1.5 py-0.5 rounded transition-colors">
                                {{ $p['code'] }}
                            </span>
                            <span class="{{ $active ? 'font-semibold text-primary' : 'text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white' }}">
                                {{ $p['name'] }}
                            </span>
                        </div>
                        @if($active)
                            <span class="material-icons text-primary text-sm">chevron_right</span>
                        @endif
                    </a>
                @endforeach

                @if(empty($provinciasPorDep[$dep]))
                    <div class="p-4 text-sm text-slate-500 dark:text-slate-400">
                        No hay provincias cargadas para este departamento (mock).
                    </div>
                @endif
            </div>
        </div>

        {{-- Column 3: Distritos --}}
        <div class="flex-1 flex flex-col bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-sm overflow-hidden h-[420px] lg:h-[72vh]">
            <div class="px-4 py-3 border-b border-slate-200 dark:border-red-900/20 bg-slate-50/50 dark:bg-white/5 flex justify-between items-center">
                <h2 class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">03. Distritos</h2>
                <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $provName }}</span>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1">
                @foreach(($distritosPorProv[$provKey] ?? []) as $di)
                    @php $active = $di['code']===$dist; @endphp
                    <a href="{{ $q(['dist'=>$di['code']]) }}"
                       class="w-full text-left px-3 py-2.5 rounded-lg flex items-center justify-between group
                              {{ $active ? 'bg-primary/10 border border-primary/20 shadow-sm' : 'hover:bg-slate-50 dark:hover:bg-white/5 border border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <span class="font-mono text-xs {{ $active ? 'text-primary font-bold bg-white dark:bg-background-dark border border-primary/20' : 'text-slate-400 bg-slate-100 dark:bg-slate-800 group-hover:text-primary' }} px-1.5 py-0.5 rounded transition-colors">
                                {{ $di['code'] }}
                            </span>
                            <span class="{{ $active ? 'font-semibold text-primary' : 'text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white' }}">
                                {{ $di['name'] }}
                            </span>
                        </div>
                        @if($active)
                            <span class="material-icons text-primary text-sm">visibility</span>
                        @endif
                    </a>
                @endforeach

                @if(empty($distritosPorProv[$provKey]))
                    <div class="p-4 text-sm text-slate-500 dark:text-slate-400">
                        Selecciona una provincia para ver sus distritos.
                    </div>
                @endif
            </div>
        </div>

        {{-- Detail panel --}}
        <div class="w-full lg:w-96 flex flex-col bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-red-900/20 shadow-xl overflow-hidden h-fit lg:h-[72vh] lg:sticky lg:top-24">
            <div class="h-32 bg-slate-100 dark:bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-slate-200 dark:to-slate-900 mix-blend-multiply"></div>

                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                    <div class="bg-white/90 dark:bg-black/60 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm border border-white/20">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block uppercase tracking-wide">UBIGEO</span>
                        <span class="text-2xl font-mono font-bold text-primary">{{ $ubigeo6 ?? '—' }}</span>
                    </div>
                    <button class="bg-white dark:bg-slate-700 p-2 rounded-full shadow-md text-slate-500 hover:text-primary transition-colors" type="button">
                        <span class="material-icons text-sm">open_in_new</span>
                    </button>
                </div>
            </div>

            <div class="p-6 flex flex-col gap-6 overflow-y-auto custom-scrollbar">
                @if($distName)
                    <div>
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $distName }}</h2>
                                <p class="text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1 text-sm">
                                    <span class="material-icons text-sm">place</span> {{ $depName }}, {{ $provName }}
                                </p>
                            </div>
                            <button class="p-2 text-slate-400 hover:text-primary border border-transparent hover:border-slate-200 dark:hover:border-red-900/20 rounded-lg transition-all" type="button">
                                <span class="material-icons">edit</span>
                            </button>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md shadow-primary/30 transition-all flex justify-center items-center gap-2" type="button">
                                <span class="material-icons text-sm">add</span> Nuevo proyecto
                            </button>
                            <button class="flex-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-red-900/20 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-50 dark:hover:bg-white/5 transition-all" type="button">
                                Ver reporte
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-slate-50 dark:bg-white/5 rounded-lg border border-slate-100 dark:border-red-900/10">
                            <span class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Proyectos activos</span>
                            <div class="text-xl font-bold text-slate-800 dark:text-white mt-1">12</div>
                        </div>
                        <div class="p-3 bg-slate-50 dark:bg-white/5 rounded-lg border border-slate-100 dark:border-red-900/10">
                            <span class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Beneficiarios</span>
                            <div class="text-xl font-bold text-slate-800 dark:text-white mt-1">2.4k</div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wide">Actividad reciente</h3>
                            <a class="text-xs text-primary font-semibold hover:underline" href="#">Ver todo</a>
                        </div>

                        <div class="space-y-3">
                            <div class="group bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-100 dark:border-red-900/10 hover:border-primary/30 hover:shadow-md transition-all cursor-pointer">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">Educación</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400">Hace 2h</span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors">
                                    Mejoramiento de infraestructura escolar
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">
                                    Renovación de 3 escuelas primarias en la zona norte del distrito.
                                </p>
                            </div>

                            <div class="group bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-100 dark:border-red-900/10 hover:border-primary/30 hover:shadow-md transition-all cursor-pointer">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">Salud</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400">Hace 1d</span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors">
                                    Campaña de salud comunitaria
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">
                                    Coordinación de campaña de vacunación y control preventivo.
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-sm text-slate-500 dark:text-slate-400">
                        Selecciona un distrito para ver el detalle.
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ctrl/Cmd + K para enfocar búsqueda
    document.addEventListener('keydown', (e) => {
        const isMac = navigator.platform.toUpperCase().includes('MAC');
        const combo = isMac ? (e.metaKey && e.key.toLowerCase() === 'k') : (e.ctrlKey && e.key.toLowerCase() === 'k');
        if (combo) {
            e.preventDefault();
            const el = document.getElementById('ubigeoSearch');
            if (el) el.focus();
        }
    });
</script>
@endpush
