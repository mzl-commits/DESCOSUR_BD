@php
    $isMobile = $isMobile ?? false;

    $user = auth()->user();
    $userName = $user->name ?? 'Usuario';
    $userRole = $user->rol ?? 'Administrador';

    $avatar = "https://ui-avatars.com/api/?name=" . urlencode($userName) . "&background=ef253c&color=fff&size=128";

    $navClass = function (bool $active) {
        return $active
            ? 'flex items-center gap-3 px-4 py-3 bg-primary/10 text-primary rounded-xl transition-all group'
            : 'flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-red-900/10 hover:text-primary dark:hover:text-primary rounded-xl transition-all group';
    };

    $iconClass = fn () => 'material-icons text-xl group-hover:scale-110 transition-transform';
@endphp

<aside class="{{ $isMobile ? '' : 'hidden md:flex' }} flex-col w-64 bg-white dark:bg-neutral-surface-dark border-r border-slate-200 dark:border-red-900/20 shadow-sm z-20">
    <div class="flex items-center justify-center h-20 border-b border-slate-100 dark:border-red-900/20 px-6">
        <div class="flex items-center gap-2">
            <div class="bg-primary/10 p-2 rounded-lg">
                <span class="material-icons text-primary">volunteer_activism</span>
            </div>
            <span class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">
                DESCOSUR
            </span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menú principal</p>

        <a class="{{ $navClass(request()->routeIs('admin.dashboard')) }}" href="{{ route('admin.dashboard') }}">
            <span class="{{ $iconClass() }}">dashboard</span>
            <span class="{{ request()->routeIs('admin.dashboard') ? 'font-semibold' : 'font-medium' }}">Panel</span>
        </a>

        <a class="{{ $navClass(request()->is('admin/documentos*')) }}" href="{{ url('/admin/documentos') }}">
            <span class="{{ $iconClass() }}">folder_open</span>
            <span class="{{ request()->is('admin/documentos*') ? 'font-semibold' : 'font-medium' }}">Documentos</span>
        </a>

        <a class="{{ $navClass(request()->is('admin/proyectos*')) }}" href="{{ url('/admin/proyectos') }}">
            <span class="{{ $iconClass() }}">assignment</span>
            <span class="{{ request()->is('admin/proyectos*') ? 'font-semibold' : 'font-medium' }}">Proyectos</span>
        </a>

        <a class="{{ $navClass(request()->is('admin/sectores*')) }}" href="{{ url('/admin/sectores') }}">
            <span class="{{ $iconClass() }}">category</span>
            <span class="{{ request()->is('admin/sectores*') ? 'font-semibold' : 'font-medium' }}">Sectores</span>
        </a>

        <a class="{{ $navClass(request()->is('admin/ubigeo*')) }}" href="{{ url('/admin/ubigeo') }}">
            <span class="{{ $iconClass() }}">map</span>
            <span class="{{ request()->is('admin/ubigeo*') ? 'font-semibold' : 'font-medium' }}">UBIGEO / Distritos</span>
        </a>

        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-8">Sistema</p>

        <a class="{{ $navClass(request()->is('admin/usuarios*')) }}" href="{{ url('/admin/usuarios') }}">
            <span class="{{ $iconClass() }}">people</span>
            <span class="{{ request()->is('admin/usuarios*') ? 'font-semibold' : 'font-medium' }}">Usuarios</span>
        </a>

        <a class="{{ $navClass(request()->is('admin/settings*')) }}" href="{{ url('/admin/settings') }}">
            <span class="{{ $iconClass() }}">settings</span>
            <span class="{{ request()->is('admin/settings*') ? 'font-semibold' : 'font-medium' }}">Configuración</span>
        </a>
    </nav>

    <div class="p-4 border-t border-slate-100 dark:border-red-900/20">
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-red-900/10 cursor-pointer transition-colors">
            <img alt="Perfil" class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-red-900" src="{{ $avatar }}"/>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ $userName }}</p>
                <p class="text-xs text-slate-500 truncate">{{ $userRole }}</p>
            </div>
            <span class="material-icons text-slate-400 text-sm">expand_more</span>
        </div>
    </div>
</aside>
