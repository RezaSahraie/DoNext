<p align="center">
  <img src="docs/assets/logo.svg" width="140" alt="لوگوی DoNext" />
</p>

<h1 align="center">DoNext</h1>

<p align="center">
  <b>یک اپلیکیشن سریع و متمرکز برای مدیریت کارها و تقویم شخصی<br>ساخته‌شده با Laravel و Livewire</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+"/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/Livewire-3.8-4E56A6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire 3.8"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4"/>
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT"/>
</p>

<p align="center">
  <a href="README.md">🇬🇧 English</a> &nbsp;•&nbsp; <b>🇮🇷 فارسی</b>
</p>

<br>

<p align="center">
  <img src="docs/assets/Screenshot-Dashboard%201.png" width="90%" alt="داشبورد DoNext" />
</p>

---

<div dir="rtl">

**DoNext** یک اپلیکیشن ساده و بدون شلوغی برای مدیریت کارهای روزانه است؛ برای کسانی که فقط می‌خواهند روزشان را برنامه‌ریزی کنند و کارها را پیش ببرند.  
این ابزار یک لیست تسک قدرتمند را با نمای کامل تقویم، دسته‌بندی‌های رنگی و یک داشبورد که واقعاً وضعیت هفته را نشان می‌دهد ترکیب می‌کند — همه در یک رابط کاربری واکنش‌گرا با Livewire و **بدون رفرش صفحه**.

<br>

## ✨ امکانات

<table>
  <tr>
    <td width="50%" valign="top">
      <h3>📊 داشبورد هوشمند</h3>
      <p>تعداد کل / تکمیل‌شده / کارهای امروز، درصد تکمیل، کارهای پیش‌رو و نمودار زیبای ۷ روز اخیر.</p>
      <img src="docs/assets/Screenshot-Dashboard%202.png" width="100%" alt="داشبورد" />
    </td>
    <td width="50%" valign="top">
      <h3>✅ مدیریت قدرتمند کارها</h3>
      <p>ساخت، ویرایش، تکمیل و حذف تسک‌ها همراه با اولویت (کم / متوسط / زیاد)، تاریخ سررسید و دسته‌بندی.</p>
      <img src="docs/assets/Screenshot-Tasks%201.png" width="100%" alt="تسک‌ها" />
    </td>
  </tr>
  <tr>
    <td width="50%" valign="top">
      <h3>📅 نمای کامل تقویم</h3>
      <p>نمای ماهانه با نمایش تسک‌های هر روز، افزودن سریع برای هر تاریخ و تیک‌زدن سریع کارها.</p>
      <img src="docs/assets/Screenshot-Calendar%201.png" width="100%" alt="تقویم" />
    </td>
    <td width="50%" valign="top">
      <h3>🏷️ دسته‌بندی‌های زیبا</h3>
      <p>دسته‌بندی‌های سفارشی با رنگ و آیکون دلخواه، همراه با شمارش و نمایش فیلترشده تسک‌های هر دسته.</p>
      <img src="docs/assets/Screenshot-Categories.png" width="100%" alt="دسته‌بندی‌ها" />
    </td>
  </tr>
</table>

<br>

### امکانات بیشتر

| امکان | توضیح |
|--------|-------------|
| 🔍 **جست‌وجو و فیلتر** | جست‌وجوی آنی + فیلتر بر اساس همه / در حال انجام / تکمیل‌شده / سررسید امروز |
| 👤 **پروفایل** | ویرایش نام و ایمیل + خلاصه شخصی درصد تکمیل کارها |
| 🔐 **احراز هویت** | ورود، ثبت‌نام، فراموشی و بازیابی رمز عبور — آماده و کامل |
| ⚡ **رابط کاربری واکنش‌گرا** | ۱۰۰٪ Livewire — تعامل آنی بدون نیاز به فریم‌ورک جاوااسکریپت جداگانه |

<br>

<p align="center">
  <img src="docs/assets/Screenshot-Tasks%202.png" width="48%" alt="لیست تسک‌ها" />
  &nbsp;
  <img src="docs/assets/Screenshot-Calendar%202.png" width="48%" alt="نمای تقویم" />
</p>

<p align="center">
  <img src="docs/assets/Screenshot-Login.png" width="40%" alt="صفحه ورود" />
</p>

---

## 🛠️ فناوری‌های استفاده‌شده

| لایه | فناوری |
|-------|------------|
| **بک‌اند** | PHP 8.2+ · Laravel 12 |
| **فرانت‌اند** | Livewire 3 · Tailwind CSS 4 · Vite |
| **دیتابیس** | به‌صورت پیش‌فرض SQLite (هر دیتابیس پشتیبانی‌شده توسط Laravel قابل استفاده است) |
| **تست** | PHPUnit |

---

## 🚀 شروع سریع

**پیش‌نیازها:** PHP نسخه ۸.۲ به بالا · Composer · Node.js نسخه ۱۸ به بالا · npm

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

# ۵. اجرای پروژه (سرور + صف + Vite همزمان)
composer run dev
```

سپس آدرس **http://localhost:8000** را باز کنید و یک حساب کاربری بسازید 🎉

---

## 📁 ساختار پروژه

```text
app/
 ├─ Livewire/          # Dashboard, Tasks, Calendar, Categories, Profile, Auth
 └─ Models/            # User, Task, Category
database/
 └─ migrations/        # ساختار جدول تسک‌ها و دسته‌بندی‌ها
resources/views/
 └─ livewire/          # ویوهای Blade هر کامپوننت
routes/web.php         # مسیرهای اپلیکیشن
docs/assets/           # اسکرین‌شات‌ها و لوگوی استفاده‌شده در این README
```

---

## 🧪 اجرای تست‌ها

```bash
php artisan test
```

---

## 🗺️ نقشه راه

- [ ] تسک‌های تکرارشونده
- [ ] یادآوری / اعلان برای تسک‌ها
- [ ] جابه‌جایی تسک‌ها با درگ‌اند‌دراپ
- [ ] حالت تاریک (Dark mode)
- [ ] فضای کاری تیمی / اشتراکی

---

## 🤝 مشارکت

مشارکت شما خوش‌آمد است!  
برای گزارش باگ یا پیشنهاد، یک issue باز کنید یا pull request بفرستید.

---

## 📄 مجوز

منتشرشده تحت مجوز **MIT**.

<br>

</div>

<p align="center">
  <sub>ساخته‌شده با ❤️ توسط Laravel و Livewire</sub>
</p>
