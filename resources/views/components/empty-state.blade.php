@props(['title' => 'چیزی برای نمایش نیست', 'description' => 'هنوز داده‌ای در این بخش وجود ندارد.', 'action' => null])
<div class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center dark:border-slate-700 dark:bg-slate-900">
    <div class="grid h-16 w-16 place-items-center rounded-2xl bg-indigo-50 text-2xl text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">○</div>
    <h3 class="mt-5 text-lg font-black">{{ $title }}</h3>
    <p class="mt-2 max-w-sm text-sm leading-6 text-slate-400">{{ $description }}</p>
    @if($action)<button class="mt-6 rounded-xl bg-indigo-600 px-5 py-3 text-xs font-bold text-white hover:bg-indigo-700">{{ $action }}</button>@endif
</div>