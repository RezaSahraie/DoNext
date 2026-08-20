<!DOCTYPE html>
<html lang="fa" dir="rtl" x-data="{
    lang: localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa',
    setLang(value) {
        this.lang = value;
        localStorage.setItem('language', value);
        localStorage.setItem('donext-lang', value);
        document.documentElement.lang = value;
        document.documentElement.dir = value === 'fa' ? 'rtl' : 'ltr';
    }
}" :lang="lang" :dir="lang === 'fa' ? 'rtl' : 'ltr'">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title x-text="lang === 'fa' ? 'خطا - صفحه پیدا نشد | DoNext' : 'Error - Page not found | DoNext'"></title>
    <script>
        (() => {
            const lang = localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa';
            localStorage.setItem('language', lang);
            localStorage.setItem('donext-lang', lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';
            const theme = localStorage.getItem('theme') || localStorage.getItem('donext-theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Vazirmatn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body{font-family:Vazirmatn,Inter,sans-serif}</style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 flex items-center justify-center">
    <div class="w-full max-w-md mx-auto px-6 text-center">
        <div class="flex justify-end mb-4">
            <button type="button" @click="setLang(lang === 'fa' ? 'en' : 'fa')"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold dark:border-slate-700 dark:bg-slate-900"
                x-text="lang === 'fa' ? 'English' : 'فارسی'"></button>
        </div>

        <div class="text-[150px] sm:text-[180px] font-black text-indigo-500/10 dark:text-indigo-500/5 select-none">404</div>

        <div class="relative -mt-28">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tighter">
                <span x-show="lang === 'fa'">صفحه پیدا نشد</span>
                <span x-show="lang === 'en'">Page not found</span>
            </h1>
            <p class="mt-3 text-base sm:text-lg text-slate-500 dark:text-slate-400">
                <span x-show="lang === 'fa'">متأسفانه این صفحه وجود ندارد یا به‌روزرسانی شده.</span>
                <span x-show="lang === 'en'">Sorry, this page doesn't exist or has been moved.</span>
            </p>
        </div>

        <div class="my-12 flex justify-center">
            <div class="relative">
                <i class="fa-solid fa-ghost text-[160px] text-indigo-400/30 dark:text-indigo-400/10"></i>
                <i class="fa-solid fa-triangle-exclamation absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl text-amber-500"></i>
            </div>
        </div>

        <div class="space-y-3">
            <a href="{{ url('/dashboard') }}"
                class="inline-flex items-center justify-center gap-3 bg-indigo-600 hover:bg-indigo-700 transition text-white font-bold text-base px-7 py-3.5 rounded-2xl w-full">
                <i class="fa-solid fa-house"></i>
                <span x-show="lang === 'fa'">بازگشت به داشبورد</span>
                <span x-show="lang === 'en'">Back to dashboard</span>
            </a>

            <a href="{{ url('/tasks') }}"
                class="inline-flex items-center justify-center gap-3 text-slate-600 dark:text-slate-400 hover:text-indigo-600 transition font-bold px-7 py-3.5 w-full">
                <i class="fa-solid fa-list-check"></i>
                <span x-show="lang === 'fa'">رفتن به لیست کارها</span>
                <span x-show="lang === 'en'">Go to tasks</span>
            </a>
        </div>

        <div class="mt-10 text-xs text-slate-400">DoNext — Organize, categorize, complete</div>
    </div>
</body>
</html>
