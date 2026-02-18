@extends('layouts.usuario')

@section('title', 'Subir Documento - DESCOSUR')
@section('page_title', 'Subir Documento')

@push('head')
<style>
    /* Scrollbar en textarea */
    textarea::-webkit-scrollbar { width: 8px; }
    textarea::-webkit-scrollbar-track { background: #f1f1f1; }
    textarea::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
    textarea::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

    .file-drop-active {
        border-color: #ef253c !important;
        background-color: rgba(239, 37, 60, 0.05) !important;
    }
</style>
@endpush

@section('content')
@php
$cancelUrl = route('usuario.documentos.index'); // debería resolver
$storeUrl = route('usuario.documentos.store');  // debería resolver
@endphp

{{-- Encabezado --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Subir nuevo documento</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">
            Completa los datos para clasificar y archivar un documento en DESCOSUR.
        </p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ $cancelUrl }}"
           class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 bg-white dark:bg-black/20 border border-slate-200 dark:border-red-900/30 rounded-lg hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
            Cancelar
        </a>

        <button type="submit" form="docForm"
                class="px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg shadow-lg shadow-primary/30 transition-colors inline-flex items-center gap-2">
            <span class="material-icons text-sm">cloud_upload</span>
            Subir documento
        </button>
    </div>
</div>

<form id="docForm" action="{{ $storeUrl }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mt-6">
    @csrf

    {{-- Columna izquierda --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- 1) Clasificación --}}
        <section class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 overflow-hidden">
            <div class="border-b border-slate-100 dark:border-red-900/20 px-6 py-4 flex items-center gap-3">
                <div class="p-2 bg-primary/10 rounded-lg text-primary">
                    <span class="material-icons">category</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Clasificación</h3>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Sector --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="sector_id">Sector</label>
                    <select name="sector_id" id="sector_id"
                            class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5">
                        <option value="">Selecciona un sector…</option>
                        <option value="educacion">Educación</option>
                        <option value="salud">Salud</option>
                        <option value="medio_ambiente">Medio ambiente</option>
                        <option value="desarrollo">Desarrollo económico</option>
                    </select>
                </div>

                {{-- Proyecto --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="proyecto_id">Código / Proyecto</label>
                    <select name="proyecto_id" id="proyecto_id"
                            class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5">
                        <option value="">Selecciona un proyecto…</option>
                        <option value="EDU-2024-01">EDU-2024-01 (Alfabetización Rural)</option>
                        <option value="SAL-2024-02">SAL-2024-02 (Campaña Vacunación)</option>
                    </select>
                </div>

                {{-- UBIGEO --}}
                <div class="md:col-span-2 space-y-3">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 flex items-center gap-2">
                        <span class="material-icons text-slate-400 text-sm">place</span>
                        Ubicación (UBIGEO)
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-slate-50 dark:bg-black/10 p-4 rounded-lg border border-slate-100 dark:border-red-900/20">
                        <div>
                            <span class="text-xs text-slate-500 uppercase font-semibold mb-1 block">Departamento</span>
                            <select name="departamento" class="block w-full rounded-md border-slate-300 dark:border-red-900/30 text-sm focus:border-primary focus:ring-primary bg-white dark:bg-black/20 text-slate-900 dark:text-white">
                                <option>Lima</option>
                                <option>Cusco</option>
                                <option>Arequipa</option>
                            </select>
                        </div>

                        <div>
                            <span class="text-xs text-slate-500 uppercase font-semibold mb-1 block">Provincia</span>
                            <select name="provincia" class="block w-full rounded-md border-slate-300 dark:border-red-900/30 text-sm focus:border-primary focus:ring-primary bg-white dark:bg-black/20 text-slate-900 dark:text-white">
                                <option>Lima</option>
                                <option>Cañete</option>
                                <option>Huaral</option>
                            </select>
                        </div>

                        <div>
                            <span class="text-xs text-slate-500 uppercase font-semibold mb-1 block">Distrito</span>
                            <select name="distrito" class="block w-full rounded-md border-slate-300 dark:border-red-900/30 text-sm focus:border-primary focus:ring-primary bg-white dark:bg-black/20 text-slate-900 dark:text-white">
                                <option>Miraflores</option>
                                <option>San Isidro</option>
                                <option>Barranco</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2) Detalles del documento --}}
        <section class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 overflow-hidden">
            <div class="border-b border-slate-100 dark:border-red-900/20 px-6 py-4 flex items-center gap-3">
                <div class="p-2 bg-primary/10 rounded-lg text-primary">
                    <span class="material-icons">description</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Detalles del documento</h3>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="nombre">Nombre del documento</label>
                        <input name="nombre" id="nombre" type="text"
                               placeholder="Ej: Informe Técnico Q1"
                               class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5"/>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="fecha_emision">Fecha de emisión</label>
                        <input name="fecha_emision" id="fecha_emision" type="date"
                               class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="tipo">Tipo de documento</label>
                        <select name="tipo" id="tipo"
                                class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm py-2.5">
                            <option>Reporte PDF</option>
                            <option>Hoja de cálculo (Excel)</option>
                            <option>Documento Word</option>
                            <option>Contrato / Legal</option>
                            <option>Evidencia (Imagen)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="tags">Etiquetas</label>

                        {{-- Demo UI (luego lo haces dinámico si quieres) --}}
                        <div class="flex flex-wrap items-center gap-2 p-2 w-full rounded-lg border border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 shadow-sm focus-within:border-primary focus-within:ring-1 focus-within:ring-primary min-h-[46px]">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary/10 text-primary">
                                Finanzas
                                <button class="ml-1 inline-flex text-primary hover:text-primary-dark focus:outline-none" type="button">
                                    <span class="sr-only">Quitar etiqueta</span>
                                    <svg class="h-2 w-2" fill="none" stroke="currentColor" viewBox="0 0 8 8">
                                        <path d="M1 1l6 6m0-6L1 7" stroke-linecap="round" stroke-width="1.5"></path>
                                    </svg>
                                </button>
                            </span>

                            <input name="tags" id="tags"
                                   class="flex-1 bg-transparent border-none p-0 focus:ring-0 text-sm text-slate-900 dark:text-white placeholder-slate-400"
                                   placeholder="Agregar etiquetas… (Enter)"
                                   type="text"/>
                        </div>

                        <p class="text-xs text-slate-500 dark:text-slate-400">Presiona Enter para agregar una etiqueta.</p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                              placeholder="Resumen breve del contenido del documento…"
                              class="block w-full rounded-lg border-slate-300 dark:border-red-900/30 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3"></textarea>
                </div>
            </div>
        </section>
    </div>

    {{-- Columna derecha: archivo --}}
    <aside class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 sticky top-24 overflow-hidden">
            <div class="border-b border-slate-100 dark:border-red-900/20 px-6 py-4 flex items-center gap-3">
                <div class="p-2 bg-primary/10 rounded-lg text-primary">
                    <span class="material-icons">attach_file</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Adjuntar archivo</h3>
            </div>

            <div class="p-6 space-y-6">
                {{-- Zona drag & drop --}}
                <div class="w-full">
                    <label id="dropZone"
                           class="flex justify-center w-full h-48 px-4 transition bg-white dark:bg-black/10 border-2 border-slate-300 dark:border-red-900/30 border-dashed rounded-xl appearance-none cursor-pointer hover:border-primary hover:bg-slate-50 dark:hover:bg-white/5 focus:outline-none">
                        <span class="flex flex-col items-center justify-center text-center">
                            <div class="h-12 w-12 rounded-full bg-slate-100 dark:bg-white/10 flex items-center justify-center mb-3">
                                <span class="material-icons text-slate-500 dark:text-slate-300">cloud_upload</span>
                            </div>

                            <span class="font-semibold text-slate-700 dark:text-slate-200">
                                Suelta el archivo aquí, o
                                <span class="text-primary underline">explora</span>
                            </span>

                            <span class="text-xs text-slate-500 dark:text-slate-400 mt-2 max-w-[220px]">
                                Máximo 25MB. Permitidos: PDF, DOCX, XLSX, JPG, PNG.
                            </span>
                        </span>

                        <input id="fileInput" class="hidden" name="archivo" type="file" />
                    </label>
                </div>

                {{-- Preview / estado --}}
                <div class="bg-slate-50 dark:bg-black/10 rounded-lg p-4 border border-slate-100 dark:border-red-900/20">
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Archivo seleccionado</h4>

                    <div id="filePreview" class="text-sm text-slate-600 dark:text-slate-300">
                        <span class="text-slate-500 dark:text-slate-400">Aún no seleccionaste un archivo.</span>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-blue-500 text-sm mt-0.5">info</span>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-1">Convención de nombres</h4>
                            <p class="text-xs text-blue-600 dark:text-blue-400 leading-relaxed">
                                Usa el formato:<br>
                                <span class="font-mono bg-blue-100 dark:bg-blue-900/40 px-1 rounded">
                                    YYYY-MM-DD_CodigoProyecto_NombreDocumento
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Nota si aún no tienes store --}}
                @if($storeUrl === '#')
                    <div class="text-xs text-slate-500 dark:text-slate-400">
                        Nota: aún no existe la ruta <span class="font-mono">admin.documentos.store</span>. La vista está lista; cuando crees el controlador, conectas el action.
                    </div>
                @endif
            </div>
        </div>
    </aside>
