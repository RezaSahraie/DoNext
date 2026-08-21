<aside x-data="{ lang: localStorage.getItem('language') || 'fa' }"
    x-init="window.addEventListener('donext-language-changed', () => lang = window.DoNextLanguage())"
    class="fixed inset-y-0 start-0 z-50 hidden w-72 flex-col border-e border-slate-200 bg-white/95 p-5 shadow-sm backdrop-blur-xl dark:border-slate-800 dark:bg-slate-950/95 lg:flex">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/donext-logo.svg') }}" alt="DoNext" class="h-11 w-11 rounded-2xl shadow-lg shadow-indigo-500/20">
            <div><h1 class="text-lg font-black tracking-tight">DoNext</h1><p class="text-[11px] font-medium text-slate-400">Get things done.</p></div>
        </a>
    </div>

    <div class="mb-3 px-3"><span class="text-[11px] font-bold uppercase tracking-widest text-slate-400">
        <span x-show="lang === 'fa'">فضای کاری</span><span x-show="lang === 'en'">Workspace</span>
    </span></div>

    <nav class="space-y-1">
        @php($items=[['/dashboard','Dashboard','داشبورد','⌂'],['/tasks','Tasks','کارها','✓'],['/calendar','Calendar','تقویم','▣'],['/categories','Categories','دسته‌بندی‌ها','#']])
        @foreach($items as $item)
            <a href="{{ url($item[0]) }}" class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ request()->is(ltrim($item[0],'/')) ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400' }}">
                <span class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800">{{ $item[3] }}</span>
                <span><span class="block"><span x-show="lang === 'fa'">{{ $item[2] }}</span><span x-show="lang === 'en'">{{ $item[1] }}</span></span></span>
                @if($item[0]==='/tasks')<span class="ms-auto rounded-full bg-indigo-100 px-2 py-0.5 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-400">12</span>@endif
            </a>
        @endforeach
    </nav>

    <div class="my-6 border-t border-slate-200 dark:border-slate-800"></div>
    <div class="mb-3 px-3"><span class="text-[11px] font-bold uppercase tracking-widest text-slate-400">
        <span x-show="lang === 'fa'">شخصی</span><span x-show="lang === 'en'">Personal</span>
    </span></div>

    <nav class="space-y-1">
        <a href="{{ url('/profile') }}" class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ request()->is('profile') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800">◎</span>
            <span><span x-show="lang === 'fa'">پروفایل</span><span x-show="lang === 'en'">Profile</span></span>
        </a>
    </nav>

    <div class="mt-auto rounded-2xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-900">
        <div class="flex items-center gap-3">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-indigo-100 font-bold text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300">{{ mb_strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div class="min-w-0">
                <p class="truncate text-sm font-bold">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="truncate text-xs text-slate-400"><span x-show="lang === 'fa'">پلن رایگان</span><span x-show="lang === 'en'">Free Plan</span></p>
            </div>
            <button class="ms-auto text-slate-400 hover:text-slate-700 dark:hover:text-white" aria-label="User menu">⋮</button>
        </div>
    </div>
</aside>
