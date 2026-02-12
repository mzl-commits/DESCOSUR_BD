@extends('layouts.admin')

@section('title', 'Detalle de documento - DESCOSUR')

@push('head')
<style>
    /* Scrollbar para timeline / preview */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #4b5563; }
</style>
@endpush

@section('content')
@php
    // Datos mock (luego lo conectas con BD)
    $docNombre   = $docNombre   ?? '2023_Q3_Informe_Financiero_Peru.pdf';
    $docVersion  = $docVersion  ?? '3.2';
    $docAutor    = $docAutor    ?? 'María G.';
    $docEstado   = $docEstado   ?? 'Finalizado';

    $docTipo     = $docTipo     ?? 'Documento PDF';
    $docSize     = $docSize     ?? '4.2 MB';
    $docCreado   = $docCreado   ?? '24 Oct 2023, 10:42 AM';
    $docModif    = $docModif    ?? '25 Oct 2023, 09:15 AM';
    $docHash     = $docHash     ?? 'a1b2c3d4e5f6g7h8i9j0';

    $tags = $tags ?? ['#finanzas', '#revision-anual', '#confidencial'];
@endphp

<div class="max-w-[1600px] mx-auto w-full">

    {{-- Breadcrumbs + volver --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('admin.documentos.index') }}" class="hover:text-primary transition-colors">Documentos</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 dark:text-slate-200 font-medium truncate max-w-[380px] inline-block align-bottom">
                {{ $docNombre }}
            </span>
        </div>

        <a href="{{ route('admin.documentos.index') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">
            <span class="material-icons text-[18px]">arrow_back</span>
            Volver
        </a>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">

        {{-- Columna izquierda --}}
        <div class="lg:col-span-4 xl:col-span-3 flex flex-col gap-6">

            {{-- Cabecera documento --}}
            <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-100 dark:border-red-900/20 p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-lg text-primary">
                        <span class="material-icons text-3xl">picture_as_pdf</span>
                    </div>

                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                        {{ $docEstado }}
                    </span>
                </div>

                <h1 class="text-xl font-bold text-slate-900 dark:text-white mb-2 break-words leading-tight">
                    {{ $docNombre }}
                </h1>

                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
                    Versión {{ $docVersion }} • Subido por {{ $docAutor }}
                </p>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button type="button"
                            class="flex items-center justify-center gap-2 bg-primary hover:bg-[color:var(--primary-dark,#d01a2f)] text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md shadow-primary/20">
                        <span class="material-icons text-[18px]">download</span>
                        Descargar
                    </button>

                    <button type="button"
                            class="flex items-center justify-center gap-2 bg-white dark:bg-transparent border border-slate-200 dark:border-red-900/30 hover:bg-slate-50 dark:hover:bg-red-900/10 text-slate-700 dark:text-slate-200 px-4 py-2.5 rounded-lg text-sm font-semibold transition-all">
                        <span class="material-icons text-[18px]">share</span>
                        Compartir
                    </button>
                </div>

                <div class="flex gap-2">
                    <button type="button"
                            class="flex-1 flex items-center justify-center gap-2 text-slate-500 hover:text-primary text-xs font-medium py-2 rounded hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                        <span class="material-icons text-[16px]">edit</span>
                        Editar metadatos
                    </button>

                    <button type="button"
                            class="flex-1 flex items-center justify-center gap-2 text-slate-500 hover:text-primary text-xs font-medium py-2 rounded hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                        <span class="material-icons text-[16px]">history</span>
                        Versiones
                    </button>
                </div>
            </div>

            {{-- Metadatos --}}
            <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-100 dark:border-red-900/20 p-5">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4 border-b border-slate-100 dark:border-red-900/20 pb-2">
                    Detalles del archivo
                </h3>

                <dl class="space-y-4 text-sm">
                    <div class="grid grid-cols-3 gap-2">
                        <dt class="text-slate-500 dark:text-slate-400">Tipo</dt>
                        <dd class="col-span-2 font-medium text-slate-800 dark:text-slate-200">{{ $docTipo }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <dt class="text-slate-500 dark:text-slate-400">Tamaño</dt>
                        <dd class="col-span-2 font-medium text-slate-800 dark:text-slate-200">{{ $docSize }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <dt class="text-slate-500 dark:text-slate-400">Creado</dt>
                        <dd class="col-span-2 font-medium text-slate-800 dark:text-slate-200">{{ $docCreado }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <dt class="text-slate-500 dark:text-slate-400">Modificado</dt>
                        <dd class="col-span-2 font-medium text-slate-800 dark:text-slate-200">{{ $docModif }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <dt class="text-slate-500 dark:text-slate-400">Checksum</dt>
                        <dd class="col-span-2 font-mono text-xs text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-black/20 p-1.5 rounded break-all">
                            {{ $docHash }}
                        </dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <h4 class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase">Etiquetas</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                                {{ $tag }}
                            </span>
                        @endforeach
                        <button type="button"
                                class="inline-flex items-center justify-center w-6 h-6 rounded-md text-xs font-medium bg-transparent text-slate-400 border border-dashed border-slate-300 hover:border-primary hover:text-primary transition-colors">
                            <span class="material-icons text-[14px]">add</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Auditoría --}}
            <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-100 dark:border-red-900/20 flex-1 flex flex-col overflow-hidden max-h-[420px]">
                <div class="p-4 border-b border-slate-100 dark:border-red-900/20 flex justify-between items-center bg-slate-50 dark:bg-black/10">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">
                        Registro de auditoría
                    </h3>
                    <button type="button" class="text-xs text-primary font-medium hover:underline">Ver todo</button>
                </div>

                <div class="overflow-y-auto custom-scrollbar p-5">
                    <ol class="relative border-l border-slate-200 dark:border-red-900/20 ml-2">

                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-5 h-5 bg-blue-100 rounded-full -left-2.5 ring-4 ring-white dark:ring-neutral-surface-dark dark:bg-blue-900/30">
                                <span class="material-icons text-[10px] text-blue-600 dark:text-blue-300">visibility</span>
                            </span>
                            <h3 class="mb-1 text-sm font-semibold text-slate-900 dark:text-white">Documento visto</h3>
                            <time class="block mb-1 text-xs text-slate-400">Hace un momento</time>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Accedido por <span class="text-slate-700 dark:text-slate-300 font-medium">Juan P.</span>
                            </p>
                        </li>

                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-5 h-5 bg-primary/20 rounded-full -left-2.5 ring-4 ring-white dark:ring-neutral-surface-dark">
                                <span class="material-icons text-[10px] text-primary">edit</span>
                            </span>
                            <h3 class="mb-1 text-sm font-semibold text-slate-900 dark:text-white">Metadatos actualizados</h3>
                            <time class="block mb-1 text-xs text-slate-400">Hoy, 10:00 AM</time>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Etiquetas actualizadas por <span class="text-slate-700 dark:text-slate-300 font-medium">María G.</span>
                            </p>
                        </li>

                        <li class="mb-6 ml-6">
                            <span class="absolute flex items-center justify-center w-5 h-5 bg-green-100 rounded-full -left-2.5 ring-4 ring-white dark:ring-neutral-surface-dark dark:bg-green-900/30">
                                <span class="material-icons text-[10px] text-green-600 dark:text-green-300">check</span>
                            </span>
                            <h3 class="mb-1 text-sm font-semibold text-slate-900 dark:text-white">Estado cambiado</h3>
                            <time class="block mb-1 text-xs text-slate-400">Ayer, 4:30 PM</time>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Cambiado a “{{ $docEstado }}”
                            </p>
                        </li>

                        <li class="ml-6">
                            <span class="absolute flex items-center justify-center w-5 h-5 bg-slate-100 rounded-full -left-2.5 ring-4 ring-white dark:ring-neutral-surface-dark dark:bg-slate-700">
                                <span class="material-icons text-[10px] text-slate-500">upload</span>
                            </span>
                            <h3 class="mb-1 text-sm font-semibold text-slate-900 dark:text-white">Archivo subido</h3>
                            <time class="block mb-1 text-xs text-slate-400">24 Oct 2023</time>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Carga inicial v1.0</p>
                        </li>

                    </ol>
                </div>
            </div>

        </div>

        {{-- Columna derecha: Vista previa --}}
        <div class="lg:col-span-8 xl:col-span-9 flex flex-col min-h-[650px]">
            <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-100 dark:border-red-900/20 flex flex-col h-full overflow-hidden">

                {{-- Toolbar --}}
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-red-900/20 bg-slate-50 dark:bg-black/10">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center bg-white dark:bg-black/20 border border-slate-200 dark:border-red-900/30 rounded-md shadow-sm">
                            <button type="button" class="p-1.5 hover:bg-slate-50 dark:hover:bg-red-900/10 text-slate-500 transition-colors border-r border-slate-200 dark:border-red-900/30">
                                <span class="material-icons text-[18px]">keyboard_arrow_up</span>
                            </button>
                            <div class="px-3 text-xs font-medium text-slate-600 dark:text-slate-300 min-w-[60px] text-center">
                                1 / 14
                            </div>
                            <button type="button" class="p-1.5 hover:bg-slate-50 dark:hover:bg-red-900/10 text-slate-500 transition-colors border-l border-slate-200 dark:border-red-900/30">
                                <span class="material-icons text-[18px]">keyboard_arrow_down</span>
                            </button>
                        </div>

                        <div class="h-6 w-px bg-slate-300 dark:bg-red-900/30"></div>

                        <div class="flex items-center gap-1">
                            <button type="button" class="p-1.5 rounded hover:bg-slate-200 dark:hover:bg-red-900/10 text-slate-500 transition-colors" title="Alejar">
                                <span class="material-icons text-[18px]">remove</span>
                            </button>
                            <span class="text-xs font-medium text-slate-600 dark:text-slate-300 w-12 text-center">100%</span>
                            <button type="button" class="p-1.5 rounded hover:bg-slate-200 dark:hover:bg-red-900/10 text-slate-500 transition-colors" title="Acercar">
                                <span class="material-icons text-[18px]">add</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" class="p-1.5 rounded hover:bg-slate-200 dark:hover:bg-red-900/10 text-slate-500 transition-colors" title="Rotar">
                            <span class="material-icons text-[18px]">rotate_right</span>
                        </button>
                        <button type="button" class="p-1.5 rounded hover:bg-slate-200 dark:hover:bg-red-900/10 text-slate-500 transition-colors" title="Imprimir">
                            <span class="material-icons text-[18px]">print</span>
                        </button>
                        <button type="button" class="p-1.5 rounded hover:bg-slate-200 dark:hover:bg-red-900/10 text-slate-500 transition-colors" title="Expandir">
                            <span class="material-icons text-[18px]">open_in_full</span>
                        </button>
                    </div>
                </div>

                {{-- Área preview (placeholder) --}}
                <div class="flex-1 bg-slate-200 dark:bg-black/20 overflow-auto relative flex justify-center p-8 custom-scrollbar">
                    <div class="w-full max-w-[800px] bg-white shadow-lg min-h-[1000px] relative">
                        <div class="p-16 space-y-8 opacity-80 pointer-events-none select-none">

                            <div class="flex justify-between items-end border-b-2 border-black pb-4 mb-12">
                                <div>
                                    <div class="w-32 h-8 bg-slate-800 mb-2"></div>
                                    <div class="w-48 h-4 bg-slate-400"></div>
                                </div>
                                <div class="text-right">
                                    <div class="w-24 h-4 bg-slate-400 mb-1 ml-auto"></div>
                                    <div class="w-32 h-4 bg-slate-400 ml-auto"></div>
                                </div>
                            </div>

                            <div class="w-3/4 h-8 bg-slate-800 mb-8"></div>

                            <div class="space-y-3">
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-2/3 h-3 bg-slate-300"></div>
                            </div>

                            <div class="py-8">
                                <div class="w-full h-64 bg-slate-100 border border-slate-200 flex items-center justify-center">
                                    <div class="w-4/5 h-4/5 flex items-end justify-around gap-4">
                                        <div class="w-12 bg-primary/40 h-[40%]"></div>
                                        <div class="w-12 bg-primary/60 h-[70%]"></div>
                                        <div class="w-12 bg-primary/80 h-[50%]"></div>
                                        <div class="w-12 bg-primary h-[90%]"></div>
                                    </div>
                                </div>
                                <div class="text-xs text-center text-slate-400 mt-2 italic">
                                    Figura 1.1: Distribución anual
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-5/6 h-3 bg-slate-300"></div>
                            </div>

                            <div class="space-y-3 pt-4">
                                <div class="w-1/3 h-5 bg-slate-700 mb-2"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                                <div class="w-full h-3 bg-slate-300"></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center text-xs text-slate-400 dark:text-slate-500 pt-4">
                © {{ date('Y') }} DESCOSUR — Gestión interna de documentos.
            </div>
        </div>

    </div>
</div>
@endsection
