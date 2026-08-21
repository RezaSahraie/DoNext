<p align="center">
  <img src="docs/assets/logo.svg" width="110" alt="DoNext logo" />
</p>

<h1 align="center">DoNext</h1>

<p align="center">
  <strong>A clean, focused task & calendar manager built with Laravel and Livewire.</strong>
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
  <b>🇬🇧 English</b> &nbsp;·&nbsp; <a href="README.fa.md">🇮🇷 فارسی</a>
</p>

---

## 📝 About

**DoNext** is a personal productivity app designed to keep everyday planning simple. It combines task management, categories, a calendar, authentication, profile settings, and a useful dashboard in one responsive interface.

The project is built around **Laravel + Livewire**, so interactions can happen without turning the application into a separate JavaScript SPA.

## ✨ Features

- 📊 **Dashboard** — task totals, completion rate, today's tasks, upcoming tasks, and weekly progress
- ✅ **Task management** — create, edit, complete, and delete tasks
- 🎯 **Priorities** — low, medium, and high priority levels
- 📅 **Calendar** — monthly calendar with tasks grouped by date
- 🏷️ **Categories** — custom categories with colors and icons
- 🔍 **Search & filters** — quickly find tasks and filter by status or due date
- 👤 **Profile** — manage account information and view completion statistics
- 🔐 **Authentication** — login, registration, and password recovery
- ⚡ **Live interactions** — powered by Livewire without a separate frontend framework

## 🖥️ Project Screenshots

> Screenshots will be added here from the running DoNext application so the README only contains real project UI, not mockups or stock images.

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| UI / Components | Livewire 3.8, Blade |
| Styling | Tailwind CSS 4 |
| Build Tool | Vite |
| Database | SQLite by default / Laravel-supported databases |
| Testing | PHPUnit |

## 📁 Project Structure

```text
app/
├── Livewire/          # Livewire page and UI components
└── Models/            # Eloquent models

database/
└── migrations/        # Database schema

resources/views/
└── livewire/          # Blade views for Livewire components

routes/
└── web.php            # Application routes

docs/
└── assets/            # Project documentation assets
```

## 🚀 Getting Started

### Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- npm

### Installation

```bash
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext

composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite (default)
touch database/database.sqlite
php artisan migrate

composer run dev
```

Open **http://localhost:8000** and create an account to start using DoNext.

## 🧪 Testing

```bash
php artisan test
```

## 🤝 Contributing

Contributions, bug reports, and ideas are welcome. Feel free to open an issue or submit a pull request.

## 📄 License

DoNext is released under the **MIT License**.

<p align="center">
  <sub>Built with ❤️ using Laravel & Livewire</sub>
</p>
