<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const isModalOpen = ref(false);
const currentYear = new Date().getFullYear();

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const handleKeydown = (e: KeyboardEvent) => {
    if (e.key === 'Escape' && isModalOpen.value) {
        closeModal();
    }
};

onMounted(() => {
    window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleKeydown);
});
</script>

<template>
    <footer class="mt-auto bg-white border-t border-gray-100 px-8 py-4">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
            <p>© {{ currentYear }} Yayasan Raharja Mandiri. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-2">
                <span class="font-medium text-gray-600">Website Supported by</span>
                <!-- Clickable Logo Trigger -->
                <button
                    type="button"
                    @click="openModal"
                    class="group inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-50 hover:bg-teal-50 border border-gray-200/80 hover:border-teal-200 transition-all duration-200 cursor-pointer shadow-2xs focus:outline-hidden focus:ring-2 focus:ring-teal-500/20"
                    title="Klik untuk mengunjungi iCraft"
                >
                    <img 
                        src="/assets/images/logo_iCraft.png" 
                        alt="iCraft Logo" 
                        class="h-5 w-auto object-contain transition-transform duration-200 group-hover:scale-105" 
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-gray-400 group-hover:text-teal-600 transition-colors">
                        <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h4a.75.75 0 0 1 0 1.5h-4Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Teleport Modal Popup -->
        <Teleport to="body">
            <Transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="isModalOpen"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-xs"
                    @click.self="closeModal"
                >
                    <!-- Modal Card -->
                    <div
                        class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 sm:p-7 transform transition-all"
                        role="dialog"
                        aria-modal="true"
                    >
                        <!-- Close Button -->
                        <button
                            type="button"
                            @click="closeModal"
                            class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors focus:outline-hidden"
                            title="Tutup"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- Header Info -->
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center p-3 bg-gray-50 rounded-2xl mb-3 border border-gray-100 shadow-2xs">
                                <img 
                                    src="/assets/images/logo_iCraft.png" 
                                    alt="iCraft Digital Solution" 
                                    class="h-9 w-auto object-contain"
                                />
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Kunjungi iCraft</h3>
                            <p class="text-sm text-gray-500 mt-1">Pilih destinasi yang ingin Anda tuju:</p>
                        </div>

                        <!-- Action Options -->
                        <div class="space-y-3">
                            <!-- 1. Website Resmi -->
                            <a
                                href="https://www.icraftds.id/"
                                target="_blank"
                                rel="noopener noreferrer"
                                @click="closeModal"
                                class="group flex items-center justify-between p-4 rounded-2xl border-2 border-gray-100 hover:border-teal-500 bg-white hover:bg-teal-50/40 transition-all duration-200 shadow-2xs hover:shadow-md"
                            >
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-teal-50 group-hover:bg-teal-600 text-teal-600 group-hover:text-white flex items-center justify-center transition-colors duration-200 shrink-0">
                                        <!-- Globe / Website Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-.778.099-1.533.284-2.253" />
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-bold text-gray-900 group-hover:text-teal-700 text-base">Website Resmi</h4>
                                        <p class="text-xs text-gray-500 font-medium">www.icraftds.id</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-teal-600 group-hover:translate-x-1 transition-all shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>

                            <!-- 2. Instagram Resmi -->
                            <a
                                href="https://www.instagram.com/icraft.ds/?hl=id"
                                target="_blank"
                                rel="noopener noreferrer"
                                @click="closeModal"
                                class="group flex items-center justify-between p-4 rounded-2xl border-2 border-gray-100 hover:border-pink-500 bg-white hover:bg-pink-50/40 transition-all duration-200 shadow-2xs hover:shadow-md"
                            >
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-pink-50 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:via-pink-500 group-hover:to-purple-600 text-pink-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shrink-0">
                                        <!-- Instagram Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-bold text-gray-900 group-hover:text-pink-600 text-base">Instagram Resmi</h4>
                                        <p class="text-xs text-gray-500 font-medium">@icraft.ds</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-1 transition-all shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>

                        <!-- Footer Batal / Tutup -->
                        <div class="mt-6">
                            <button
                                type="button"
                                @click="closeModal"
                                class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 transition-colors"
                            >
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </footer>
</template>
