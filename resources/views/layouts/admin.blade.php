<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel - DESCOSUR')</title>

    {{-- Tailwind CDN + plugins (tal cual Stitch) --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Fonts + Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    {{-- Tailwind config --}}
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ef253c",
                        "primary-dark": "#d01a2f",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221012",
                        "neutral-surface": "#ffffff",
                        "neutral-surface-dark": "#2d1b1d",
                        "neutral-text": "#4b5563",
                        "neutral-text-dark": "#d1d5db",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Manrope', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    @stack('head')
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display transition-colors duration-200">
<div class="flex h-screen overflow-hidden">

    {{-- Sidebar Desktop --}}
    @include('admin.partials.sidebar')

    {{-- Sidebar Mobile (overlay) --}}
    <div id="mobileOverlay" class="fixed inset-0 z-40 hidden md:hidden">
        <div class="absolute inset-0 bg-black/40" data-close-sidebar></div>

        <aside class="absolute left-0 top-0 h-full w-72 bg-white dark:bg-neutral-surface-dark border-r border-slate-200 dark:border-red-900/20 shadow-xl">
            @include('admin.partials.sidebar', ['isMobile' => true])
        </aside>
    </div>

    {{-- Main --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
        @include('admin.partials.topbar')

        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-8">
            @yield('content')
        </main>
    </div>

</div>

<script>
    (function () {
        // Sidebar móvil
        const overlay = document.getElementById('mobileOverlay');
        const openBtn = document.querySelector('[data-open-sidebar]');
        const closeTargets = document.querySelectorAll('[data-close-sidebar]');

        const openSidebar = () => overlay?.classList.remove('hidden');
        const closeSidebar = () => overlay?.classList.add('hidden');

        openBtn?.addEventListener('click', openSidebar);
        closeTargets.forEach(el => el.addEventListener('click', closeSidebar));

        // Dropdown usuario
        const btn = document.getElementById('userMenuBtn');
        const menu = document.getElementById('userMenu');

        const toggleMenu = () => menu?.classList.toggle('hidden');
        const closeMenu = () => menu?.classList.add('hidden');

        btn?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        document.addEventListener('click', (e) => {
            if (!menu || menu.classList.contains('hidden')) return;
            if (btn && (btn === e.target || btn.contains(e.target))) return;
            closeMenu();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeMenu();
        });
    })();
</script>


@stack('scripts')
</body>
</html>
