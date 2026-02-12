@extends('layouts.admin')

@section('title', 'Auditoría del Sistema')
@section('page_title', 'Auditoría')

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<style>
  .font-display{ font-family: Manrope, sans-serif; }
  .font-mono{ font-family: "JetBrains Mono", monospace; }

  .custom-scrollbar::-webkit-scrollbar { width: 6px; }
  .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
  .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 6px; }
  .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

{{-- Alpine (si tu layout ya lo carga, elimina esta línea) --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
@php
  $logs = [
    [
      'id' => 'log_992811',
      'type_icon' => 'warning',
      'type_color' => 'text-primary',
      'type_title' => 'Acción crítica',
      'user' => 'Elena R.',
      'role' => 'Admin',
      'action' => 'DELETE',
      'action_badge' => 'bg-primary/10 text-primary border border-primary/20',
      'entity' => 'Propuesta de Beca #2024-A',
      'entity_id' => 'doc_88291',
      'ip' => '192.168.1.142',
      'ts' => '27 Oct, 14:32:01',
      'drawer' => [
        'title' => 'Eliminación de recurso',
        'actor' => 'Elena R.',
        'actor_avatar' => null,
        'ip' => '192.168.1.142',
        'entity_type' => 'Documento PDF',
        'timestamp' => '27 Oct, 2023 - 14:32:01',
        'context' => 'El usuario eliminó el documento "Propuesta de Beca #2024-A". Esta acción es irreversible y fue realizada por un rol administrador.',
        'json' => '{
  "event_id": "evt_8839209",
  "action": "DELETE",
  "entity": { "type": "document", "id": "doc_88291" },
  "reason": "Limpieza / duplicado",
  "security_flags": true
}',
      ]
    ],
    [
      'id' => 'log_992812',
      'type_icon' => 'edit',
      'type_color' => 'text-blue-500',
      'type_title' => 'Actualización',
      'user' => 'Carlos M.',
      'role' => 'Editor',
      'action' => 'UPDATE',
      'action_badge' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800',
      'entity' => 'Lista de Beneficiarios T3',
      'entity_id' => 'xls_33910',
      'ip' => '192.168.1.105',
      'ts' => '27 Oct, 11:15:22',
      'drawer' => [
        'title' => 'Actualización de recurso',
        'actor' => 'Carlos M.',
        'actor_avatar' => null,
        'ip' => '192.168.1.105',
        'entity_type' => 'Hoja Excel',
        'timestamp' => '27 Oct, 2023 - 11:15:22',
        'context' => "El usuario actualizó la Lista de Beneficiarios T3. Cambios: agregó 3 filas y modificó la columna 'Estado' para registros de la región Huánuco.",
        'json' => '{
  "event_id": "evt_8839201",
  "action": "UPDATE",
  "changes": {
    "rows_added": 3,
    "modified_fields": ["status", "last_edited_by"],
    "region": "Huanuco"
  },
  "previous_state": { "status": "draft", "version": 1.2 },
  "new_state": { "status": "review_pending", "version": 1.3 },
  "security_flags": false
}',
      ]
    ],
    [
      'id' => 'log_992813',
      'type_icon' => 'add_circle',
      'type_color' => 'text-green-500',
      'type_title' => 'Carga',
      'user' => 'Sofia L.',
      'role' => 'Encargado',
      'action' => 'UPLOAD',
      'action_badge' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800',
      'entity' => 'Presupuesto Anual 2024',
      'entity_id' => 'pdf_00293',
      'ip' => '10.0.0.45',
      'ts' => '26 Oct, 09:45:10',
      'drawer' => [
        'title' => 'Carga de archivo',
        'actor' => 'Sofia L.',
        'actor_avatar' => null,
        'ip' => '10.0.0.45',
        'entity_type' => 'Documento PDF',
        'timestamp' => '26 Oct, 2023 - 09:45:10',
        'context' => 'El usuario subió "Presupuesto Anual 2024". El archivo fue indexado y etiquetado automáticamente.',
        'json' => '{
  "event_id": "evt_8839102",
  "action": "UPLOAD",
  "file": { "name": "Presupuesto Anual 2024", "id": "pdf_00293" },
  "tags_applied": ["Finanzas", "T4-2024"],
  "security_flags": false
}',
      ]
    ],
    [
      'id' => 'log_992814',
      'type_icon' => 'login',
      'type_color' => 'text-slate-400',
      'type_title' => 'Inicio de sesión',
      'user' => 'Miguel P.',
      'role' => 'Auditor',
      'action' => 'LOGIN',
      'action_badge' => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700',
      'entity' => 'Acceso al sistema',
      'entity_id' => 'sess_921',
      'ip' => '200.121.18.9',
      'ts' => '26 Oct, 08:30:00',
      'drawer' => [
        'title' => 'Inicio de sesión',
        'actor' => 'Miguel P.',
        'actor_avatar' => null,
        'ip' => '200.121.18.9',
        'entity_type' => 'Sesión',
        'timestamp' => '26 Oct, 2023 - 08:30:00',
        'context' => 'El usuario se autenticó correctamente y accedió a la consola administrativa.',
        'json' => '{
  "event_id": "evt_8839001",
  "action": "LOGIN",
  "session": "sess_921",
  "mfa": true,
  "security_flags": false
}',
      ]
    ],
    [
      'id' => 'log_992815',
      'type_icon' => 'lock_clock',
      'type_color' => 'text-orange-500',
      'type_title' => 'Alerta de autenticación',
      'user' => 'Desconocido',
      'role' => 'Externo',
      'action' => 'AUTH_FAIL',
      'action_badge' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 border border-orange-200 dark:border-orange-800',
      'entity' => 'Acceso al sistema',
      'entity_id' => 'Intento #3',
      'ip' => '45.23.11.2',
      'ts' => '25 Oct, 03:12:01',
      'drawer' => [
        'title' => 'Fallo de autenticación',
        'actor' => 'Desconocido',
        'actor_avatar' => null,
        'ip' => '45.23.11.2',
        'entity_type' => 'Evento de autenticación',
        'timestamp' => '25 Oct, 2023 - 03:12:01',
        'context' => 'Se detectaron múltiples intentos fallidos desde una IP externa. Considera rate limiting o bloqueo si se repite.',
        'json' => '{
  "event_id": "evt_8838701",
  "action": "AUTH_FAIL",
  "attempt": 3,
  "ip": "45.23.11.2",
  "lockout": true,
  "security_flags": true
}',
      ]
    ],
  ];
