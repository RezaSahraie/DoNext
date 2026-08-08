@extends('layouts.app')

@section('title', 'Tasks — DoNext')
@section('heading', 'Tasks')

@section('content')
<div x-data="{ filter: 'all', showModal: false, search: '' }" class="space-y-6">

    {{-- Page header --}}
    <section class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="mb-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">مدیریت کارها</p>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">کارهای من</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                همه کارهایت را در یک فضای ساده و مرتب مدیریت کن.
            </p>
        </div>

        <button @click="showModal = true" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700">
            <span class="text-lg">+</span>
            کار جدید
        </button>
    </section>

    {{-- Search and filters --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="relative w-full lg:max-w-md">
                <span class="pointer-events-none absolute inset-y-0 start-0 grid w-11 place-items-center text-slate-400">⌕</span>
                <input x-model="search" type="search" placeholder="جستجوی کارها..." class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 ps-11 pe-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:border-indigo-500">
            </div>

            <div class="flex flex-wrap gap-2">
                <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'" class="rounded-xl px-4 py-2 text-xs font-bold transition">همه</button>
                <button @click="filter = 'today'" :class="filter === 'today' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'" class="rounded-xl px-4 py-2 text-xs font-bold transition">امروز</button>
                <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'" class="rounded-xl px-4 py-2 text-xs font-bold transition">در انتظار</button>
                <button @click="filter = 'completed'" :class="filter === 'completed' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'" class="rounded-xl px-4 py-2 text-xs font-bold transition">انجام شده</button>
            </div>
        </div>
    </section>

    {{-- Task list --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-5 dark:border-slate-800">
            <div>
                <h3 class="font-black">لیست کارها</h3>
                <p class="mt-1 text-xs text-slate-400">۱۲ کار در لیست</p>
            </div>
            <button class="rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-white">⋮</button>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-800">
            <template x-for="task in [
                {title:'تکمیل پروژه Laravel', meta:'امروز · ۱۸:۰۰', priority:'زیاد', color:'rose'},
                {title:'مطالعه Livewire', meta:'امروز · ۲۰:۰۰', priority:'متوسط', color:'amber'},
                {title:'طراحی داشبورد DoNext', meta:'فردا · ۱۰:۰۰', priority:'کم', color:'emerald'},
                {title:'ساخت صفحه Calendar', meta:'دوشنبه · ۱۴:۳۰', priority:'متوسط', color:'amber'},
                {title:'بهبود نسخه موبایل', meta:'سه‌شنبه · ۱۶:۰۰', priority:'کم', color:'emerald'}
            ]" :key="task.title">
                <div class="group flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <button class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 border-slate-300 text-transparent transition hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600">✓</button>
                    <div class="min-w-0 flex-1">
                        <h4 class="truncate text-sm font-bold" x-text="task.title"></h4>
                        <p class="mt-1 text-xs text-slate-400" x-text="task.meta"></p>
                    </div>
                    <span class="hidden rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300 sm:block" x-text="task.priority"></span>
                    <button class="text-slate-300 transition hover:text-slate-600 dark:hover:text-slate-200">⋮</button>
                </div>
            </template>
        </div>
    </section>

    {{-- Add task modal: UI only --}}
    <div x-show="showModal" x-cloak x-transition class="fixed inset-0 z-[100] grid place-items-center bg-slate-950/50 p-4 backdrop-blur-sm" @keydown.escape.window="showModal = false">
        <div @click.outside="showModal = false" class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-6 flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-black">ایجاد کار جدید</h3>
                    <p class="mt-1 text-xs text-slate-400">این فرم فعلاً فقط رابط کاربری است.</p>
                </div>
                <button @click="showModal = false" class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800">✕</button>
            </div>

            <div class="space-y-4">
                <input type="text" placeholder="عنوان کار" class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800">
                <textarea rows="4" placeholder="توضیحات کار..." class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800"></textarea>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <select class="h-12 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none dark:border-slate-700 dark:bg-slate-800">
                        <option>اولویت</option><option>زیاد</option><option>متوسط</option><option>کم</option>
                    </select>
                    <input type="date" class="h-12 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none dark:border-slate-700 dark:bg-slate-800">
                </div>
                <button @click="showModal = false" class="w-full rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white transition hover:bg-indigo-700">افزودن کار</button>
            </div>
        </div>
    </div>
</div>
@endsection