<div x-data="{ done: false, showAll: false }" class="space-y-6">
    {{-- Welcome --}}
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-indigo-800 p-6 text-white shadow-xl shadow-indigo-500/10 sm:p-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold ring-1 ring-white/15"><span x-show="language==='fa'">شنبه، ۱۸ مرداد ۱۴۰۵</span><span x-show="language==='en'">Saturday, August 9, 2026</span></span>
            <h2 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl"><span x-show="language==='fa'">عصر بخیر، رضا 👋</span><span x-show="language==='en'">Good evening, Reza 👋</span></h2>
            <p class="mt-3 max-w-xl text-sm leading-7 text-indigo-100"><span x-show="language==='fa'">امروز هم یک قدم دیگر به هدف‌هایت نزدیک شو. کارهای مهمت را انجام بده و روزت را با موفقیت تمام کن.</span><span x-show="language==='en'">Take another step toward your goals today. Finish what matters and end your day with a win.</span></p>
            <a href="{{ url('/tasks') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-black text-indigo-700 shadow-lg transition hover:-translate-y-0.5"><span class="text-lg">+</span><span x-show="language==='fa'">کار جدید</span><span x-show="language==='en'">New task</span></a>
        </div>
        <div class="absolute -end-12 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div><div class="absolute -bottom-24 end-24 h-48 w-48 rounded-full bg-cyan-300/10 blur-3xl"></div>
    </section>

    {{-- Stats --}}
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach([
            ['✓','indigo','24','+12%','کل کارها','Total tasks'],
            ['✓','emerald','16','+8%','انجام شده','Completed'],
            ['◷','amber','8','Today','کارهای امروز','Today'],
            ['◒','violet','67%','This week','نرخ تکمیل','Completion rate']
        ] as $s)
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5 flex items-start justify-between"><div class="grid h-11 w-11 place-items-center rounded-xl bg-{{$s[1]}}-50 text-xl text-{{$s[1]}}-600 dark:bg-{{$s[1]}}-500/10 dark:text-{{$s[1]}}-400">{{$s[0]}}</div><span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold text-slate-500 dark:bg-slate-800">{{$s[3]}}</span></div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><span x-show="language==='fa'">{{$s[4]}}</span><span x-show="language==='en'">{{$s[5]}}</span></p><h3 class="mt-1 text-3xl font-black">{{$s[2]}}</h3>
        </div>
        @endforeach
    </section>

    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Tasks --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2 dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5 dark:border-slate-800"><div><h3 class="font-black"><span x-show="language==='fa'">کارهای امروز</span><span x-show="language==='en'">Today's tasks</span></h3><p class="mt-1 text-xs text-slate-400"><span x-show="language==='fa'">۳ کار باقی مانده</span><span x-show="language==='en'">3 tasks remaining</span></p></div><a href="{{url('/tasks')}}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400"><span x-show="language==='fa'">مشاهده همه ←</span><span x-show="language==='en'">View all →</span></a></div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach([
                    ['تکمیل پروژه Laravel','Finish Laravel project','۱۸:۰۰','High','زیاد','rose'],
                    ['مطالعه Livewire','Study Livewire','۲۰:۰۰','Medium','متوسط','amber'],
                    ['طراحی داشبورد DoNext','Design DoNext dashboard','فردا · ۱۰:۰۰','Low','کم','emerald']
                ] as $task)
                <div class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50" x-data="{checked:false}">
                    <button @click="checked=!checked" :class="checked ? 'border-indigo-500 bg-indigo-500 text-white' : 'border-slate-300 text-transparent dark:border-slate-600'" class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 transition">✓</button>
                    <div class="min-w-0 flex-1"><h4 :class="checked && 'line-through text-slate-400'" class="truncate text-sm font-bold"><span x-show="language==='fa'">{{$task[0]}}</span><span x-show="language==='en'">{{$task[1]}}</span></h4><p class="mt-1 text-xs text-slate-400">{{$task[2]}}</p></div>
                    <span class="hidden rounded-full bg-{{$task[5]}}-50 px-2.5 py-1 text-[10px] font-bold text-{{$task[5]}}-600 dark:bg-{{$task[5]}}-500/10 dark:text-{{$task[5]}}-400 sm:block"><span x-show="language==='fa'">{{$task[4]}}</span><span x-show="language==='en'">{{$task[3]}}</span></span><button class="text-slate-300 hover:text-slate-600 dark:hover:text-white">⋮</button>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Progress --}}
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-start justify-between"><div><h3 class="font-black"><span x-show="language==='fa'">پیشرفت هفتگی</span><span x-show="language==='en'">Weekly progress</span></h3><p class="mt-1 text-xs text-slate-400"><span x-show="language==='fa'">عملکرد این هفته</span><span x-show="language==='en'">Your performance this week</span></p></div><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">+18%</span></div>
            <div class="my-7 flex items-center gap-5"><div class="relative grid h-32 w-32 shrink-0 place-items-center rounded-full" style="background:conic-gradient(#4f46e5 0 67%,#e2e8f0 67% 100%)"><div class="grid h-24 w-24 place-items-center rounded-full bg-white dark:bg-slate-900"><span class="text-2xl font-black">67%</span></div></div><div><p class="text-sm font-bold"><span x-show="language==='fa'">۱۶ از ۲۴ کار</span><span x-show="language==='en'">16 of 24 tasks</span></p><p class="mt-2 text-xs leading-5 text-slate-400"><span x-show="language==='fa'">عملکردت بهتر از هفته قبل بوده.</span><span x-show="language==='en'">You're doing better than last week.</span></p></div></div>
            <div class="flex h-24 items-end gap-2">@foreach([45,65,80,55,90,70,35] as $n)<div class="flex h-full flex-1 flex-col justify-end gap-2"><div class="rounded-t-lg bg-indigo-500/70" style="height:{{$n}}%"></div><span class="text-center text-[9px] text-slate-400">{{['ش','ی','د','س','چ','پ','ج'][$loop->index]}}</span></div>@endforeach</div>
        </section>
    </div>

    {{-- Upcoming --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-5 flex items-center justify-between"><div><h3 class="font-black"><span x-show="language==='fa'">کارهای پیش رو</span><span x-show="language==='en'">Upcoming tasks</span></h3><p class="mt-1 text-xs text-slate-400"><span x-show="language==='fa'">برنامه روزهای آینده</span><span x-show="language==='en'">What's coming next</span></p></div><a href="{{url('/calendar')}}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400"><span x-show="language==='fa'">تقویم ←</span><span x-show="language==='en'">Calendar →</span></a></div>
        <div class="grid gap-3 md:grid-cols-3">
            @foreach([['شنبه','Saturday','طراحی UI','UI Design','فردا','Tomorrow'],['یکشنبه','Sunday','مرور پروژه','Project review','پس‌فردا','In 2 days'],['دوشنبه','Monday','انتشار نسخه اول','First release','۳ روز دیگر','In 3 days']] as $u)<div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-800/50"><div class="flex items-center justify-between"><span class="text-xs font-bold text-indigo-600 dark:text-indigo-400"><span x-show="language==='fa'">{{$u[0]}}</span><span x-show="language==='en'">{{$u[1]}}</span></span><span class="text-[10px] text-slate-400"><span x-show="language==='fa'">{{$u[4]}}</span><span x-show="language==='en'">{{$u[5]}}</span></span></div><h4 class="mt-3 text-sm font-bold"><span x-show="language==='fa'">{{$u[2]}}</span><span x-show="language==='en'">{{$u[3]}}</span></h4></div>@endforeach
        </div>
    </section>
</div>