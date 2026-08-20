<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title', 'DoNext')</title>

    <script>
        // Apply theme + language before paint to avoid flash
        (function () {
            const theme = localStorage.getItem('theme');
            const isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) document.documentElement.classList.add('dark');

            const lang = localStorage.getItem('language') || 'fa';
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';
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
        window.DoNextPairs = {
            'داشبورد': 'Dashboard',
            'کارها': 'Tasks',
            'تقویم': 'Calendar',
            'دسته‌بندی‌ها': 'Categories',
            'پروفایل': 'Profile',
            'فضای کاری': 'Workspace',
            'شخصی': 'Personal',
            'پلن رایگان': 'Free Plan',
            'اعلان‌ها': 'Notifications',
            'امروز': 'Today',
            'فردا': 'Tomorrow',
            'در انتظار': 'Pending',
            'انجام شده': 'Completed',
            'همه': 'All',
            'زیاد': 'High',
            'متوسط': 'Medium',
            'کم': 'Low',
            'کار جدید': 'New Task',
            'افزودن کار': 'Add Task',
            'ایجاد کار': 'Create Task',
            'ذخیره تغییرات': 'Save Changes',
            'انصراف': 'Cancel',
            'تأیید': 'Confirm',
            'ویرایش': 'Edit',
            'حذف': 'Delete',
            'بازگشت': 'Back',
            'کل کارها': 'Total Tasks',
            'نرخ تکمیل': 'Completion Rate',
            'ورود': 'Login',
            'ثبت‌نام': 'Register',
            'رمز عبور': 'Password',
            'ایمیل': 'Email',
            'نام': 'Name',
            'موعد': 'Due date',
            'توضیحات': 'Description',
            'اولویت': 'Priority',
            'عنوان کار': 'Task title',
            'توضیحات کار...': 'Task description...',
            'عنوان کار...': 'Task title...',
            'توضیح کار...': 'Task description...',
            'نام دسته‌بندی': 'Category name',
            'صفحه پیدا نشد': 'Page not found',
            'دسته جدید': 'New Category',
            'ایجاد دسته': 'Create Category',
            'اطلاعات شخصی': 'Personal Information',
            'فعالیت': 'Activity',
            'کارهای امروز': "Today's tasks",
            'مشاهده همه ←': 'View all →',
            'پیشرفت هفتگی': 'Weekly progress',
            'عملکرد این هفته': 'Your performance this week',
            'کارهای پیش رو': 'Upcoming tasks',
            'برنامه روزهای آینده': "What's coming next",
            'تقویم ←': 'Calendar →',
            'برنامه‌ریزی روزها': 'Plan your days',
            'کارهای دارای موعد را روی تقویم ببین و مدیریت کن.': 'See and manage due tasks on the calendar.',
            'برنامه روز': 'Day schedule',
            'کاری برای این روز نیست': 'No tasks for this day',
            'یک کار با این تاریخ موعد بساز': 'Create a task with this due date',
            'کار جدید برای این روز': 'New task for this day',
            'افزودن': 'Add',
            'بدون دسته': 'No category',
            'ویرایش پروفایل': 'Edit profile',
            'در حال ویرایش': 'Editing',
            'در حال ذخیره...': 'Saving...',
            'نام شما': 'Your name',
            'کاری برای امروز نداری': 'No tasks for today',
            'یک کار با تاریخ امروز بساز': "Create a task with today's due date",
            'رفتن به کارها': 'Go to tasks',
            'کار پیش‌رویی نداری': 'No upcoming tasks',
            'برای روزهای بعد یک کار با تاریخ بساز': 'Create a task with a future due date',
            'بر اساس کارهای دارای موعد در این هفته': 'Based on tasks due this week',
            'امروز هم یک قدم دیگر به هدف‌هایت نزدیک شو. کارهای مهمت را انجام بده و روزت را با موفقیت تمام کن.': 'Take another step toward your goals today. Finish what matters and end your day with a win.',
            'نرخ': 'Rate',
            'خروج': 'Logout',
            'شنبه': 'Saturday',
            'یکشنبه': 'Sunday',
            'دوشنبه': 'Monday',
            'سه‌شنبه': 'Tuesday',
            'چهارشنبه': 'Wednesday',
            'پنجشنبه': 'Thursday',
            'جمعه': 'Friday',
            'دسته': 'Category',
            'ذخیره': 'Save',
            'برگشت': 'Back'
        };

        window.DoNextI18n = { fa: {}, en: {} };
        Object.entries(DoNextPairs).forEach(([fa, en]) => {
            DoNextI18n.en[fa] = en;
            DoNextI18n.fa[en] = fa;
        });

        (function () {
            let translating = false;

            function translate() {
                if (translating) return;
                translating = true;

                const lang = localStorage.getItem('language') || 'fa';
                const map = DoNextI18n[lang] || {};

                const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
                const nodes = [];
                while (walker.nextNode()) nodes.push(walker.currentNode);

                nodes.forEach(n => {
                    if (n.parentElement && ['SCRIPT', 'STYLE'].includes(n.parentElement.tagName)) return;
                    const raw = n.nodeValue;
                    const trimmed = raw.trim();
                    if (trimmed && map[trimmed]) {
                        n.nodeValue = raw.replace(trimmed, map[trimmed]);
                    }
                });

                document.querySelectorAll('[placeholder]').forEach(el => {
                    const key = el.dataset.i18nKey || el.getAttribute('placeholder');
                    if (map[key]) {
                        el.dataset.i18nKey = key;
                        el.setAttribute('placeholder', map[key]);
                    }
                });

                document.querySelectorAll('option').forEach(el => {
                    const key = el.dataset.i18nKey || el.textContent.trim();
                    if (map[key]) {
                        el.dataset.i18nKey = key;
                        el.textContent = map[key];
                    }
                });

                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';

                document.querySelectorAll('[data-lang-toggle]').forEach(el => {
                    el.textContent = lang === 'fa' ? 'EN' : 'FA';
                });

                translating = false;
            }

            window.DoNextTranslate = translate;

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
                window.dispatchEvent(new CustomEvent('language-changed', { detail: { language: next } }));
                // Full reload is the most reliable way with TreeWalker i18n
                window.location.reload();
            };

            document.addEventListener('DOMContentLoaded', () => {
                translate();
                new MutationObserver(() => translate()).observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });

            window.addEventListener('language-changed', () => setTimeout(translate, 0));
        })();
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
