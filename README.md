<p align="center">
  <img src="docs/assets/logo.svg" width="120" alt="DoNext logo" />
</p>

<h1 align="center">DoNext</h1>

<p align="center">
  <b>A fast, focused personal task &amp; calendar manager built with Laravel &amp; Livewire.</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.2+"/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/Livewire-3.8-4E56A6?logo=livewire&logoColor=white" alt="Livewire 3.8"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4"/>
  <img src="https://img.shields.io/badge/License-MIT-informational" alt="License MIT"/>
</p>

<p align="center">
  <b>🇬🇧 English</b> &nbsp;|&nbsp; <a href="README.fa.md">🇮🇷 فارسی</a>
</p>

---

**DoNext** is a clean, no-nonsense task manager for people who just want to plan their day and get things done. It pairs a task list with a full calendar view, color-coded categories, and a dashboard that actually shows you how your week is going — all in a fast, reactive Livewire interface with no page reloads.

## ✨ Features

| | |
|---|---|
| 📊 **Dashboard** | Total / completed / today's tasks, completion rate, upcoming tasks, and a 7-day completion bar chart |
| ✅ **Tasks** | Create, edit, complete, and delete tasks with priority (low/medium/high), due dates, and categories |
| 🔍 **Search & filters** | Instantly search tasks and filter by all / pending / completed / due today |
| 📅 **Calendar** | Full month view with tasks per day, quick-add for any date, and one-click completion toggling |
| 🏷️ **Categories** | Custom categories with colors and icons, plus a per-category task count and view |
| 👤 **Profile** | Editable name/email and a personal completion-rate summary |
| 🔐 **Authentication** | Login, registration, and forgot/reset password flows out of the box |
| ⚡ **Reactive UI** | Built entirely with Livewire — instant interactions, zero custom JS framework needed |

## 🛠️ Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Livewire 3, Tailwind CSS 4, Vite
- **Database:** SQLite by default (any Laravel-supported DB works)
- **Testing:** PHPUnit

## 🚀 Getting Started

**Requirements:** PHP ≥ 8.2, Composer, Node.js ≥ 18, npm

```bash
# 1. Clone the repository
git clone https://github.com/RezaSahraie/DoNext.git
cd DoNext

# 2. Install dependencies
composer install
npm install

# 3. Configure the environment
cp .env.example .env
php artisan key:generate

# 4. Set up the database (SQLite by default)
touch database/database.sqlite
php artisan migrate

# 5. Run the app (server + queue + vite, all at once)
composer run dev
```

Then open **http://localhost:8000** and create an account to get started.

## 📁 Project Structure

```
app/
 ├─ Livewire/         # Dashboard, Tasks, Calendar, Categories, Profile, Auth
 └─ Models/           # User, Task, Category
database/
 └─ migrations/       # tasks & categories schema
resources/views/
 └─ livewire/         # Blade views for every component
routes/web.php        # App routes
```

## 🧪 Running Tests

```bash
php artisan test
```

## 🗺️ Roadmap

- [ ] Recurring tasks
- [ ] Task reminders / notifications
- [ ] Drag-and-drop reordering
- [ ] Dark mode
- [ ] Team / shared workspaces

## 🤝 Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request.

## 📄 License

Released under the MIT License.

<p align="center"><sub>Made with ❤️ using Laravel &amp; Livewire</sub></p>
