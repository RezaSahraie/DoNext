<div align="center">
  <img src="https://raw.githubusercontent.com/RezaSahraie/DoNext/docs-branding-demo/public/images/donext-logo.svg" width="110" alt="DoNext Logo">
  <h1>DoNext</h1>
  <p><strong>A modern bilingual task management application built with Laravel & Livewire.</strong></p>
  <p>یک اپلیکیشن مدرن و دوزبانه برای مدیریت کارها با Laravel و Livewire</p>

  <p>
    <a href="https://github.com/RezaSahraie/DoNext"><img src="https://img.shields.io/badge/GitHub-DoNext-181717?logo=github" alt="GitHub"></a>
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12">
    <img src="https://img.shields.io/badge/Livewire-3.x-4E56A6?logo=livewire&logoColor=white" alt="Livewire">
    <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.2+">
    <img src="https://img.shields.io/badge/License-MIT-green" alt="MIT License">
  </p>
</div>

---

## 🇮🇷 فارسی

### درباره پروژه

**DoNext** یک Task Manager مدرن است که برای تمرین و ساخت یک پروژه واقعی با **Laravel 12، Livewire و Eloquent** توسعه داده شده است.

هدف پروژه این است که کاربر بتواند بدون پیچیدگی، کارهای روزانه خود را ایجاد، دسته‌بندی، ویرایش، تکمیل و مدیریت کند.

### ✨ امکانات

- 🔐 ثبت‌نام، ورود، خروج و بازیابی رمز عبور
- 📝 ایجاد، ویرایش، حذف و تکمیل Taskها
- 🗂️ ساخت و مدیریت Categoryها
- 📅 تقویم برای مشاهده کارهای دارای موعد
- 📊 داشبورد با آمار و وضعیت کارها
- 👤 مدیریت پروفایل کاربر
- 🌐 رابط کاربری دوزبانه فارسی / English
- 🌓 حالت روشن / تاریک
- ⚡ تعاملات پویا با Livewire بدون نیاز به SPA
- 📱 رابط کاربری واکنش‌گرا
- 🔎 جستجو و فیلتر کارها
- 🎯 اولویت‌بندی Taskها
- 📆 تعیین Due Date
- 🧩 ارتباط Task و Category
- 🗄️ Migration، Factory و Seeder برای دیتابیس
- 🎨 طراحی اختصاصی با برند و لوگوی DoNext

### 🖥️ پیش‌نمایش پروژه

<p align="center">
  <img src="https://raw.githubusercontent.com/RezaSahraie/DoNext/docs-branding-demo/public/images/donext-logo.svg" width="90" alt="DoNext">
</p>

> نسخه آنلاین پروژه باید پس از Deploy شدن در بخش **Live Demo** قرار بگیرد. لینک جعلی قرار داده نشده است.

**Live Demo:** `Coming soon`

### 🧱 تکنولوژی‌ها

| بخش | تکنولوژی |
|---|---|
| Backend | Laravel 12 |
| Language | PHP 8.2+ |
| Reactive UI | Livewire 3.x |
| Database | SQLite (development) / PostgreSQL or MySQL (deployment) |
| Frontend | Blade + Tailwind CSS |
| Build Tool | Vite |
| ORM | Eloquent |
| Testing | PHPUnit |

### 🚀 اجرای پروژه

#### پیش‌نیازها

- PHP 8.2 یا بالاتر
- Composer
- Node.js و npm
- SQLite یا MySQL

#### نصب

```bash
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext
composer install
npm install
copy .env.example .env
php artisan key:generate
```

فایل `.env` را برای دیتابیس تنظیم کنید، سپس:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

سپس پروژه در آدرس زیر قابل دسترسی است:

`http://127.0.0.1:8000`

برای توسعه فرانت‌اند:

```bash
npm run dev
```

### 🧪 حساب آزمایشی

Seeder پروژه یک حساب آزمایشی ایجاد می‌کند:

- Email: `test@donext.test`
- Password: `12345678`

> این حساب فقط برای Demo و توسعه است و نباید روی محیط واقعی با همین رمز استفاده شود.

### 📁 ساختار مهم پروژه