</form>
@endsection

@push('scripts')
<script>
(function () {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');

    if (!dropZone || !fileInput || !filePreview) return;

    const setPreview = (file) => {
        if (!file) {
            filePreview.innerHTML = '<span class="text-slate-500">Aún no seleccionaste un archivo.</span>';
            return;
        }

        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        filePreview.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="h-10 w-10 rounded bg-primary/10 flex items-center justify-center text-primary shrink-0">
                    <span class="material-icons">description</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white truncate" title="${file.name}">
                        ${file.name}
                    </p>
                    <p class="text-xs text-slate-500">${sizeMB} MB</p>
                </div>
                <button type="button" id="clearFile" class="text-slate-400 hover:text-red-500">
                    <span class="material-icons text-base">close</span>
                </button>
            </div>
        `;

        document.getElementById('clearFile')?.addEventListener('click', () => {
            fileInput.value = '';
            setPreview(null);
        });
    };

    // input normal
    fileInput.addEventListener('change', () => setPreview(fileInput.files?.[0] || null));

    // drag events
    ['dragenter', 'dragover'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.add('file-drop-active');
        });
    });

    ['dragleave', 'drop'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('file-drop-active');
        });
    });

    dropZone.addEventListener('drop', (e) => {
        const files = e.dataTransfer?.files;
        if (!files || !files.length) return;
        fileInput.files = files;
        setPreview(files[0]);
    });
})();
</script>
@endpush
