<div x-data="{
    show: @entangle('show'),
    message: @entangle('message'),
    variant: @entangle('variant'),
    timeout: null
}" x-show="show"
    x-on:toast-shown.window="
        if (timeout) clearTimeout(timeout);
        timeout = setTimeout(() => { show = false }, 3000);
    "
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2" class="right-5 bottom-5 z-100 fixed w-full max-w-sm"
    style="display: none;">
    <div class="flex items-center gap-3 bg-white shadow-xl p-4 border border-zinc-200 rounded-lg text-zinc-800">

        <template x-if="variant === 'success'">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </template>
        <template x-if="variant === 'danger'">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </template>

        <p class="font-medium text-sm" x-text="message"></p>

        <button x-on:click="show = false" class="ml-auto text-zinc-400 hover:text-zinc-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
