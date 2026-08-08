<div x-data="{ open:false, title:'تأیید عملیات', message:'آیا از انجام این کار مطمئنی؟' }" @confirm.window="title=$event.detail.title || title; message=$event.detail.message || message; open=true" x-cloak x-show="open" x-transition class="fixed inset-0 z-[210] grid place-items-center bg-slate-950/50 p-4 backdrop-blur-sm" role="dialog" aria-modal="true">
    <div @click.outside="open=false" class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
        <div class="grid h-12 w-12 place-items-center rounded-2xl bg-amber-50 text-xl text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">!</div>
        <h3 class="mt-5 text-xl font-black" x-text="title"></h3>
        <p class="mt-2 text-sm leading-6 text-slate-400" x-text="message"></p>
        <div class="mt-7 flex gap-3">
            <button @click="open=false" class="flex-1 rounded-xl border border-slate-200 py-3 text-sm font-bold dark:border-slate-700">انصراف</button>
            <button @click="open=false; $dispatch('toast', {message:'عملیات با موفقیت انجام شد', type:'success'})" class="flex-1 rounded-xl bg-rose-600 py-3 text-sm font-bold text-white hover:bg-rose-700">تأیید</button>
        </div>
    </div>
</div>