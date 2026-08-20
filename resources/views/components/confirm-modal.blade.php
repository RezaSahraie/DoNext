<div
    x-data="{
        open: false,
        title: '',
        message: '',
        taskId: null,
        lang: localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa',
        translations: {
            'حذف کار': 'Delete task',
            'Delete task': 'حذف کار',
            'آیا از حذف این کار مطمئن هستید؟': 'Are you sure you want to delete this task?',
            'Are you sure you want to delete this task?': 'آیا از حذف این کار مطمئن هستید؟'
        },
        translate(value) {
            if (this.lang === 'fa') return /[\u0600-\u06FF]/.test(value) ? value : (this.translations[value] || value);
            return /[\u0600-\u06FF]/.test(value) ? (this.translations[value] || value) : value;
        },
        refreshLanguage() {
            this.lang = localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa';
        }
    }"
    @donext-language-changed.window="refreshLanguage()"
    @confirm.window="refreshLanguage(); title = $event.detail.title || 'Confirm action'; message = $event.detail.message || 'Are you sure?'; taskId = $event.detail.taskId || null; open = true;"
    x-cloak x-show="open" x-transition
    class="fixed inset-0 z-[210] grid place-items-center bg-slate-950/50 p-4 backdrop-blur-sm"
    role="dialog" aria-modal="true"
>
    <div @click.outside="open = false"
        class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
        <div class="grid h-12 w-12 place-items-center rounded-2xl bg-rose-50 text-xl font-black text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">!</div>

        <h3 class="mt-5 text-xl font-black text-slate-900 dark:text-white" x-text="translate(title)"></h3>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400" x-text="translate(message)"></p>

        <div class="mt-7 flex gap-3">
            <button type="button" @click="open = false"
                class="flex-1 rounded-xl border border-slate-200 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                <span x-show="lang === 'fa'">انصراف</span>
                <span x-show="lang === 'en'">Cancel</span>
            </button>

            <button type="button"
                @click="open = false; if (taskId) $dispatch('delete-task', { taskId: taskId });"
                class="flex-1 rounded-xl bg-rose-600 py-3 text-sm font-bold text-white transition hover:bg-rose-700">
                <span x-show="lang === 'fa'">حذف</span>
                <span x-show="lang === 'en'">Delete</span>
            </button>
        </div>
    </div>
</div>
