<!DOCTYPE html>
<html lang="fa" dir="rtl" x-data="{
    lang: localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa',

    setLang(value) {
        this.lang = value;
        localStorage.setItem('language', value);
        localStorage.setItem('donext-lang', value);
        document.cookie = 'donext_locale=' + value + '; path=/; max-age=31536000; SameSite=Lax';
        document.documentElement.lang = value;
        document.documentElement.dir = value === 'fa' ? 'rtl' : 'ltr';
        window.dispatchEvent(new CustomEvent('donext-language-changed'));
    }
}" :lang="lang" :dir="lang === 'fa' ? 'rtl' : 'ltr'">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'DoNext' }}</title>

    <script>
        (function () {
            try {
                const lang = localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa';
                localStorage.setItem('language', lang);
                localStorage.setItem('donext-lang', lang);
                document.cookie = 'donext_locale=' + lang + '; path=/; max-age=31536000; SameSite=Lax';
                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';

                const theme = localStorage.getItem('theme') || localStorage.getItem('donext-theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>

    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
    {{ $slot }}
    @livewireScripts
</body>

</html>
