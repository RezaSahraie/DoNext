<p align="center">
  <img src="docs/assets/logo.svg" width="120" alt="لوگوی DoNext" />
</p>

<h1 align="center">DoNext</h1>

<p align="center">
  <b>یک اپلیکیشن سریع و متمرکز برای مدیریت کارها و تقویم شخصی، ساخته‌شده با Laravel و Livewire</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.2+"/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/Livewire-3.8-4E56A6?logo=livewire&logoColor=white" alt="Livewire 3.8"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4"/>
  <img src="https://img.shields.io/badge/License-MIT-informational" alt="License MIT"/>
</p>

<p align="center">
  <a href="README.md">🇬🇧 English</a> &nbsp;|&nbsp; <b>🇮🇷 فارسی</b>
</p>

---

<div dir="rtl">

**DoNext** یک اپلیکیشن ساده و بدون شلوغی برای مدیریت کارهای روزانه است؛ برای کسانی که فقط می‌خواهند روزشان را برنامه‌ریزی کنند و کارها را پیش ببرند. این ابزار یک لیست تسک را با نمای کامل تقویم، دسته‌بندی‌های رنگی، و یک داشبورد که واقعاً وضعیت هفته را نشان می‌دهد ترکیب می‌کند — همه در یک رابط کاربری واکنش‌گرا با Livewire و بدون رفرش صفحه.

### ✨ امکانات

| | |
|---|---|
| 📊 **داشبورد** | تعداد کل / تکمیل‌شده / کارهای امروز، درصد تکمیل، کارهای پیش‌رو و نمودار میله‌ای تکمیل ۷ روز اخیر |
| ✅ **مدیریت کارها (Tasks)** | ساخت، ویرایش، تکمیل و حذف تسک‌ها همراه با اولویت (کم/متوسط/زیاد)، تاریخ سررسید و دسته‌بندی |
| 🔍 **جست‌وجو و فیلتر** | جست‌وجوی آنی تسک‌ها و فیلتر بر اساس همه / در حال انجام / تکمیل‌شده / سررسید امروز |
| 📅 **تقویم** | نمای کامل ماهانه با نمایش تسک‌های هر روز، افزودن سریع تسک برای هر تاریخ، و تیک‌زدن سریع کارها |
| 🏷️ **دسته‌بندی‌ها** | دسته‌بندی‌های سفارشی با رنگ و آیکون دلخواه، همراه با شمارش و نمایش تسک‌های هر دسته |
| 👤 **پروفایل** | ویرایش نام و ایمیل و مشاهده خلاصه‌ای شخصی از درصد تکمیل کارها |
| 🔐 **احراز هویت** | ورود، ثبت‌نام و فرآیند فراموشی/بازیابی رمز عبور به‌صورت آماده |
| ⚡ **رابط کاربری واکنش‌گرا** | ساخته‌شده کاملاً با Livewire — تعامل آنی بدون نیاز به فریم‌ورک جاوااسکریپت جداگانه |

### 🛠️ فناوری‌های استفاده‌شده

- **بک‌اند:** PHP 8.2+‏، Laravel 12
- **فرانت‌اند:** Livewire 3، Tailwind CSS 4، Vite
- **دیتابیس:** به‌صورت پیش‌فرض SQLite (هر دیتابیس پشتیبانی‌شده توسط Laravel قابل استفاده است)
- **تست:** PHPUnit

### 🚀 شروع سریع

**پیش‌نیازها:** PHP نسخه ۸.۲ به بالا، Composer، Node.js نسخه ۱۸ به بالا، npm

```bash
# ۱. کلون کردن ریپازیتوری
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext

# ۲. نصب پکیج‌ها
composer install
npm install

# ۳. تنظیم فایل محیطی
cp .env.example .env
php artisan key:generate

# ۴. راه‌اندازی دیتابیس (پیش‌فرض SQLite)
touch database/database.sqlite
php artisan migrate

# ۵. اجرای پروژه (سرور + صف + ویت، همزمان)
composer run dev
```

سپس آدرس **http://localhost:8000** را باز کنید و یک حساب کاربری بسازید.

### 📁 ساختار پروژه

```
app/
 ├─ Livewire/         # Dashboard, Tasks, Calendar, Categories, Profile, Auth
 └─ Models/           # User, Task, Category
database/
 └─ migrations/       # ساختار جدول تسک‌ها و دسته‌بندی‌ها
resources/views/
 └─ livewire/         # ویوهای Blade هر کامپوننت
routes/web.php        # مسیرهای اپلیکیشن
```

### 🧪 اجرای تست‌ها

```bash
php artisan test
```

### 🗺️ نقشه راه

- [ ] تسک‌های تکرارشونده
- [ ] یادآوری / اعلان برای تسک‌ها
- [ ] جابه‌جایی تسک‌ها با درگ‌اند‌دراپ
- [ ] حالت تاریک (Dark mode)
- [ ] فضای کاری تیمی / اشتراکی

### 🤝 مشارکت

مشارکت شما خوش‌آمد است! برای گزارش باگ یا پیشنهاد، یک issue باز کنید یا pull request بفرستید.

### 📄 مجوز

منتشرشده تحت مجوز MIT.

</div>

<p align="center"><sub>ساخته‌شده با ❤️ توسط Laravel و Livewire</sub></p>
