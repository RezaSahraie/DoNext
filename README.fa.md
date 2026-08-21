<p align="center">
  <img src="docs/assets/logo.svg" width="110" alt="لوگوی DoNext" />
</p>

<h1 align="center">DoNext</h1>

<p align="center">
  <strong>یک اپلیکیشن ساده و کاربردی برای مدیریت کارها و تقویم، ساخته‌شده با Laravel و Livewire</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.2+"/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/Livewire-3.8-4E56A6?logo=livewire&logoColor=white" alt="Livewire 3.8"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4"/>
  <img src="https://img.shields.io/badge/Vite-6-646CFF?logo=vite&logoColor=white" alt="Vite"/>
  <img src="https://img.shields.io/badge/License-MIT-informational" alt="MIT License"/>
</p>

<p align="center">
  <a href="README.md">🇬🇧 English</a> &nbsp;·&nbsp; <b>🇮🇷 فارسی</b>
</p>

---

<div dir="rtl">

## 📝 درباره پروژه

**DoNext** یک اپلیکیشن مدیریت بهره‌وری شخصی است که برای برنامه‌ریزی ساده و منظم کارهای روزانه طراحی شده است. این پروژه مدیریت تسک‌ها، دسته‌بندی‌ها، تقویم، احراز هویت، پروفایل و داشبورد را در یک رابط کاربری واکنش‌گرا کنار هم قرار می‌دهد.

هسته پروژه با **Laravel + Livewire** ساخته شده تا بسیاری از تعاملات رابط کاربری بدون نیاز به تبدیل پروژه به یک SPA جداگانه انجام شوند.

## ✨ امکانات

- 📊 **داشبورد** — نمایش آمار تسک‌ها، درصد تکمیل، کارهای امروز، کارهای پیش‌رو و وضعیت هفتگی
- ✅ **مدیریت تسک‌ها** — ساخت، ویرایش، تکمیل و حذف کارها
- 🎯 **اولویت‌بندی** — اولویت کم، متوسط و زیاد
- 📅 **تقویم** — نمایش ماهانه و نمایش تسک‌ها بر اساس تاریخ
- 🏷️ **دسته‌بندی‌ها** — دسته‌بندی سفارشی با رنگ و آیکون
- 🔍 **جست‌وجو و فیلتر** — پیدا کردن سریع تسک‌ها و فیلتر بر اساس وضعیت یا تاریخ
- 👤 **پروفایل** — مدیریت اطلاعات حساب و مشاهده آمار تکمیل کارها
- 🔐 **احراز هویت** — ورود، ثبت‌نام و بازیابی رمز عبور
- ⚡ **تعامل سریع** — ساخته‌شده با Livewire بدون نیاز به یک فریم‌ورک جداگانه برای فرانت‌اند

## 🖥️ تصاویر واقعی پروژه

> تصاویر این بخش از نسخه در حال اجرای خود DoNext اضافه خواهند شد تا README فقط شامل اسکرین‌شات واقعی پروژه باشد، نه ماکاپ یا تصاویر استوک.

## 🛠️ تکنولوژی‌های استفاده‌شده

| بخش | تکنولوژی |
|---|---|
| بک‌اند | PHP 8.2+، Laravel 12 |
| رابط و کامپوننت‌ها | Livewire 3.8، Blade |
| استایل | Tailwind CSS 4 |
| ابزار Build | Vite |
| دیتابیس | SQLite به‌صورت پیش‌فرض / دیتابیس‌های پشتیبانی‌شده توسط Laravel |
| تست | PHPUnit |

## 📁 ساختار پروژه

```text
app/
├── Livewire/          # کامپوننت‌ها و صفحات Livewire
└── Models/            # مدل‌های Eloquent

database/
└── migrations/        # ساختار دیتابیس

resources/views/
└── livewire/          # Viewهای Blade کامپوننت‌های Livewire

routes/
└── web.php            # مسیرهای اپلیکیشن

docs/
└── assets/            # فایل‌های مربوط به مستندات پروژه
```

## 🚀 راه‌اندازی پروژه

### پیش‌نیازها

- PHP نسخه ۸.۲ یا بالاتر
- Composer
- Node.js نسخه ۱۸ یا بالاتر
- npm

### نصب

```bash
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext

composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite (دیتابیس پیش‌فرض)
touch database/database.sqlite
php artisan migrate

composer run dev
```

بعد از اجرا، وارد **http://localhost:8000** شوید و حساب کاربری خود را بسازید.

## 🧪 اجرای تست‌ها

```bash
php artisan test
```

## 🤝 مشارکت

اگر ایده، پیشنهاد یا گزارشی برای باگ دارید، می‌توانید یک Issue ایجاد کنید یا Pull Request ارسال کنید.

## 📄 مجوز

DoNext تحت مجوز **MIT** منتشر شده است.

</div>

<p align="center">
  <sub>ساخته‌شده با ❤️ با استفاده از Laravel و Livewire</sub>
</p>
