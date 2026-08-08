<!DOCTYPE html>
<html
    lang="fa"
    dir="rtl"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark',
        language: localStorage.getItem('language') || 'fa'
    }"
    x-init="
        document.documentElement.classList.toggle('dark', darkMode);

        $watch('darkMode', value => {
            localStorage.setItem('theme', value ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', value);
        });
    "
    class="scroll-smooth"
>
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'DoNext')
    </title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    {{-- Alpine --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    @livewireStyles

</head>

<body
    class="
        min-h-screen
        bg-slate-50
        text-slate-900
        transition-colors
        duration-300
        dark:bg-slate-950
        dark:text-white
    "
>

    <div class="min-h-screen">

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main --}}
        <div class="min-h-screen lg:ms-72">

            {{-- Navbar --}}
            <x-navbar />

            {{-- Livewire Page Content --}}
            <main class="p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

    @livewireScripts

</body>
</html>