```text
DoNext/
├── app/
│   ├── Livewire/          # Livewire page components
│   └── Models/            # Eloquent models
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── components/
│       └── layouts/
├── routes/
│   └── web.php
├── public/
│   └── images/
│       └── donext-logo.svg
├── Dockerfile
└── README.md
```

### 🌍 نسخه آنلاین بدون Clone

کاربر نهایی برای استفاده از DoNext **نباید Laravel، PHP، Composer یا Git را نصب کند**.

برای این حالت، پروژه باید روی یک سرویس Hosting اجرا شود و یک URL عمومی داشته باشد. معماری پیشنهادی:

```text
User Browser
     │
     ▼
Public DoNext URL
     │
     ▼
Laravel + Livewire
     │
     ▼
PostgreSQL / MySQL
```

فایل `Dockerfile` نیز برای Deploy کردن پروژه روی سرویس‌های Docker-based آماده شده است.

> نکته: SQLite برای توسعه محلی عالی است، اما برای یک نسخه آنلاین واقعی بهتر است PostgreSQL یا MySQL استفاده شود تا داده‌های کاربران پایدار بمانند.

### 🤝 مشارکت

Pull Request و Issue برای بهبود پروژه آزاد است.

### 📄 License

This project is licensed under the MIT License.

---

## 🇬🇧 English

### About

**DoNext** is a modern task management application built as a real-world Laravel learning project using **Laravel 12, Livewire and Eloquent**.

The goal is to provide a clean workspace where users can create, organize, update, complete and manage their daily tasks.

### ✨ Features

- 🔐 Authentication: register, login, logout and password reset
- 📝 Create, edit, delete and complete tasks
- 🗂️ Create and manage categories
- 📅 Calendar for due tasks
- 📊 Dashboard with task statistics
- 👤 User profile management
- 🌐 Persian / English bilingual UI
- 🌓 Light / dark mode
- ⚡ Dynamic interactions powered by Livewire
- 📱 Responsive UI
- 🔎 Task search and filtering
- 🎯 Task priorities
- 📆 Due dates
- 🧩 Task / category relationships
- 🗄️ Database migrations, factories and seeders
- 🎨 Custom DoNext branding and logo

### 🖥️ Project Preview

<p align="center">
  <img src="https://raw.githubusercontent.com/RezaSahraie/DoNext/docs-branding-demo/public/images/donext-logo.svg" width="90" alt="DoNext">
</p>

> The real application URL will be added to **Live Demo** after deployment. No fake URL is used.

**Live Demo:** `Coming soon`

### 🧱 Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12 |
| Language | PHP 8.2+ |
| Reactive UI | Livewire 3.x |
| Database | SQLite (development) / PostgreSQL or MySQL (deployment) |
| Frontend | Blade + Tailwind CSS |
| Build Tool | Vite |
| ORM | Eloquent |
| Testing | PHPUnit |

### 🚀 Local Setup

#### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- SQLite or MySQL

#### Installation

```bash
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext
composer install
npm install
copy .env.example .env
php artisan key:generate
```

Configure the database in `.env`, then run:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Open:

`http://127.0.0.1:8000`

For frontend development:

```bash
npm run dev
```

### 🧪 Demo Account

The project seeder creates a demo account:

- Email: `test@donext.test`
- Password: `12345678`

> This account is intended for development/demo use only. Do not use this password in production.

### 📁 Project Structure

```text
DoNext/
├── app/
│   ├── Livewire/          # Livewire page components
│   └── Models/            # Eloquent models
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── components/
│       └── layouts/
├── routes/
│   └── web.php
├── public/
│   └── images/
│       └── donext-logo.svg
├── Dockerfile
└── README.md
```

### 🌍 Use It Without Cloning

End users should **not need PHP, Laravel, Composer, Node.js or Git** to use DoNext.

The application should be deployed to a hosting provider and exposed through a public URL:

```text
User Browser
     │
     ▼
Public DoNext URL
     │
     ▼
Laravel + Livewire
     │
     ▼
PostgreSQL / MySQL
```

A production `Dockerfile` is included for Docker-based hosting.

> SQLite is excellent for local development, but PostgreSQL or MySQL is recommended for a real online deployment so user data remains persistent.

### 🤝 Contributing

Issues and Pull Requests are welcome.

### 📄 License

This project is licensed under the MIT License.
