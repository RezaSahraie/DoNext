@section('title', 'Profile — DoNext')
@section('heading', 'Profile / پروفایل')
<div class="mx-auto max-w-5xl space-y-6">
    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="h-36 bg-gradient-to-r from-indigo-600 via-violet-500 to-cyan-400"></div>
        <div class="px-6 pb-6">
            <div class="-mt-14 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="grid h-28 w-28 place-items-center rounded-3xl border-8 border-white bg-indigo-100 text-4xl font-black text-indigo-700 shadow-xl dark:border-slate-900 dark:bg-indigo-500/20 dark:text-indigo-300">
                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                </div>

                @if ($editMode)
                    <button type="button" wire:click="cancelEdit" class="rounded-xl border border-slate-200 px-4 py-2.5 text-xs font-bold transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        <span x-show="window.DoNextLanguage() === 'fa'">انصراف</span>
                        <span x-show="window.DoNextLanguage() === 'en'" x-cloak>Cancel</span>
                    </button>
                @else
                    <button type="button" wire:click="openEdit" class="rounded-xl border border-slate-200 px-4 py-2.5 text-xs font-bold transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        <span x-show="window.DoNextLanguage() === 'fa'">ویرایش پروفایل</span>
                        <span x-show="window.DoNextLanguage() === 'en'" x-cloak>Edit profile</span>
                    </button>
                @endif
            </div>

            <h2 class="mt-4 text-2xl font-black">{{ $user->name }}</h2>
            <p class="mt-1 text-sm text-slate-400">
                {{ $user->email }} ·
                <span x-show="window.DoNextLanguage() === 'fa'">عضو از {{ $user->created_at->format('Y') }}</span>
                <span x-show="window.DoNextLanguage() === 'en'" x-cloak>Member since {{ $user->created_at->format('Y') }}</span>
            </p>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2 dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between">
                <h3 class="font-black">
                    <span x-show="window.DoNextLanguage() === 'fa'">اطلاعات شخصی</span>
                    <span x-show="window.DoNextLanguage() === 'en'" x-cloak>Personal information</span>
                </h3>
                @if ($editMode)
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <span x-show="window.DoNextLanguage() === 'fa'">در حال ویرایش</span>
                        <span x-show="window.DoNextLanguage() === 'en'" x-cloak>Editing</span>
                    </span>
                @endif
            </div>

            @if ($editMode)
                <form wire:submit="updateProfile" class="mt-6 space-y-5">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-500">
                                <span x-show="window.DoNextLanguage() === 'fa'">نام</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Name</span>
                            </label>
                            <input id="name" type="text" wire:model="name" autocomplete="name" class="mt-2 h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white" placeholder="نام شما">
                            @error('name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-500">
                                <span x-show="window.DoNextLanguage() === 'fa'">ایمیل</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Email</span>
                            </label>
                            <input id="email" type="email" wire:model="email" autocomplete="email" class="mt-2 h-11 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white" placeholder="email@example.com">
                            @error('email') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" wire:loading.attr="disabled" wire:target="updateProfile" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60">
                            <span wire:loading.remove wire:target="updateProfile">
                                <span x-show="window.DoNextLanguage() === 'fa'">ذخیره تغییرات</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Save changes</span>
                            </span>
                            <span wire:loading wire:target="updateProfile">
                                <span x-show="window.DoNextLanguage() === 'fa'">در حال ذخیره...</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Saving...</span>
                            </span>
                        </button>
                        <button type="button" wire:click="cancelEdit" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-bold transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                            <span x-show="window.DoNextLanguage() === 'fa'">انصراف</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Cancel</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div><p class="text-xs font-bold text-slate-500">نام</p><p class="mt-2 text-sm font-semibold">{{ $user->name }}</p></div>
                    <div><p class="text-xs font-bold text-slate-500">ایمیل</p><p class="mt-2 text-sm font-semibold">{{ $user->email }}</p></div>
                </div>
            @endif
        </section>

        <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h3 class="font-black"><span x-show="window.DoNextLanguage() === 'fa'">فعالیت</span><span x-show="window.DoNextLanguage() === 'en'" x-cloak>Activity</span></h3>
            <div class="mt-6 space-y-5">
                <div><p class="text-3xl font-black">{{ $totalTasks }}</p><p class="text-xs text-slate-400">کل کارها</p></div>
                <div><p class="text-3xl font-black text-emerald-600 dark:text-emerald-400">{{ $completedTasks }}</p><p class="text-xs text-slate-400">انجام شده</p></div>
                <div><p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">{{ $completionRate }}%</p><p class="text-xs text-slate-400">نرخ تکمیل</p></div>
            </div>
        </aside>
    </div>
</div>
