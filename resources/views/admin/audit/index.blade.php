@extends('layouts.admin')

@section('title', 'Audit Log')

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">

<style>
  .font-display{ font-family: Manrope, sans-serif; }
  .font-mono{ font-family: "JetBrains Mono", monospace; }

  .custom-scrollbar::-webkit-scrollbar { width: 6px; }
  .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
  .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
  .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

  .json-key { color: #ef253c; }
  .json-string { color: #059669; }
  .json-number { color: #d97706; }
  .json-boolean { color: #2563eb; }
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
      'type_title' => 'Critical Action',
      'user' => 'Elena R.',
      'role' => 'Admin',
      'action' => 'DELETE',
      'action_badge' => 'bg-primary/10 text-primary border border-primary/20',
      'entity' => 'Grant Proposal #2024-A',
      'entity_id' => 'doc_88291',
      'ip' => '192.168.1.142',
      'ts' => 'Oct 27, 14:32:01',
      'drawer' => [
        'title' => 'Resource Delete',
        'actor' => 'Elena R.',
        'actor_avatar' => null,
        'ip' => '192.168.1.142',
        'entity_type' => 'PDF Document',
        'timestamp' => 'Oct 27, 2023 - 14:32:01',
        'context' => 'User deleted the document "Grant Proposal #2024-A". This action is irreversible and was performed by an admin role.',
        'json' => '{
  "event_id": "evt_8839209",
  "action": "DELETE",
  "entity": { "type": "document", "id": "doc_88291" },
  "reason": "Cleanup / duplicate file",
  "security_flags": true
}',
      ]
    ],
    [
      'id' => 'log_992812',
      'type_icon' => 'edit',
      'type_color' => 'text-blue-500',
      'type_title' => 'Update',
      'user' => 'Carlos M.',
      'role' => 'Editor',
      'action' => 'UPDATE',
      'action_badge' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800',
      'entity' => 'Beneficiary List Q3',
      'entity_id' => 'xls_33910',
      'ip' => '192.168.1.105',
      'ts' => 'Oct 27, 11:15:22',
      'drawer' => [
        'title' => 'Resource Update',
        'actor' => 'Carlos M.',
        'actor_avatar' => null,
        'ip' => '192.168.1.105',
        'entity_type' => 'Excel Spreadsheet',
        'timestamp' => 'Oct 27, 2023 - 11:15:22',
        'context' => "User updated the Beneficiary List Q3 document. Changes involve adding 3 new rows and modifying the 'Status' column for existing entries in the Huanuco region.",
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
      'type_title' => 'Upload',
      'user' => 'Sofia L.',
      'role' => 'Manager',
      'action' => 'UPLOAD',
      'action_badge' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800',
      'entity' => 'Annual Budget 2024',
      'entity_id' => 'pdf_00293',
      'ip' => '10.0.0.45',
      'ts' => 'Oct 26, 09:45:10',
      'drawer' => [
        'title' => 'File Upload',
        'actor' => 'Sofia L.',
        'actor_avatar' => null,
        'ip' => '10.0.0.45',
        'entity_type' => 'PDF Document',
        'timestamp' => 'Oct 26, 2023 - 09:45:10',
        'context' => 'User uploaded "Annual Budget 2024" to the system. The file was indexed and tagged automatically.',
        'json' => '{
  "event_id": "evt_8839102",
  "action": "UPLOAD",
  "file": { "name": "Annual Budget 2024", "id": "pdf_00293" },
  "tags_applied": ["Finance", "Q4-2024"],
  "security_flags": false
}',
      ]
    ],
    [
      'id' => 'log_992814',
      'type_icon' => 'login',
      'type_color' => 'text-slate-400',
      'type_title' => 'Login',
      'user' => 'Miguel P.',
      'role' => 'Auditor',
      'action' => 'LOGIN',
      'action_badge' => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700',
      'entity' => 'System Access',
      'entity_id' => 'sess_921',
      'ip' => '200.121.18.9',
      'ts' => 'Oct 26, 08:30:00',
      'drawer' => [
        'title' => 'System Login',
        'actor' => 'Miguel P.',
        'actor_avatar' => null,
        'ip' => '200.121.18.9',
        'entity_type' => 'Session',
        'timestamp' => 'Oct 26, 2023 - 08:30:00',
        'context' => 'User authenticated successfully and accessed the Admin Console.',
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
      'type_title' => 'Auth Warning',
      'user' => 'Unknown',
      'role' => 'External',
      'action' => 'AUTH_FAIL',
      'action_badge' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 border border-orange-200 dark:border-orange-800',
      'entity' => 'System Access',
      'entity_id' => 'Attempt #3',
      'ip' => '45.23.11.2',
      'ts' => 'Oct 25, 03:12:01',
      'drawer' => [
        'title' => 'Authentication Failure',
        'actor' => 'Unknown',
        'actor_avatar' => null,
        'ip' => '45.23.11.2',
        'entity_type' => 'Auth Event',
        'timestamp' => 'Oct 25, 2023 - 03:12:01',
        'context' => 'Multiple failed login attempts detected from an external IP. Consider rate limiting or blocking if repeated.',
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
  class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display min-h-screen"
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

  {{-- Header (si tu layout ya tiene navbar, puedes borrar este bloque) --}}
  <nav class="bg-surface-light dark:bg-surface-dark border-b border-slate-200 dark:border-primary/10 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
    <div class="flex items-center gap-4">
      <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
        <span class="material-icons-outlined text-primary text-2xl">security</span>
      </div>
      <div>
        <h1 class="font-bold text-lg leading-tight dark:text-white">Admin Console</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">NGO Document Management System v4.2</p>
      </div>
    </div>
    <div class="flex items-center gap-4">
      <div class="hidden md:flex items-center gap-2 text-sm text-slate-500 bg-slate-50 dark:bg-background-dark/50 dark:text-slate-400 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-primary/10">
        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
        System Operational
      </div>
      <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 border-2 border-slate-100 dark:border-primary/20"></div>
    </div>
  </nav>

  <main class="flex-1 max-w-7xl w-full mx-auto px-6 py-8 relative">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
      <div>
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">System Audit Log</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-1 max-w-2xl">
          Track all modifications, security events, and user activities across the platform for compliance and security auditing.
        </p>
      </div>
      <div class="flex gap-3">
        <button class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-primary/20 rounded-lg text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-50 dark:hover:bg-primary/10 transition-colors" type="button">
          <span class="material-icons-outlined text-lg">download</span>
          Export CSV
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark shadow-sm shadow-primary/30 transition-colors" type="button">
          <span class="material-icons-outlined text-lg">picture_as_pdf</span>
          Generate Report
        </button>
      </div>
    </div>

    {{-- Filters --}}
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-primary/10 p-4 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

        <div class="md:col-span-4 lg:col-span-3">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Search</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-primary/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-700 dark:text-slate-200"
                   placeholder="Search user, entity ID..." type="text">
          </div>
        </div>

        <div class="md:col-span-3 lg:col-span-3">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Date Range</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">calendar_today</span>
            <input class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-primary/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-700 dark:text-slate-200 cursor-pointer"
                   type="text" value="Oct 20, 2023 - Oct 27, 2023">
          </div>
        </div>

        <div class="md:col-span-3 lg:col-span-2">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Action</label>
          <select class="w-full pl-3 pr-8 py-2 bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-primary/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-700 dark:text-slate-200">
            <option>All Actions</option>
            <option>Create</option>
            <option>Update</option>
            <option>Delete</option>
            <option>Login</option>
          </select>
        </div>

        <div class="md:col-span-2 lg:col-span-2">
          <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider">Role</label>
          <select class="w-full pl-3 pr-8 py-2 bg-slate-50 dark:bg-background-dark border border-slate-200 dark:border-primary/20 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-700 dark:text-slate-200">
            <option>All Roles</option>
            <option>Admin</option>
            <option>Manager</option>
            <option>Viewer</option>
          </select>
        </div>

        <div class="md:col-span-12 lg:col-span-2 flex justify-end md:justify-start">
          <button class="text-sm text-primary hover:text-primary-dark font-medium underline decoration-2 decoration-primary/20 hover:decoration-primary underline-offset-4 transition-all" type="button">
            Reset Filters
          </button>
        </div>
      </div>
    </div>

    {{-- Table --}}
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-lg border border-slate-200 dark:border-primary/10 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 dark:bg-background-dark border-b border-slate-200 dark:border-primary/10">
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 w-16 text-center">Type</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">User</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Action</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Entity</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">IP Address</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Timestamp</th>
              <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 w-10"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100 dark:divide-primary/5 text-sm">
            @foreach($logs as $log)
              <tr
                class="group hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors cursor-pointer"
                @click="openDrawer(@js($log))"
              >
                <td class="py-3 px-4 text-center">
                  <span class="material-icons-outlined {{ $log['type_color'] }} text-lg" title="{{ $log['type_title'] }}">{{ $log['type_icon'] }}</span>
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

      {{-- Pagination (mock) --}}
      <div class="bg-white dark:bg-surface-dark px-4 py-3 flex items-center justify-between border-t border-slate-200 dark:border-primary/10 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-slate-700 dark:text-slate-400">
              Showing <span class="font-medium text-slate-900 dark:text-white">1</span> to
              <span class="font-medium text-slate-900 dark:text-white">6</span> of
              <span class="font-medium text-slate-900 dark:text-white">128</span> results
            </p>
          </div>
          <div>
            <nav aria-label="Pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
              <a class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 dark:border-primary/20 bg-white dark:bg-surface-dark text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-primary/10" href="#">
                <span class="sr-only">Previous</span>
                <span class="material-icons-outlined text-sm">chevron_left</span>
              </a>
              <a aria-current="page" class="z-10 bg-primary/10 dark:bg-primary/20 border-primary text-primary relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">1</a>
              <a class="bg-white dark:bg-surface-dark border-slate-300 dark:border-primary/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-primary/10 relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">2</a>
              <a class="bg-white dark:bg-surface-dark border-slate-300 dark:border-primary/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-primary/10 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium" href="#">3</a>
              <span class="relative inline-flex items-center px-4 py-2 border border-slate-300 dark:border-primary/20 bg-white dark:bg-surface-dark text-sm font-medium text-slate-700">...</span>
              <a class="bg-white dark:bg-surface-dark border-slate-300 dark:border-primary/20 text-slate-500 hover:bg-slate-50 dark:hover:bg-primary/10 relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">12</a>
              <a class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-slate-300 dark:border-primary/20 bg-white dark:bg-surface-dark text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-primary/10" href="#">
                <span class="sr-only">Next</span>
                <span class="material-icons-outlined text-sm">chevron_right</span>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>

    {{-- Drawer Backdrop --}}
    <div
      class="fixed inset-0 bg-black/40 z-40"
      x-show="open"
      x-transition.opacity
      @click="closeDrawer()"
      style="display:none"
    ></div>

    {{-- Drawer --}}
    <aside
      class="fixed inset-y-0 right-0 w-full md:w-[600px] bg-surface-light dark:bg-surface-dark shadow-2xl z-50 flex flex-col border-l border-slate-200 dark:border-primary/20"
      x-show="open"
      x-transition:enter="transition transform duration-300 ease-out"
      x-transition:enter-start="translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition transform duration-300 ease-in"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="translate-x-full"
      style="display:none"
    >
      <div class="px-6 py-4 border-b border-slate-200 dark:border-primary/10 flex items-center justify-between bg-slate-50 dark:bg-background-dark/50">
        <div>
          <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded text-[10px] font-bold tracking-wider bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 uppercase">Audit Record</span>
            <span class="text-sm font-mono text-slate-400" x-text="active?.id ? ('#' + active.id) : ''"></span>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-1" x-text="active?.drawer?.title ?? 'Audit Details'"></h3>
        </div>
        <button class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-200 dark:hover:bg-primary/20 transition-colors text-slate-500" type="button" @click="closeDrawer()">
          <span class="material-icons-outlined">close</span>
        </button>
      </div>

      <div class="flex-1 overflow-y-auto custom-scrollbar p-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div class="p-3 bg-slate-50 dark:bg-background-dark/40 rounded-lg border border-slate-100 dark:border-primary/5">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Actor</div>
            <div class="flex items-center gap-2">
              <div class="w-5 h-5 rounded-full bg-slate-200 dark:bg-slate-700"></div>
              <span class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.actor ?? '-'"></span>
            </div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-background-dark/40 rounded-lg border border-slate-100 dark:border-primary/5">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">IP Source</div>
            <div class="text-sm font-mono text-slate-800 dark:text-slate-200" x-text="active?.drawer?.ip ?? '-'"></div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-background-dark/40 rounded-lg border border-slate-100 dark:border-primary/5">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Entity Type</div>
            <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.entity_type ?? '-'"></div>
          </div>

          <div class="p-3 bg-slate-50 dark:bg-background-dark/40 rounded-lg border border-slate-100 dark:border-primary/5">
            <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold mb-1">Timestamp</div>
            <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="active?.drawer?.timestamp ?? '-'"></div>
          </div>
        </div>

        <div class="space-y-6">
          <div>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
              <span class="material-icons-outlined text-primary text-sm">info</span>
              Context
            </h4>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed" x-text="active?.drawer?.context ?? ''"></p>
          </div>

          <div>
            <div class="flex items-center justify-between mb-2">
              <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-icons-outlined text-primary text-sm">code</span>
                Change Payload
              </h4>
              <button class="text-xs text-primary hover:text-primary-dark font-medium flex items-center gap-1" type="button" @click="copyJson()">
                <span class="material-icons-outlined text-[10px]">content_copy</span> Copy JSON
              </button>
            </div>

            <div class="bg-slate-900 rounded-lg p-4 font-mono text-xs overflow-x-auto shadow-inner border border-slate-800">
              <pre class="text-slate-300" x-text="active?.drawer?.json ?? '{}'"></pre>
            </div>
          </div>

          <div>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Related Activity (Same Session)</h4>
            <div class="border-l-2 border-slate-200 dark:border-primary/20 ml-1 pl-4 space-y-4">
              <div class="relative">
                <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-slate-300 dark:bg-slate-600 ring-4 ring-white dark:ring-surface-dark"></span>
                <div class="text-xs text-slate-500 mb-0.5">11:10:05 AM</div>
                <div class="text-sm text-slate-800 dark:text-slate-200">Opened related resource</div>
              </div>
              <div class="relative">
                <span class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-primary ring-4 ring-white dark:ring-surface-dark"></span>
                <div class="text-xs text-slate-500 mb-0.5">11:15:22 AM</div>
                <div class="text-sm font-medium text-slate-800 dark:text-slate-200">Executed action in this record</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="p-4 border-t border-slate-200 dark:border-primary/10 bg-slate-50 dark:bg-background-dark/50 flex gap-3">
        <button class="flex-1 py-2 px-4 bg-white dark:bg-surface-dark border border-slate-300 dark:border-primary/20 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-primary/10 transition-colors" type="button">
          Flag as Suspicious
        </button>
        <button class="flex-1 py-2 px-4 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark shadow-md shadow-primary/20 transition-colors" type="button">
          View Full Trace
        </button>
      </div>
    </aside>

  </main>
</div>
@endsection
