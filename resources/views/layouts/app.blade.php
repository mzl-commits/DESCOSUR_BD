<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">

        <!-- Sidebar según rol -->
        @if(auth()->check() && auth()->user()->rol === 'ADMIN')
            @include('admin.partials.sidebar')
        @elseif(auth()->check())
            @include('usuario.partials.sidebar')
        @endif

        <div class="flex-1 flex flex-col min-h-screen">

            @include('layouts.navigation')

            <!-- Contenido principal -->
            <main class="flex-1 p-6 bg-gray-50 overflow-auto">
                @yield('content')
            </main>

        </div>

    </div>
</body> 
</html>
