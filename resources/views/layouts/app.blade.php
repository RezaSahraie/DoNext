<!DOCTYPE html>
<html lang="fa" dir="rtl" x-data="{ darkMode: localStorage.getItem('theme') === 'dark', language: localStorage.getItem('language') || 'fa' }" x-init="document.documentElement.classList.toggle('dark', darkMode);
document.documentElement.dir = language === 'fa' ? 'rtl' : 'ltr';
$watch('darkMode', value => { localStorage.setItem('theme', value ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', value); });
$watch('language', value => { localStorage.setItem('language', value);
    document.documentElement.dir = value === 'fa' ? 'rtl' : 'ltr';
    window.dispatchEvent(new CustomEvent('language-changed', { detail: { language: value } })); })" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title', 'DoNext')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: Vazirmatn, Inter, sans-serif
        }

        [x-cloak] {
            display: none !important
        }

        ::selection {
            background: rgb(99 102 241/.2)
        }

        :focus-visible {
            outline: 3px solid rgb(99 102 241/.45);
            outline-offset: 2px
        }
    </style>
    <script>
        window.DoNextPairs = {
            'داشبورد': 'Dashboard',
            'کارها': 'Tasks',
            'تقویم': 'Calendar',
            'دسته‌بندی‌ها': 'Categories',
            'آمار': 'Statistics',
            'آمار و گزارش‌ها': 'Statistics & Reports',
            'پروفایل': 'Profile',
            'تنظیمات': 'Settings',
            'فضای کاری': 'Workspace',
            'شخصی': 'Personal',
            'کارها را انجام بده.': 'Get things done.',
            'پلن رایگان': 'Free Plan',
            'جستجو': 'Search',
            'اعلان‌ها': 'Notifications',
            '۳ جدید': '3 new',
            'جستجوی کارها': 'Search tasks',
            'امروز': 'Today',
            'فردا': 'Tomorrow',
            'پس‌فردا': 'In 2 days',
            'در انتظار': 'Pending',
            'انجام شده': 'Completed',
            'همه': 'All',
            'زیاد': 'High',
            'متوسط': 'Medium',
            'کم': 'Low',
            'کار جدید': 'New Task',
            'افزودن کار': 'Add Task',
            'ایجاد کار': 'Create Task',
            'جزئیات کار': 'Task Details',
            'انگلیسی': 'English',
            'فارسی': 'Persian',
            'روشن': 'Light',
            'تیره': 'Dark',
            'سیستم': 'System',
            'ذخیره تغییرات': 'Save Changes',
            'انصراف': 'Cancel',
            'تأیید': 'Confirm',
            'ویرایش': 'Edit',
            'حذف': 'Delete',
            'بازگشت': 'Back',
            'بازگشت به داشبورد': 'Back to Dashboard',
            'ماه': 'Month',
            'هفته': 'Week',
            'روز': 'Day',
            'این هفته': 'This Week',
            'این ماه': 'This Month',
            'کاری پیدا نشد': 'No tasks found',
            'کل کارها': 'Total Tasks',
            'کارهای انجام‌شده': 'Completed Tasks',
            'نرخ تکمیل': 'Completion Rate',
            'ورود': 'Login',
            'ثبت‌نام': 'Register',
            'ثبت‌نام کن': 'Sign up',
            'حساب نداری؟': 'Don’t have an account?',
            'قبلاً حساب ساخته‌ای؟': 'Already have an account?',
            'رمز عبور': 'Password',
            'ایمیل': 'Email',
            'نام': 'Name',
            'نام خانوادگی': 'Last name',
            'مرا به خاطر بسپار': 'Remember me',
            'فراموشی رمز عبور؟': 'Forgot password?',
            'ساخت حساب': 'Create account',
            'خوش آمدی': 'Welcome back',
            'خوش آمدی 👋': 'Welcome back 👋',
            'برای ادامه وارد حساب خود شو.': 'Sign in to continue.',
            'در چند ثانیه فضای کاری خودت را بساز.': 'Create your workspace in seconds.',
            'موعد': 'Due date',
            'توضیحات': 'Description',
            'اولویت': 'Priority',
            'عمومی': 'General',
            'ظاهر': 'Appearance',
            'امنیت': 'Security',
            'زبان': 'Language',
            'منطقه زمانی': 'Time zone',
            'شروع کنید': 'Get started',
            'مدیریت کارها': 'Task Management',
            'کارهای من': 'My Tasks',
            'لیست کارها': 'Task List',
            '۱۲ کار در لیست': '12 tasks in the list',
            'این فرم فعلاً فقط رابط کاربری است.': 'This form is UI only for now.',
            'این فرم فقط برای نمایش UI است.': 'This form is UI only.',
            'عنوان کار': 'Task title',
            'عنوان برنامه': 'Event title',
            'توضیحات کار...': 'Task description...',
            'نام دسته‌بندی': 'Category name',
            'صفحه پیدا نشد': 'Page not found',
            'به نظر می‌رسد این صفحه وجود ندارد یا جابه‌جا شده است.': 'This page does not exist or has been moved.',
            'صفحه مورد نظر وجود ندارد یا جابه‌جا شده است.': 'The page you are looking for does not exist or has moved.',
            'دسته جدید': 'New Category',
            'ایجاد دسته': 'Create Category',
            'فقط رابط کاربری': 'UI only',
            'فعالیت هفتگی': 'Weekly Activity',
            'کارهای تکمیل شده': 'Completed tasks',
            'وضعیت کارها': 'Task Status',
            'تکمیل شده': 'Completed',
            'در حال انجام': 'In progress',
            'باقی‌مانده': 'Remaining',
            'اطلاعات شخصی': 'Personal Information',
            'فعالیت': 'Activity',
            'تغییر رمز عبور': 'Change password',
            'کارهای امروز': 'Today’s tasks',
            '۳ کار باقی مانده': '3 tasks remaining',
            'مشاهده همه ←': 'View all →',
            'پیشرفت هفتگی': 'Weekly progress',
            'عملکرد این هفته': 'Your performance this week',
            'عملکردت بهتر از هفته قبل بوده.': 'You’re doing better than last week.',
            '۱۶ از ۲۴ کار': '16 of 24 tasks',
            'کارهای پیش رو': 'Upcoming tasks',
            'برنامه روزهای آینده': 'What’s coming next',
            'تقویم ←': 'Calendar →',
            'برنامه‌ریزی روزها': 'Plan your days',
            'کارها و برنامه‌های پیش رو را در یک نمای مرتب ببین.': 'See your upcoming tasks and plans in one organized view.',
            'برنامه جدید': 'New event',
            'مرداد ۱۴۰۵': 'August 2026',
            'شنبه': 'Saturday',
            'یکشنبه': 'Sunday',
            'دوشنبه': 'Monday',
            'سه‌شنبه': 'Tuesday',
            'چهارشنبه': 'Wednesday',
            'پنجشنبه': 'Thursday',
            'جمعه': 'Friday',
            'تکمیل پروژه': 'Complete project',
            'مطالعه Laravel': 'Study Laravel',
            'طراحی Tasks': 'Design Tasks',
            'برنامه امروز': 'Today’s schedule',
            'کارهای امروز': 'Today’s tasks',
            'یادگیری و تمرین': 'Learning & practice',
            'تکمیل پروژه DoNext': 'Complete DoNext project',
            'تکمیل پروژه Laravel': 'Complete Laravel project',
            'مطالعه Livewire': 'Study Livewire',
            'طراحی داشبورد DoNext': 'Design DoNext dashboard',
            'ساخت صفحه Calendar': 'Build Calendar page',
            'بهبود نسخه موبایل': 'Improve mobile version',
            'طراحی UI': 'UI Design',
            'مرور پروژه': 'Project review',
            'انتشار نسخه اول': 'First release',
            'فردا': 'Tomorrow',
            '۳ روز دیگر': 'In 3 days',
            'تنظیمات برنامه': 'App settings',
            'DoNext را مطابق سلیقه خودت تنظیم کن.': 'Customize DoNext to your preferences.',
            'تنظیمات اصلی حساب و زبان': 'Main account and language settings',
            'نام نمایشی': 'Display name',
            'منطقه زمانی': 'Time zone',
            'اعلان‌های کارها': 'Task notifications',
            'یادآوری کارها': 'Task reminders',
            'کارهای نزدیک به موعد': 'Upcoming task reminders',
            'گزارش هفتگی': 'Weekly report',
            'ذخیره': 'Save',
            'حساب نداری؟': 'Don’t have an account?',
            'عصر بخیر، رضا 👋': 'Good evening, Reza 👋',
            'امروز هم یک قدم دیگر به هدف‌هایت نزدیک شو. کارهای مهمت را انجام بده و روزت را با موفقیت تمام کن.': 'Take another step toward your goals today. Finish what matters and end your day with a win.',
            'پیشرفت و روند انجام کارهایت را بررسی کن.': 'Review your progress and task completion trends.',
            'تصویر کلی عملکرد': 'Performance overview',
            'فعالیت': 'Activity',
            'ویرایش پروفایل': 'Edit profile',
            'شغل': 'Job',
            'عضو از ۲۰۲۶': 'Member since 2026',
            'Member since 2026': 'عضو از ۲۰۲۶',
            'کل کارها': 'Total Tasks',
            'انجام شده': 'Completed',
            'نرخ تکمیل': 'Completion Rate',
            'Checklist': 'چک‌لیست',
            'چک‌لیست': 'Checklist',
            'ساخت Layout': 'Build Layout',
            'طراحی Sidebar': 'Design Sidebar',
            'ساخت صفحه Tasks': 'Build Tasks page',
            'طراحی Calendar': 'Design Calendar',
            'درخواست‌های پیش‌فرض': 'Default requests',
            'روز': 'Day',
            'ماه': 'Month',
            'هفته': 'Week',
            'دسته': 'Category',
            'ایجاد کار جدید': 'Create new task',
            'این فرم فعلاً فقط رابط کاربری است.': 'This form is UI only for now.',
            'عنوان کار': 'Task title',
            'توضیحات کار...': 'Task description...',
            'اولویت': 'Priority',
            'افزودن کار': 'Add task',
            'نام دسته‌بندی': 'Category name',
            'صفحه پیدا نشد': 'Page not found',
            'به نظر می‌رسد این صفحه وجود ندارد یا جابه‌جا شده است.': 'This page does not exist or has been moved.',
            'برگشت': 'Back',
            'تمرکز کن، انجام بده، جلو برو.': 'Focus, get it done, move forward.',
            'همه کارهای روزانه‌ات را در یک فضای ساده و زیبا مدیریت کن.': 'Manage all your daily tasks in one simple and beautiful space.',
            'برای ادامه وارد حساب خود شو.': 'Sign in to continue.'
        };
        window.DoNextI18n = {
            fa: {},
            en: {}
        };
        Object.entries(DoNextPairs).forEach(([fa, en]) => {
            DoNextI18n.en[fa] = en;
            DoNextI18n.fa[en] = fa;
        });
        (function() {
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
                    const raw = n.nodeValue,
                        trimmed = raw.trim();
                    if (trimmed && map[trimmed]) n.nodeValue = raw.replace(trimmed, map[trimmed]);
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
                document.title = (map[document.title] || document.title);
                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'fa' ? 'rtl' : 'ltr';
                translating = false;
            }
            window.DoNextTranslate = translate;
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

<body
    class="min-h-screen bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-white">
    <div class="min-h-screen"><x-sidebar />
        <div class="min-h-screen lg:ms-72"><x-navbar />
            <main class="min-h-[calc(100vh-5rem)] p-4 sm:p-6 lg:p-8">{{ $slot ?? '' }}@yield('content')</main>
        </div>
    </div>
    <x-toast /><x-confirm-modal />
    @livewireScripts
</body>

</html>
