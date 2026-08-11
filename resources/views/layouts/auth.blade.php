<!DOCTYPE html>
<html lang="fa" dir="rtl" x-data="{
    lang: localStorage.getItem('donext-lang') || 'fa',

    setLang(value) {
        this.lang = value;
        localStorage.setItem('donext-lang', value);
    }
}" :lang="lang"
    :dir="lang === 'fa' ? 'rtl' : 'ltr'">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'DoNext' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        };
    </script>

    <script>
        // Keep the user's selected theme across the entire DoNext application.
        if (
            localStorage.getItem('donext-theme') === 'dark' ||
            (!localStorage.getItem('donext-theme') &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">

    {{ $slot }}

    @livewireScripts

</body>

</html>