@endphp

<div
  class="font-display"
  x-data="{
    open: false,
    active: null,
    openDrawer(log){ this.active = log; this.open = true; },
    closeDrawer(){ this.open = false; },
    copyJson(){
      if(!this.active) return;
      navigator.clipboard?.writeText(this.active.drawer.json ?? '');
    }
  }"
>

  <main class="p-4 lg:p-8 relative">

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
      <div>
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
          <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
          <span class="material-icons-outlined text-xs">chevron_right</span>
          <span class="text-slate-900 dark:text-white font-medium">Auditoría</span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">
          Auditoría del sistema
        </h2>

        <p class="text-slate-500 dark:text-slate-400 mt-1 max-w-2xl">
          Revisa modificaciones, eventos de seguridad y actividad de usuarios para fines de cumplimiento y trazabilidad.
        </p>
      </div>

      <div class="flex gap-3">
        <button
          class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-neutral-surface-dark border border-slate-200 dark:border-red-900/20 rounded-lg text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors"
          type="button"
        >
          <span class="material-icons-outlined text-lg">download</span>
          Exportar CSV
        </button>

        <button
          class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark shadow-sm shadow-primary/30 transition-colors"
          type="button"
        >
          <span class="material-icons-outlined text-lg">picture_as_pdf</span>
          Generar reporte
        </button>
      </div>
    </div>

    {{-- Filtros --}}
    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-red-900/20 p-4 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

        <div class="md:col-span-4 lg:col-span-3">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Buscar</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input
              class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-black/20 border border-slate-200 dark:border-red-900/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 text-slate-700 dark:text-slate-200"
              placeholder="Usuario, entidad, ID..."
              type="text"
            >
          </div>
        </div>

        <div class="md:col-span-3 lg:col-span-3">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Rango de fechas</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">calendar_today</span>
            <input
              class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-black/20 border border-slate-200 dark:border-red-900/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 text-slate-700 dark:text-slate-200 cursor-pointer"
              type="text"
              value="20 Oct, 2023 - 27 Oct, 2023"
            >
          </div>
        </div>

        <div class="md:col-span-3 lg:col-span-2">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Acción</label>
          <select class="w-full pl-3 pr-8 py-2 bg-slate-50 dark:bg-black/20 border border-slate-200 dark:border-red-900/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 text-slate-700 dark:text-slate-200">
            <option>Todas</option>
            <option>Crear</option>
            <option>Actualizar</option>
            <option>Eliminar</option>
            <option>Login</option>
          </select>
        </div>

        <div class="md:col-span-2 lg:col-span-2">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Rol</label>
          <select class="w-full pl-3 pr-8 py-2 bg-slate-50 dark:bg-black/20 border border-slate-200 dark:border-red-900/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 text-slate-700 dark:text-slate-200">
            <option>Todos</option>
            <option>Admin</option>
            <option>Encargado</option>
            <option>Lector</option>
          </select>
        </div>

        <div class="md:col-span-12 lg:col-span-2 flex justify-end md:justify-start">
          <button class="text-sm text-primary hover:text-primary-dark font-medium underline decoration-2 decoration-primary/20 hover:decoration-primary underline-offset-4 transition-all" type="button">
            Reiniciar filtros
          </button>
        </div>
      </div>
    </div>

    {{-- Tabla --}}
    <div class="bg-white dark:bg-neutral-surface-dark rounded-xl shadow-lg border border-slate-200 dark:border-red-900/20 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 dark:bg-red-900/10 border-b border-slate-200 dark:border-red-900/20">
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 w-16 text-center">Tipo</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Usuario</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Acción</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Entidad</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">IP</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Fecha/Hora</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 w-10"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100 dark:divide-red-900/20 text-sm">
            @foreach($logs as $log)
              <tr
                class="group hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors cursor-pointer"
                @click="openDrawer(@js($log))"
              >
                <td class="py-3 px-4 text-center">
                  <span class="material-icons-outlined {{ $log['type_color'] }} text-lg" title="{{ $log['type_title'] }}">
                    {{ $log['type_icon'] }}
                  </span>
                </td>

                <td class="py-3 px-4">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                    <div>
                      <div class="font-semibold text-slate-900 dark:text-white">{{ $log['user'] }}</div>
                      <div class="text-xs text-slate-500">{{ $log['role'] }}</div>
                    </div>
                  </div>
                </td>

                <td class="py-3 px-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $log['action_badge'] }}">
                    {{ $log['action'] }}
                  </span>
                </td>

                <td class="py-3 px-4">
                  <div class="font-medium text-slate-700 dark:text-slate-300">{{ $log['entity'] }}</div>
                  <div class="text-xs text-slate-500 font-mono">ID: {{ $log['entity_id'] }}</div>
                </td>

                <td class="py-3 px-4 text-slate-600 dark:text-slate-400 font-mono text-xs">{{ $log['ip'] }}</td>

                <td class="py-3 px-4 text-right tabular-nums text-slate-600 dark:text-slate-400">{{ $log['ts'] }}</td>

                <td class="py-3 px-4 text-center text-slate-400 group-hover:text-primary transition-colors">
                  <span class="material-icons-outlined text-lg">chevron_right</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Paginación (mock) --}}
      <div class="bg-white dark:bg-neutral-surface-dark px-4 py-3 flex items-center justify-between border-t border-slate-200 dark:border-red-900/20 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-slate-700 dark:text-slate-400">
              Mostrando <span class="font-medium text-slate-900 dark:text-white">1</span> a
              <span class="font-medium text-slate-900 dark:text-white">6</span> de
              <span class="font-medium text-slate-900 dark:text-white">128</span> resultados
            </p>
          </div>
          <div>
            <nav aria-label="Paginación" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
              <a class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-red-900/10" href="#">
                <span class="sr-only">Anterior</span>
                <span class="material-icons-outlined text-sm">chevron_left</span>
              </a>
              <a aria-current="page" class="z-10 bg-primary/10 dark:bg-primary/20 border-primary text-primary relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">1</a>
              <a class="bg-white dark:bg-neutral-surface-dark border-slate-300 dark:border-red-900/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-red-900/10 relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">2</a>
              <a class="bg-white dark:bg-neutral-surface-dark border-slate-300 dark:border-red-900/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-red-900/10 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium" href="#">3</a>
              <span class="relative inline-flex items-center px-4 py-2 border border-slate-300 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark text-sm font-medium text-slate-700">...</span>
              <a class="bg-white dark:bg-neutral-surface-dark border-slate-300 dark:border-red-900/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-red-900/10 relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">12</a>
              <a class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-slate-300 dark:border-red-900/20 bg-white dark:bg-neutral-surface-dark text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-red-900/10" href="#">
                <span class="sr-only">Siguiente</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>

    {{-- Backdrop Drawer --}}
    <div
      class="fixed inset-0 bg-black/40 z-40"
      x-show="open"
      x-transition.opacity
      @click="closeDrawer()"
      style="display:none"
    ></div>

    {{-- Drawer --}}
    <aside
      class="fixed inset-y-0 right-0 w-full md:w-[600px] bg-white dark:bg-neutral-surface-dark shadow-2xl z-50 flex flex-col border-l border-slate-200 dark:border-red-900/20"
      x-show="open"
      x-transition:enter="transition transform duration-300 ease-out"
      x-transition:enter-start="translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition transform duration-300 ease-in"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="translate-x-full"
      style="display:none"
    >
      <div class="px-6 py-4 border-b border-slate-200 dark:border-red-900/20 flex items-center justify-between bg-slate-50 dark:bg-red-900/10">
        <div>
          <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded text-[10px] font-bold tracking-wider bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 uppercase">
              Registro de auditoría
            </span>
            <span class="text-sm font-mono text-slate-400" x-text="active?.id ? ('#' + active.id) : ''"></span>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-1" x-text="active?.drawer?.title ?? 'Detalle de auditoría'"></h3>
        </div>
        <button class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-200 dark:hover:bg-red-900/20 transition-colors text-slate-500" type="button" @click="closeDrawer()">
          <span class="material-icons-outlined">close</span>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto custom-scrollbar p-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div class="p-3 bg-slate-50 dark:bg-black/20 rounded-lg border border-slate-100 dark:border-red-900/20">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Actor</div>
            <div class="flex items-center gap-2">
              <div class="w-5 h-5 rounded-full bg-slate-200 dark:bg-slate-700"></div>
              <span class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.actor ?? '-'"></span>
            </div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-black/20 rounded-lg border border-slate-100 dark:border-red-900/20">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">IP origen</div>
            <div class="text-sm font-mono text-slate-800 dark:text-slate-200" x-text="active?.drawer?.ip ?? '-'"></div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-black/20 rounded-lg border border-slate-100 dark:border-red-900/20">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Tipo de entidad</div>
            <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.entity_type ?? '-'"></div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-black/20 rounded-lg border border-slate-100 dark:border-red-900/20">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Fecha/Hora</div>
            <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.timestamp ?? '-'"></div>
          </div>
        </div>

        <div class="space-y-6">
          <div>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
              <span class="material-icons-outlined text-primary text-sm">info</span>
              Contexto
            </h4>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed" x-text="active?.drawer?.context ?? ''"></p>
          </div>

          <div>
            <div class="flex items-center justify-between mb-2">
              <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-icons-outlined text-primary text-sm">code</span>
                Payload del cambio
              </h4>
              <button class="text-xs text-primary hover:text-primary-dark font-medium flex items-center gap-1" type="button" @click="copyJson()">
                <span class="material-icons-outlined text-[10px]">content_copy</span>
                Copiar JSON
              </button>
            </div>

            <div class="bg-slate-900 rounded-lg p-4 font-mono text-xs overflow-x-auto shadow-inner border border-slate-800">
              <pre class="text-slate-300" x-text="active?.drawer?.json ?? '{}'"></pre>
            </div>
          </div>

          <div>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Actividad relacionada (misma sesión)</h4>
            <div class="border-l-2 border-slate-200 dark:border-red-900/20 ml-1 pl-4 space-y-4">
              <div class="relative">
                <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-slate-300 dark:bg-slate-600 ring-4 ring-white dark:ring-neutral-surface-dark"></span>
                <div class="text-xs text-slate-500 mb-0.5">11:10:05</div>
                <div class="text-sm text-slate-800 dark:text-slate-200">Se abrió el recurso relacionado</div>
              </div>
              <div class="relative">
                <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-primary ring-4 ring-white dark:ring-neutral-surface-dark"></span>
                <div class="text-xs text-slate-500 mb-0.5">11:15:22</div>
                <div class="text-sm font-medium text-slate-800 dark:text-slate-200">Se ejecutó la acción registrada</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="p-4 border-t border-slate-200 dark:border-red-900/20 bg-slate-50 dark:bg-red-900/10 flex gap-3">
        <button class="flex-1 py-2 px-4 bg-white dark:bg-neutral-surface-dark border border-slate-300 dark:border-red-900/20 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors" type="button">
          Marcar como sospechoso
        </button>
        <button class="flex-1 py-2 px-4 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark shadow-md shadow-primary/20 transition-colors" type="button">
          Ver traza completa
        </button>
      </div>
    </aside>

  </main>
</div>
@endsection
