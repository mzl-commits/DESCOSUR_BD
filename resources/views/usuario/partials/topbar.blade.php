@php
    $user = auth()->user();
    $userName = $user->name ?? 'Usuario';
    $userEmail = $user->email ?? '';
    $avatar = "https://ui-avatars.com/api/?name=" . urlencode($userName) . "&background=ef253c&color=fff&size=128";
@endphp

<header class="h-20 bg-white/80 dark:bg-neutral-surface-dark/90 backdrop-blur-md border-b border-slate-200 dark:border-red-900/20 flex items-center justify-between px-6 z-10 sticky top-0">
    
    <div class="flex items-center gap-4 flex-1">
        <button data-open-sidebar class="md:hidden p-2 text-slate-500 hover:text-primary transition-colors rounded-lg hover:bg-slate-50">
            <span class="material-icons">menu</span>
        </button>

        <h1 class="text-xl font-bold text-slate-800 dark:text-white hidden sm:block">
            @yield('page_title', 'Panel Usuario')
        </h1>

        <div class="relative max-w-md w-full ml-6 hidden md:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-icons text-slate-400 text-lg">search</span>
            </span>
            <input
                class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 dark:border-red-900/30 rounded-lg leading-5 bg-slate-50 dark:bg-black/20 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:bg-white dark:focus:bg-black/30 focus:border-primary/50 focus:ring-1 focus:ring-primary/50 sm:text-sm transition-all"
                placeholder="Buscar documentos o proyectos..."
                type="text"
            />
        </div>
    </div>

    <div class="flex items-center gap-2">

        <div class="relative">
            <button id="userMenuBtn" type="button"
                    class="flex items-center gap-2 pl-2 pr-3 py-2 rounded-xl hover:bg-slate-50 dark:hover:bg-red-900/10 transition-colors">
                <img src="{{ $avatar }}" class="w-9 h-9 rounded-full border border-slate-200 dark:border-red-900/30" alt="Avatar">
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white leading-4">{{ $userName }}</p>
                    <p class="text-xs text-slate-500 leading-4">{{ $userEmail }}</p>
                </div>
                <span class="material-icons text-slate-400 text-sm">expand_more</span>
            </button>

            <div id="userMenu"
                 class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-neutral-surface-dark border border-slate-200 dark:border-red-900/20 rounded-xl shadow-lg overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-slate-100 dark:border-red-900/20">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ $userName }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ $userEmail }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left flex items-center gap-2 px-4 py-3 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-red-900/10">
                        <span class="material-icons text-base text-slate-400">logout</span>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
