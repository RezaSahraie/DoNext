<!DOCTYPE html>
<html lang="fa" dir="rtl" x-data="{ darkMode: localStorage.getItem('theme') === 'dark', language: localStorage.getItem('language') || 'fa' }" x-init="document.documentElement.classList.toggle('dark', darkMode); document.documentElement.dir = language === 'fa' ? 'rtl' : 'ltr'; $watch('darkMode', value => { localStorage.setItem('theme', value ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', value); }); $watch('language', value => { localStorage.setItem('language', value); document.documentElement.dir = value === 'fa' ? 'rtl' : 'ltr'; document.documentElement.lang = value; } )" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title', 'DoNext')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Vazirmatn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: Vazirmatn, Inter, sans-serif; }
        [x-cloak] { display: none !important; }
        ::selection { background: rgb(99 102 241 / .2); }
        :focus-visible { outline: 3px solid rgb(99 102 241 / .45); outline-offset: 2px; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-white">
    <div class="min-h-screen">
        <x-sidebar />
        <div class="min-h-screen lg:ms-72">
            <x-navbar />
            <main class="min-h-[calc(100vh-5rem)] p-4 sm:p-6 lg:p-8">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
    <x-toast />
    @livewireScripts
</body>
</html>