<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title', 'DoNext')</title>

    <script>
        // Apply theme + language before paint (no flash)
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
                if (isDark) document.documentElement.classList.add('dark');

                const lang = localStorage.getItem('language') || 'fa';
                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';
            } catch (e) {}
        })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: Vazirmatn, Inter, sans-serif }
        [x-cloak] { display: none !important }
        ::selection { background: rgb(99 102 241 / .2) }
        :focus-visible { outline: 3px solid rgb(99 102 241 / .45); outline-offset: 2px }
    </style>

    <script>
        /**
         * Lightweight i18n helpers.
         * IMPORTANT: no MutationObserver — it freezes Livewire pages.
         */
        window.DoNextToggleTheme = function () {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        };

        window.DoNextToggleLanguage = function () {
            const current = localStorage.getItem('language') || 'fa';
            const next = current === 'fa' ? 'en' : 'fa';
            localStorage.setItem('language', next);
            document.documentElement.lang = next;
            document.documentElement.dir = next === 'fa' ? 'rtl' : 'ltr';
            window.location.reload();
        };

        document.addEventListener('DOMContentLoaded', function () {
            const lang = localStorage.getItem('language') || 'fa';
            document.querySelectorAll('[data-lang-toggle]').forEach(function (el) {
                el.textContent = lang === 'fa' ? 'EN' : 'FA';
            });
        });
    </script>

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
    <x-confirm-modal />

    @livewireScripts
</body>

</html>
