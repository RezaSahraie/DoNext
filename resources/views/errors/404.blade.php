<!DOCTYPE html>
<html lang="fa" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خطا - صفحه پیدا نشد | DoNext</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap');
        body { font-family: 'Vazirmatn', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full mx-auto text-center px-6">
        
        <!-- Big 404 -->
        <div class="text-[180px] font-black text-indigo-500/10 dark:text-indigo-500/5 select-none">404</div>
        
        <div class="relative -mt-32">
            <h1 class="text-5xl font-black tracking-tighter">صفحه پیدا نشد</h1>
            <p class="mt-3 text-lg text-slate-500 dark:text-slate-400">
                متأسفانه این صفحه وجود ندارد یا به‌روزرسانی شده.
            </p>
        </div>

        <!-- Big icon -->
        <div class="my-12 flex justify-center">
            <div class="relative">
                <i class="fa-solid fa-ghost text-[180px] text-indigo-400/30 dark:text-indigo-400/10"></i>
                <i class="fa-solid fa-triangle-exclamation absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl text-amber-500"></i>
            </div>
        </div>

        <div class="space-y-4">
            <a href="{{ url('/dashboard') }}" 
               class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 transition text-white font-bold text-lg px-8 py-4 rounded-2xl shadow-lg shadow-indigo-500/30">
                <i class="fa-solid fa-house text-xl"></i>
                بازگشت به داشبورد
            </a>

            <a href="{{ url('/tasks') }}" 
               class="inline-flex items-center gap-3 text-slate-600 dark:text-slate-400 hover:text-indigo-600 transition font-bold px-8 py-4">
                <i class="fa-solid fa-list-check text-xl"></i>
                رفتن به لیست کارها
            </a>
        </div>

        <div class="mt-12 text-xs text-slate-400">
            DoNext — Organize, categorize, complete
        </div>
    </div>

    <script>
        tailwind.config = {
            content: [],
            darkMode: 'class',
        }
    </script>
</body>
</html>