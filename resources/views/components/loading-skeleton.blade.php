<div {{ $attributes->merge(['class' => 'animate-pulse space-y-4']) }} aria-hidden="true">
    <div class="h-5 w-40 rounded-lg bg-slate-200 dark:bg-slate-800"></div>
    <div class="h-4 w-64 rounded-lg bg-slate-200 dark:bg-slate-800"></div>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @for($i = 0; $i < 3; $i++)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
                <div class="h-10 w-10 rounded-xl bg-slate-200 dark:bg-slate-800"></div>
                <div class="mt-5 h-5 w-2/3 rounded bg-slate-200 dark:bg-slate-800"></div>
                <div class="mt-3 h-3 w-full rounded bg-slate-200 dark:bg-slate-800"></div>
                <div class="mt-2 h-3 w-4/5 rounded bg-slate-200 dark:bg-slate-800"></div>
            </div>
        @endfor
    </div>
</div>