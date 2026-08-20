<div
    x-data="{
        open: false,
        message: '',
        type: 'success',
        lang: localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa',
        translations: {
            'Task created successfully.': 'کار با موفقیت ایجاد شد.',
            'Task completed successfully.': 'کار با موفقیت انجام شد.',
            'Task marked as pending.': 'کار به حالت در انتظار برگشت.',
            'Task deleted successfully.': 'کار با موفقیت حذف شد.',
            'Task updated successfully.': 'کار با موفقیت ویرایش شد.',
            'Category created successfully': 'دسته‌بندی با موفقیت ایجاد شد.',
            'Category edited successfully': 'دسته‌بندی با موفقیت ویرایش شد.',
            'Category deleted successfully': 'دسته‌بندی با موفقیت حذف شد.',
            'Profile updated successfully.': 'پروفایل با موفقیت به‌روزرسانی شد.',
            'The provided credentials are incorrect.': 'اطلاعات ورود صحیح نیست.',
            'Password reset link sent successfully.': 'لینک بازیابی رمز عبور با موفقیت ارسال شد.',
            'Password has been reset successfully.': 'رمز عبور با موفقیت تغییر کرد.'
        },
        translate(value) {
            if (this.lang === 'fa') return this.translations[value] || value;
            return value;
        },
        refreshLanguage() {
            this.lang = localStorage.getItem('language') || localStorage.getItem('donext-lang') || 'fa';
        }
    }"
    @donext-language-changed.window="refreshLanguage()"
    @toast.window="refreshLanguage(); message=$event.detail.message; type=$event.detail.type || 'success'; open=true; setTimeout(()=>open=false, 3500)"
    x-cloak x-show="open" x-transition
    class="fixed bottom-5 end-5 z-[200] w-[calc(100%-2rem)] max-w-sm"
>
    <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-2xl dark:border-slate-700 dark:bg-slate-900">
        <div :class="type==='success' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-rose-100 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400'"
            class="grid h-10 w-10 shrink-0 place-items-center rounded-xl font-black"
            x-text="type==='success' ? '✓' : '!'">✓</div>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-bold" x-text="translate(message)"></p>
            <p class="mt-1 text-xs text-slate-400">DoNext</p>
        </div>
        <button type="button" @click="open=false" class="text-slate-400 hover:text-slate-700 dark:hover:text-white">✕</button>
    </div>
</div>
