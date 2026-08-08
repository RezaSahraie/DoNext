@extends('layouts.app')

@section('title', 'Calendar — DoNext')
@section('heading', 'Calendar')

@section('content')
<div x-data="{ view: 'month', selected: 8, showEvent: false }" class="space-y-6">

    <section class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="mb-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">برنامه‌ریزی روزها</p>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">تقویم</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">کارها و برنامه‌های پیش رو را در یک نمای مرتب ببین.</p>
        </div>
        <button @click="showEvent = true" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700"><span class="text-lg">+</span> برنامه جدید</button>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-2">
                <button class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">‹</button>
                <button class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">›</button>
                <button class="rounded-xl bg-indigo-50 px-4 py-2.5 text-xs font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">امروز</button>
                <h3 class="ms-2 text-lg font-black">مرداد ۱۴۰۵</h3>
            </div>
            <div class="flex rounded-xl bg-slate-100 p-1 dark:bg-slate-800">
                <button @click="view='month'" :class="view === 'month' ? 'bg-white text-indigo-600 shadow-sm dark:bg-slate-700 dark:text-indigo-400' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-xs font-bold">ماه</button>
                <button @click="view='week'" :class="view === 'week' ? 'bg-white text-indigo-600 shadow-sm dark:bg-slate-700 dark:text-indigo-400' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-xs font-bold">هفته</button>
                <button @click="view='day'" :class="view === 'day' ? 'bg-white text-indigo-600 shadow-sm dark:bg-slate-700 dark:text-indigo-400' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-xs font-bold">روز</button>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-3">
            <div class="grid grid-cols-7 border-b border-slate-200 dark:border-slate-800">
                <template x-for="day in ['شنبه','یکشنبه','دوشنبه','سه‌شنبه','چهارشنبه','پنجشنبه','جمعه']">
                    <div class="py-3 text-center text-[11px] font-bold text-slate-400" x-text="day"></div>
                </template>
            </div>

            <div class="grid grid-cols-7">
                <template x-for="cell in Array.from({length: 35}, (_, i) => i + 1)">
                    <button @click="selected = cell" :class="selected === cell ? 'bg-indigo-50 ring-2 ring-inset ring-indigo-500 dark:bg-indigo-500/10' : ''" class="group min-h-28 border-b border-e border-slate-100 p-2 text-start transition hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-800/50">
                        <span :class="selected === cell ? 'bg-indigo-600 text-white' : 'text-slate-500 dark:text-slate-400'" class="grid h-7 w-7 place-items-center rounded-lg text-xs font-bold" x-text="cell <= 31 ? cell : ''"></span>
                        <div x-show="cell === 8" class="mt-2 rounded-lg bg-rose-50 px-2 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">تکمیل پروژه</div>
                        <div x-show="cell === 9" class="mt-1 rounded-lg bg-indigo-50 px-2 py-1 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">مطالعه Laravel</div>
                        <div x-show="cell === 10" class="mt-1 rounded-lg bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">طراحی Tasks</div>
                    </button>
                </template>
            </div>
        </section>

        <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5">
                <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400">شنبه ۱۸ مرداد</p>
                <h3 class="mt-1 text-xl font-black">برنامه امروز</h3>
            </div>
            <div class="space-y-3">
                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <div class="flex items-center justify-between"><span class="text-xs font-bold text-slate-400">۱۸:۰۰</span><span class="rounded-full bg-rose-50 px-2 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">زیاد</span></div>
                    <h4 class="mt-3 text-sm font-black">تکمیل پروژه DoNext</h4><p class="mt-1 text-xs text-slate-400">کارهای امروز</p>
                </div>
                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <div class="flex items-center justify-between"><span class="text-xs font-bold text-slate-400">۲۰:۰۰</span><span class="rounded-full bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">متوسط</span></div>
                    <h4 class="mt-3 text-sm font-black">مطالعه Livewire</h4><p class="mt-1 text-xs text-slate-400">یادگیری و تمرین</p>
                </div>
            </div>
        </aside>
    </div>

    <div x-show="showEvent" x-cloak x-transition class="fixed inset-0 z-[100] grid place-items-center bg-slate-950/50 p-4 backdrop-blur-sm" @keydown.escape.window="showEvent=false">
        <div @click.outside="showEvent=false" class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-6 flex items-start justify-between"><div><h3 class="text-xl font-black">برنامه جدید</h3><p class="mt-1 text-xs text-slate-400">این فرم فقط برای نمایش UI است.</p></div><button @click="showEvent=false" class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800">✕</button></div>
            <div class="space-y-4"><input class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none focus:border-indigo-400 dark:border-slate-700 dark:bg-slate-800" placeholder="عنوان برنامه"><div class="grid grid-cols-1 gap-3 sm:grid-cols-2"><input type="date" class="h-12 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm dark:border-slate-700 dark:bg-slate-800"><input type="time" class="h-12 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm dark:border-slate-700 dark:bg-slate-800"></div><button @click="showEvent=false" class="w-full rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white hover:bg-indigo-700">ذخیره</button></div>
        </div>
    </div>
</div>
@endsection