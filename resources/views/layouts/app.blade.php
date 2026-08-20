<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title', 'DoNext')</title>

    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme') || localStorage.getItem('donext-theme');
                const isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
                if (isDark) document.documentElement.classList.add('dark');

                const lang = localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa';
                localStorage.setItem('language', lang);
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
        // One language source of truth for the whole authenticated application.
        // Views can stay readable in Persian while this layer keeps the UI bilingual.
        window.DoNextTranslations = {
            'داشبورد': 'Dashboard', 'Dashboard': 'داشبورد', 'Dashboard / داشبورد': 'داشبورد',
            'کارها': 'Tasks', 'Tasks': 'کارها', 'Tasks / کارها': 'کارها',
            'تقویم': 'Calendar', 'Calendar': 'تقویم', 'Calendar / تقویم': 'تقویم',
            'دسته‌بندی‌ها': 'Categories', 'دسته بندی ها': 'Categories', 'Categories': 'دسته‌بندی‌ها', 'Categories / دسته بندی ها': 'دسته‌بندی‌ها',
            'پروفایل': 'Profile', 'Profile': 'پروفایل', 'profile / پروفایل': 'پروفایل',
            'فضای کاری': 'Workspace', 'Workspace': 'فضای کاری',
            'شخصی': 'Personal', 'Personal': 'شخصی',
            'پلن رایگان': 'Free Plan', 'Free Plan': 'پلن رایگان',
            'اعلان‌ها': 'Notifications', 'Notifications': 'اعلان‌ها',
            'امروز': 'Today', 'Today': 'امروز', 'فردا': 'Tomorrow', 'Tomorrow': 'فردا',
            'در انتظار': 'Pending', 'Pending': 'در انتظار',
            'انجام شده': 'Completed', 'Completed': 'انجام شده',
            'همه': 'All', 'All': 'همه',
            'زیاد': 'High', 'High': 'زیاد', 'متوسط': 'Medium', 'Medium': 'متوسط', 'کم': 'Low', 'Low': 'کم',
            'بدون اولویت': 'No priority', 'No priority': 'بدون اولویت',
            'کار جدید': 'New Task', 'New Task': 'کار جدید',
            'افزودن کار': 'Add Task', 'Add Task': 'افزودن کار',
            'ایجاد کار': 'Create Task', 'Create Task': 'ایجاد کار',
            'ایجاد کار جدید': 'Create new task', 'Create new task': 'ایجاد کار جدید',
            'ایجاد اولین کار': 'Create first task', 'Create first task': 'ایجاد اولین کار',
            'ذخیره تغییرات': 'Save Changes', 'Save Changes': 'ذخیره تغییرات',
            'انصراف': 'Cancel', 'Cancel': 'انصراف', 'تأیید': 'Confirm', 'Confirm': 'تأیید',
            'ویرایش': 'Edit', 'Edit': 'ویرایش', 'حذف': 'Delete', 'Delete': 'حذف',
            'بازگشت': 'Back', 'Back': 'بازگشت', 'خروج': 'Logout', 'Logout': 'خروج',
            'ذخیره': 'Save', 'Save': 'ذخیره', 'افزودن': 'Add', 'Add': 'افزودن',
            'جستجو': 'Search', 'Search': 'جستجو',

            'مدیریت کارها': 'Task management', 'Task management': 'مدیریت کارها',
            'کارهای من': 'My tasks', 'My tasks': 'کارهای من',
            'همه کارهایت را در یک فضای ساده و مرتب مدیریت کن.': 'Manage all your tasks in one simple, organized space.',
            'Manage all your tasks in one simple, organized space.': 'همه کارهایت را در یک فضای ساده و مرتب مدیریت کن.',
            'جستجوی کارها...': 'Search tasks...', 'Search tasks...': 'جستجوی کارها...',
            'لیست کارها': 'Task list', 'Task list': 'لیست کارها',
            'بدون تاریخ': 'No date', 'No date': 'بدون تاریخ',
            'بدون دسته': 'No category', 'No category': 'بدون دسته', 'بدون دسته‌بندی': 'No category',
            'موعد': 'Due date', 'Due date': 'موعد', 'تاریخ انجام': 'Due date',
            'تکمیل': 'Completed at', 'Completed at': 'تکمیل',
            'هنوز کاری نداری': 'You have no tasks yet', 'You have no tasks yet': 'هنوز کاری نداری',
            'اولین کارت را ایجاد کن تا کارهایت را اینجا مدیریت کنی.': 'Create your first task to manage your work here.',
            'Create your first task to manage your work here.': 'اولین کارت را ایجاد کن تا کارهایت را اینجا مدیریت کنی.',
            'اطلاعات کار جدید را وارد کنید.': 'Enter the new task details.', 'Enter the new task details.': 'اطلاعات کار جدید را وارد کنید.',
            'اطلاعات کار را ویرایش کنید.': 'Update the task details.', 'Update the task details.': 'اطلاعات کار را ویرایش کنید.',
            'مثلاً یادگیری Livewire': 'e.g. Learn Livewire', 'e.g. Learn Livewire': 'مثلاً یادگیری Livewire',
            'عنوان کار': 'Task title', 'Task title': 'عنوان کار',
            'توضیحات': 'Description', 'Description': 'توضیحات',
            'توضیحات کار...': 'Task description...', 'Task description...': 'توضیحات کار...',
            'اولویت': 'Priority', 'Priority': 'اولویت',
            'حذف کار': 'Delete task', 'Delete task': 'حذف کار',
            'آیا از حذف این کار مطمئن هستید؟': 'Are you sure you want to delete this task?',
            'Are you sure you want to delete this task?': 'آیا از حذف این کار مطمئن هستید؟',
            'در حال ایجاد...': 'Creating...', 'Creating...': 'در حال ایجاد...',
            'در حال ذخیره...': 'Saving...', 'Saving...': 'در حال ذخیره...',
            'کل کارها': 'Total Tasks', 'Total Tasks': 'کل کارها',
            'نرخ تکمیل': 'Completion Rate', 'Completion Rate': 'نرخ تکمیل',
            'نرخ': 'Rate', 'Rate': 'نرخ',
            'کارهای امروز': "Today's tasks", "Today's tasks": 'کارهای امروز',
            'مشاهده همه ←': 'View all →', 'View all →': 'مشاهده همه ←',
            'پیشرفت هفتگی': 'Weekly progress', 'Weekly progress': 'پیشرفت هفتگی',
            'عملکرد این هفته': 'Your performance this week', 'Your performance this week': 'عملکرد این هفته',
            'کارهای پیش رو': 'Upcoming tasks', 'Upcoming tasks': 'کارهای پیش رو',
            'برنامه روزهای آینده': "What's coming next", "What's coming next": 'برنامه روزهای آینده',
            'برنامه‌ریزی روزها': 'Plan your days', 'Plan your days': 'برنامه‌ریزی روزها',
            'کارهای دارای موعد را روی تقویم ببین و مدیریت کن.': 'See and manage due tasks on the calendar.',
            'See and manage due tasks on the calendar.': 'کارهای دارای موعد را روی تقویم ببین و مدیریت کن.',
            'برنامه روز': 'Day schedule', 'Day schedule': 'برنامه روز',
            'کاری برای این روز نیست': 'No tasks for this day', 'No tasks for this day': 'کاری برای این روز نیست',
            'یک کار با این تاریخ موعد بساز': 'Create a task with this due date', 'Create a task with this due date': 'یک کار با این تاریخ موعد بساز',
            'کار جدید برای این روز': 'New task for this day', 'New task for this day': 'کار جدید برای این روز',
            'ویرایش پروفایل': 'Edit profile', 'Edit profile': 'ویرایش پروفایل',
            'در حال ویرایش': 'Editing', 'Editing': 'در حال ویرایش',
            'نام شما': 'Your name', 'Your name': 'نام شما',
            'نام': 'Name', 'Name': 'نام', 'ایمیل': 'Email', 'Email': 'ایمیل', 'رمز عبور': 'Password', 'Password': 'رمز عبور',
            'کاری برای امروز نداری': 'No tasks for today', 'No tasks for today': 'کاری برای امروز نداری',
            'یک کار با تاریخ امروز بساز': "Create a task with today's due date", "Create a task with today's due date": 'یک کار با تاریخ امروز بساز',
            'رفتن به کارها': 'Go to tasks', 'Go to tasks': 'رفتن به کارها',
            'کار پیش‌رویی نداری': 'No upcoming tasks', 'No upcoming tasks': 'کار پیش‌رویی نداری',
            'برای روزهای بعد یک کار با تاریخ بساز': 'Create a task with a future due date', 'Create a task with a future due date': 'برای روزهای بعد یک کار با تاریخ بساز',
            'بر اساس کارهای دارای موعد در این هفته': 'Based on tasks due this week', 'Based on tasks due this week': 'بر اساس کارهای دارای موعد در این هفته',

            'شنبه': 'Saturday', 'Saturday': 'شنبه', 'یکشنبه': 'Sunday', 'Sunday': 'یکشنبه',
            'دوشنبه': 'Monday', 'Monday': 'دوشنبه', 'سه‌شنبه': 'Tuesday', 'Tuesday': 'سه‌شنبه',
            'چهارشنبه': 'Wednesday', 'Wednesday': 'چهارشنبه', 'پنجشنبه': 'Thursday', 'Thursday': 'پنجشنبه',
            'جمعه': 'Friday', 'Friday': 'جمعه',
            'دسته': 'Category', 'Category': 'دسته', 'دسته جدید': 'New Category', 'New Category': 'دسته جدید',
            'دسته‌بندی': 'Category', 'Category name': 'نام دسته‌بندی', 'نام دسته‌بندی': 'Category name',
            'دسته‌بندی جدید': 'New Category', 'New Category': 'دسته‌بندی جدید',
            'مدیریت دسته‌بندی‌ها': 'Category management', 'Category management': 'مدیریت دسته‌بندی‌ها',
            'دسته‌بندی‌های من': 'My categories', 'My categories': 'دسته‌بندی‌های من',
            'کارهایت را با دسته‌بندی‌های مختلف مرتب و منظم نگه دار.': 'Keep your tasks organized with different categories.',
            'Keep your tasks organized with different categories.': 'کارهایت را با دسته‌بندی‌های مختلف مرتب و منظم نگه دار.',
            'مشاهده کارها': 'View tasks', 'View tasks': 'مشاهده کارها', 'بستن کارها': 'Hide tasks', 'Hide tasks': 'بستن کارها',
            'هنوز دسته‌بندی‌ای نداری': 'You have no categories yet', 'You have no categories yet': 'هنوز دسته‌بندی‌ای نداری',
            'اولین دسته‌بندی خودت را ایجاد کن تا کارهایت را بهتر مرتب کنی.': 'Create your first category to organize your tasks better.',
            'Create your first category to organize your tasks better.': 'اولین دسته‌بندی خودت را ایجاد کن تا کارهایت را بهتر مرتب کنی.',
            'ایجاد دسته‌بندی': 'Create category', 'Create category': 'ایجاد دسته‌بندی',
            'ایجاد دسته': 'Create category', 'Create category': 'ایجاد دسته',

            'اطلاعات شخصی': 'Personal Information', 'Personal Information': 'اطلاعات شخصی',
            'فعالیت': 'Activity', 'Activity': 'فعالیت',
            'عضو از': 'Member since', 'Member since': 'عضو از',
            'پروفایل': 'Profile', 'Profile': 'پروفایل',

            'صفحه پیدا نشد': 'Page not found', 'Page not found': 'صفحه پیدا نشد',
            'ورود': 'Login', 'Login': 'ورود', 'ثبت‌نام': 'Register', 'Register': 'ثبت‌نام',
            'کارها را انجام بده.': 'Get things done.', 'Get things done.': 'کارها را انجام بده.'
        };

        window.DoNextLanguage = function () {
            return localStorage.getItem('language') || 'fa';
        };

        window.DoNextSetDocumentLanguage = function (lang) {
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';
            document.documentElement.classList.toggle('lang-en', lang === 'en');
            document.documentElement.classList.toggle('lang-fa', lang === 'fa');
        };

        window.DoNextToggleTheme = function () {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            localStorage.setItem('donext-theme', isDark ? 'dark' : 'light');
        };

        window.DoNextTranslate = function () {
            const lang = window.DoNextLanguage();
            window.DoNextSetDocumentLanguage(lang);
            const map = window.DoNextTranslations || {};

            const translateNode = function (node) {
                if (!node || !node.parentElement) return;
                const parent = node.parentElement;
                if (['SCRIPT', 'STYLE', 'TEXTAREA'].includes(parent.tagName)) return;
                if (parent.closest('[data-no-translate]')) return;
                if (parent.hasAttribute('data-user-content')) return;

                const raw = node.nodeValue;
                const trimmed = raw.trim();
                if (!trimmed) return;

                // Do not translate task/category/user-generated values.
                if (parent.matches('input, textarea, option') && parent.closest('[wire\\:model]')) return;

                let translated = null;
                if (map[trimmed]) {
                    const candidate = map[trimmed];
                    const currentLooksFa = /[\u0600-\u06FF]/.test(trimmed);
                    const candidateLooksFa = /[\u0600-\u06FF]/.test(candidate);
                    if ((lang === 'en' && currentLooksFa) || (lang === 'fa' && !currentLooksFa) || trimmed.includes(' / ')) {
                        translated = candidate;
                    }
                }

                const countMatch = trimmed.match(/^(\d+)\s+کار در لیست$/);
                if (lang === 'en' && countMatch) translated = countMatch[1] + ' tasks in list';

                const remainMatch = trimmed.match(/^(\d+)\s+کار باقی مانده$/);
                if (lang === 'en' && remainMatch) translated = remainMatch[1] + ' tasks remaining';

                const ofMatch = trimmed.match(/^(\d+)\s+از\s+(\d+)\s+کار$/);
                if (lang === 'en' && ofMatch) translated = ofMatch[1] + ' of ' + ofMatch[2] + ' tasks';

                if (translated && translated !== trimmed) {
                    node.nodeValue = raw.replace(trimmed, translated);
                }
            };

            const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
            const nodes = [];
            while (walker.nextNode()) nodes.push(walker.currentNode);
            nodes.forEach(translateNode);

            document.querySelectorAll('[placeholder]').forEach(function (el) {
                const key = el.getAttribute('data-i18n-placeholder') || el.getAttribute('placeholder');
                if (map[key] && !el.matches('[wire\\:model]')) {
                    if (!el.hasAttribute('data-i18n-placeholder')) el.setAttribute('data-i18n-placeholder', key);
                    el.setAttribute('placeholder', map[key]);
                }
            });

            document.querySelectorAll('[data-lang-toggle]').forEach(function (el) {
                el.textContent = lang === 'fa' ? 'EN' : 'FA';
            });
        };

        window.DoNextToggleLanguage = function () {
            const next = window.DoNextLanguage() === 'fa' ? 'en' : 'fa';
            localStorage.setItem('language', next);
            localStorage.setItem('donext-lang', next);
            window.DoNextSetDocumentLanguage(next);
            window.DoNextTranslate();
        };

        document.addEventListener('DOMContentLoaded', function () {
            window.DoNextTranslate();

            const observer = new MutationObserver(function () {
                if (window.DoNextLanguage() === 'en') {
                    window.clearTimeout(window.__doNextTranslateTimer);
                    window.__doNextTranslateTimer = window.setTimeout(window.DoNextTranslate, 20);
                }
            });

            observer.observe(document.body, { childList: true, subtree: true });
        });

        document.addEventListener('livewire:init', function () {
            Livewire.hook('morph.updated', function () {
                window.clearTimeout(window.__doNextTranslateTimer);
                window.__doNextTranslateTimer = window.setTimeout(window.DoNextTranslate, 20);
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
