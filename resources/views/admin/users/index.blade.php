@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">

<style>
  .font-display{ font-family: Manrope, sans-serif; }

  /* Custom scrollbar */
  ::-webkit-scrollbar { width: 8px; height: 8px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
  ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

  .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

{{-- Alpine (si tu layout ya lo carga, elimina esta línea) --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
@php
  $users = [
    [
      'id' => 1,
      'name' => 'Maria Rodriguez',
      'email' => 'maria.rodriguez@ngo.pe',
      'role' => 'ADMIN',
      'status' => 'active',
      'last_access' => 'Hace 2 horas',
      'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_kXbdvbvPVem-AFmSFJfoaW6MS5UXcJPBt2SiGWhHgY1VidZKUpTgMEd8uWg4JKEi_BZaVKwx3fzzlqUcPgIEk4qb7ffDREKw9H631FpawxvUF9ngnZfNpigZjVWDwRYpkR0HMZDOV5MKQ1Q23AuM-jaDgL_LAKZMGp1KtTEUGA6keWUMNjUZSrlmcIb5_0Nhe5OJQEHAYqIoI5FWDyZgjHYApWELdhHU6M8TLzOF_SX7mMj4aPHMGhenadVOmuyG6U5I3n2OJ6fp',
    ],
    [
      'id' => 2,
      'name' => 'Juan Perez',
      'email' => 'juan.perez@ngo.pe',
      'role' => 'ENCARGADO',
      'status' => 'inactive',
      'last_access' => 'Hace 5 días',
      'avatar' => null,
    ],
    [
      'id' => 3,
      'name' => 'Sofia Lima',
      'email' => 'sofia.lima@ngo.pe',
      'role' => 'LECTOR',
      'status' => 'active',
      'last_access' => 'Ahora',
      'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB7jbdV1bs0Kg88oJu3nZwnXGRzONtEQSdcrVEGu8V1Nqf05SUH4Cg3pTQN8SOnWGX3s7ZkGKY8nVD-hc15iWewdzGQz5dFFNDJSP3r8RhzVQPBCktuu59y4-OcBQOdhOzDPPRrV9vlHswb_vtuPLLRhzaArE30hqIgLL31_kbDQb1CEh6qaSIbz5cQ-rZf036Dt_h089lmyB2h3pvnWb8p57tF8hDsoMLj5vxSFJ_6ywBn2SxpiQj8eJj5K9hXnRvsV-KEEzkdOOKn',
    ],
    [
      'id' => 4,
      'name' => 'Carlos Mendoza',
      'email' => 'carlos.m@ngo.pe',
      'role' => 'ENCARGADO',
      'status' => 'active',
      'last_access' => 'Ayer',
      'avatar' => null,
    ],
  ];

  $roleBadge = fn($role) => match($role) {
    'ADMIN' => 'bg-primary/10 text-primary border border-primary/20 font-bold',
    'LECTOR' => 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-300 border border-blue-100 dark:border-blue-800',
    default => 'bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10',
  };

  $roleLabel = fn($role) => match($role) {
    'ADMIN' => 'ADMIN',
    'ENCARGADO' => 'ENCARGADO',
    'LECTOR' => 'LECTOR',
    default => strtoupper($role),
  };
@endphp

<div
  class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display min-h-screen flex flex-col"
  x-data="{
    modalOpen: false,
    mode: 'create', // create | edit
    form: { id:null, name:'', email:'', role:'LECTOR', status:'active', send_invite:true },

    openCreate(){
      this.mode = 'create';
      this.form = { id:null, name:'', email:'', role:'LECTOR', status:'active', send_invite:true };
      this.modalOpen = true;
    },
    openEdit(user){
      this.mode = 'edit';
      this.form = {
        id: user.id,
        name: user.name,
        email: user.email,
        role: user.role,
        status: user.status,
        send_invite: false
      };
      this.modalOpen = true;
    },
    closeModal(){
      this.modalOpen = false;
    },
    save(){
      // Aquí conectas con tu backend (fetch/AJAX o submit normal)
      // Por ahora: placeholder
      this.closeModal();
    },
    askDelete(user){
      if(confirm(`¿Eliminar a ${user.name}?`)){
        // Aquí conectas con tu backend (DELETE)
      }
    }
  }"
>

  <!-- Top Navigation -->
  <nav class="bg-white dark:bg-[#2a1416] border-b border-gray-200 dark:border-primary/10 h-16 flex items-center px-6 sticky top-0 z-30 shadow-sm">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded bg-primary flex items-center justify-center text-white font-bold text-lg">N</div>
      <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">
        NGO<span class="text-primary">Admin</span>
      </span>
    </div>

    <div class="ml-auto flex items-center gap-4">
      <button class="p-2 text-gray-400 hover:text-primary transition-colors relative" type="button">
        <span class="material-icons-round">notifications</span>
        <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-white dark:border-[#2a1416]"></span>
      </button>

      <div class="h-8 w-8 rounded-full bg-primary/10 border border-primary/20 overflow-hidden">
        <div class="h-full w-full bg-slate-200 dark:bg-slate-700"></div>
      </div>
    </div>
  </nav>

  <div class="flex flex-1">

    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-[#2a1416] border-r border-gray-200 dark:border-primary/10 hidden lg:flex flex-col py-6">
      <div class="px-4 mb-8">
        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-2">Principal</h3>
        <nav class="space-y-1">
          <a class="flex items-center px-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-primary/5 hover:text-primary transition-colors" href="#">
            <span class="material-icons-round mr-3 text-xl">dashboard</span> Dashboard
          </a>
          <a class="flex items-center px-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-primary/5 hover:text-primary transition-colors" href="#">
            <span class="material-icons-round mr-3 text-xl">folder</span> Documentos
          </a>
        </nav>
      </div>

      <div class="px-4">
        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-2">Administración</h3>
        <nav class="space-y-1">
          <a class="flex items-center px-2 py-2 text-sm font-medium bg-primary/5 text-primary rounded border-r-2 border-primary" href="#">
            <span class="material-icons-round mr-3 text-xl">people</span> Usuarios
          </a>
          <a class="flex items-center px-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-primary/5 hover:text-primary transition-colors" href="#">
            <span class="material-icons-round mr-3 text-xl">settings</span> Configuración
          </a>
          <a class="flex items-center px-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-primary/5 hover:text-primary transition-colors" href="#">
            <span class="material-icons-round mr-3 text-xl">security</span> Roles y Permisos
          </a>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 lg:p-8 overflow-y-auto">

      <!-- Breadcrumb & Header -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 animate-fade-in">
        <div>
          <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a class="hover:text-primary" href="#">Dashboard</a>
            <span class="material-icons-round text-xs">chevron_right</span>
            <span class="text-gray-800 dark:text-white font-medium">Gestión de Usuarios</span>
          </div>
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Usuarios del Sistema</h1>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Administra el acceso y los roles de los miembros de la organización.
          </p>
        </div>

        <button
          class="bg-primary hover:bg-red-600 text-white px-4 py-2.5 rounded-lg shadow-lg shadow-primary/20 flex items-center gap-2 font-medium transition-all transform hover:scale-105 active:scale-95"
          type="button"
          @click="openCreate()"
        >
          <span class="material-icons-round">add</span>
          Nuevo Usuario
        </button>
      </div>

      <!-- Filters Section -->
      <div class="bg-white dark:bg-[#2a1416] p-4 rounded-xl border border-gray-200 dark:border-primary/10 shadow-sm mb-6 animate-fade-in" style="animation-delay: .1s;">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1 relative">
            <span class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
            <input
              class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-black/20 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder-gray-400 text-sm"
              placeholder="Buscar por nombre o email..."
              type="text"
            />
          </div>

          <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative min-w-[180px]">
              <select class="w-full pl-3 pr-10 py-2 bg-gray-50 dark:bg-black/20 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none appearance-none text-sm text-gray-600 dark:text-gray-300">
                <option value="">Todos los Roles</option>
                <option value="ADMIN">Administrador</option>
                <option value="ENCARGADO">Encargado</option>
                <option value="LECTOR">Lector</option>
              </select>
              <span class="material-icons-round absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-lg">expand_more</span>
            </div>

            <div class="relative min-w-[160px]">
              <select class="w-full pl-3 pr-10 py-2 bg-gray-50 dark:bg-black/20 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none appearance-none text-sm text-gray-600 dark:text-gray-300">
                <option value="">Estado: Todos</option>
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
              </select>
              <span class="material-icons-round absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-lg">expand_more</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Users Table -->
      <div class="bg-white dark:bg-[#2a1416] rounded-xl border border-gray-200 dark:border-primary/10 shadow-sm overflow-hidden animate-fade-in" style="animation-delay: .2s;">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50/50 dark:bg-primary/5 border-b border-gray-100 dark:border-primary/10">
                <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Usuario</th>
                <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Rol</th>
                <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Estado</th>
                <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Último Acceso</th>
                <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-right">Acciones</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-primary/5">
              @foreach($users as $u)
                @php
                  $initials = collect(preg_split('/\s+/', trim($u['name'])))
                    ->filter()
                    ->take(2)
                    ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
                    ->implode('');
                @endphp

                <tr class="hover:bg-gray-50 dark:hover:bg-primary/5 transition-colors group">
                  <td class="py-4 px-6">
                    <div class="flex items-center gap-3">
                      @if($u['avatar'])
                        <img
                          alt="Avatar {{ $u['name'] }}"
                          class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-primary/20 shadow-sm"
                          src="{{ $u['avatar'] }}"
                        />
                      @else
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 dark:text-slate-300 font-bold text-sm border-2 border-transparent">
                          {{ $initials }}
                        </div>
                      @endif

                      <div>
                        <div class="font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">
                          {{ $u['name'] }}
                        </div>
                        <div class="text-xs text-gray-500">{{ $u['email'] }}</div>
                      </div>
                    </div>
                  </td>

                  <td class="py-4 px-6">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs border {{ $roleBadge($u['role']) }}">
                      {{ $roleLabel($u['role']) }}
                    </span>
                  </td>

                  <td class="py-4 px-6">
                    <div class="flex items-center gap-2">
                      @if($u['status'] === 'active')
                        <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]"></span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Activo</span>
                      @else
                        <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Inactivo</span>
                      @endif
                    </div>
                  </td>

                  <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                    {{ $u['last_access'] }}
                  </td>

                  <td class="py-4 px-6 text-right">
                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                      <button
                        class="p-1.5 text-gray-400 hover:text-primary hover:bg-primary/5 rounded transition-colors"
                        type="button"
                        title="Editar"
                        @click="openEdit(@js($u))"
                      >
                        <span class="material-icons-round text-lg">edit</span>
                      </button>

                      <button
                        class="p-1.5 text-gray-400 hover:text-primary hover:bg-primary/5 rounded transition-colors"
                        type="button"
                        title="Eliminar"
                        @click="askDelete(@js($u))"
                      >
                        <span class="material-icons-round text-lg">delete</span>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination (mock) -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-primary/10 flex items-center justify-between">
          <span class="text-sm text-gray-500 dark:text-gray-400">
            Mostrando <span class="font-semibold text-gray-900 dark:text-white">1-4</span> de
            <span class="font-semibold text-gray-900 dark:text-white">12</span> usuarios
          </span>

          <div class="flex items-center gap-1">
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 hover:bg-gray-50 dark:hover:bg-primary/10 transition-colors disabled:opacity-50" type="button">
              <span class="material-icons-round text-sm">chevron_left</span>
            </button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-medium" type="button">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-primary/10 transition-colors text-sm font-medium" type="button">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-primary/10 transition-colors text-sm font-medium" type="button">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 hover:bg-gray-50 dark:hover:bg-primary/10 transition-colors" type="button">
              <span class="material-icons-round text-sm">chevron_right</span>
            </button>
          </div>
        </div>
      </div>

    </main>
  </div>

  <!-- Modal Backdrop -->
  <div
    class="fixed inset-0 z-50"
    x-show="modalOpen"
    x-transition.opacity
    style="display:none"
  >
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 dark:bg-black/80" @click="closeModal()"></div>

    <div class="relative min-h-screen flex items-end sm:items-center justify-center p-4 sm:p-0">
      <div
        class="relative w-full sm:max-w-lg bg-white dark:bg-[#2a1416] rounded-xl text-left overflow-hidden shadow-xl border border-gray-200 dark:border-primary/10"
        x-transition:enter="transition transform duration-200 ease-out"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition transform duration-150 ease-in"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="flex items-start justify-between">
            <div>
              <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white" id="modal-title"
                  x-text="mode === 'create' ? 'Agregar Nuevo Usuario' : 'Editar Usuario'"></h3>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"
                 x-text="mode === 'create'
                   ? 'Complete la información para registrar un nuevo miembro en el sistema.'
                   : 'Actualiza la información del usuario seleccionado.'"></p>
            </div>

            <button class="text-gray-400 hover:text-gray-500 focus:outline-none" type="button" @click="closeModal()">
              <span class="material-icons-round">close</span>
            </button>
          </div>

          <form class="mt-6 space-y-4" @submit.prevent="save()">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="name">Nombre Completo</label>
              <input
                class="w-full px-3 py-2 bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm"
                id="name" name="name" placeholder="Ej. Ana Torres" type="text"
                x-model="form.name"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="email">Correo Electrónico</label>
              <input
                class="w-full px-3 py-2 bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm"
                id="email" name="email" placeholder="ejemplo@ngo.pe" type="email"
                x-model="form.email"
              />
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="role">Rol</label>
                <select
                  class="w-full px-3 py-2 bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm"
                  id="role" name="role"
                  x-model="form.role"
                >
                  <option value="LECTOR">Lector</option>
                  <option value="ENCARGADO">Encargado</option>
                  <option value="ADMIN">Admin</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="status">Estado</label>
                <select
                  class="w-full px-3 py-2 bg-gray-50 dark:bg-black/20 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm"
                  id="status" name="status"
                  x-model="form.status"
                >
                  <option value="active">Activo</option>
                  <option value="inactive">Inactivo</option>
                </select>
              </div>
            </div>

            <div class="pt-2" x-show="mode === 'create'">
              <div class="flex items-center mb-2">
                <input class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" id="send_invite" name="send_invite" type="checkbox" x-model="form.send_invite">
                <label class="ml-2 block text-sm text-gray-900 dark:text-gray-300" for="send_invite">
                  Enviar credenciales por correo
                </label>
              </div>
            </div>
          </form>
        </div>

        <div class="bg-gray-50 dark:bg-black/10 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200 dark:border-primary/10">
          <button
            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm transition-colors"
            type="button"
            @click="save()"
            x-text="mode === 'create' ? 'Guardar Usuario' : 'Guardar Cambios'"
          ></button>

          <button
            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-transparent text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors"
            type="button"
            @click="closeModal()"
          >
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
