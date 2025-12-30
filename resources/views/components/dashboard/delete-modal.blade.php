@props(['id', 'title', 'message'])

<div 
    x-data="{ open: false }"
    x-show="open"
    x-on:open-delete-modal-{{ $id }}.window="open = true"
    x-on:keydown.escape.window="open = false"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    x-cloak
>
    <!-- Backdrop -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm"
        @click="open = false"
    ></div>

    <!-- Modal -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div 
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden"
            @click.away="open = false"
        >
            <!-- Gradient Header -->
            <div class="h-2 bg-gradient-to-r from-red-500 via-red-600 to-red-700"></div>

            <!-- Content -->
            <div class="p-6">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                    {{ $title }}
                </h3>

                <!-- Message -->
                <p class="text-gray-600 text-center text-sm mb-6">
                    {{ $message }}
                </p>

                <!-- Actions -->
                <div class="flex gap-3">
                    <button 
                        type="button"
                        @click="open = false"
                        class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Batal
                    </button>
                    <button 
                        type="button"
                        @click="$dispatch('confirm-delete-{{ $id }}')"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-red-500/30"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
