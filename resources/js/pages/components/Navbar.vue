<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);

onMounted(() => {
    window.addEventListener('scroll', () => {
        isScrolled.value = window.scrollY > 20;
    });
});

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
    <header 
        :class="[
            'fixed w-full z-50 transition-all duration-300',
            isScrolled ? 'bg-white shadow-md py-3' : 'bg-transparent py-5'
        ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <Link href="/" class="group">
                    <span :class="['font-extrabold text-2xl tracking-tight transition-colors leading-none', isScrolled ? 'text-gray-900 group-hover:text-blue-600' : 'text-white drop-shadow-md group-hover:text-blue-200']">
                        Raharja Mandiri
                    </span>
                </Link>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex gap-6 lg:gap-8 items-center">
                <Link href="/" :class="['font-medium transition-colors hover:text-blue-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Beranda</Link>
                
                <div class="relative group">
                    <button :class="['flex items-center gap-1 font-medium transition-colors hover:text-blue-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">
                        Tentang Kami
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 transition-transform group-hover:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                    </button>
                    <div class="absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 w-56 flex flex-col gap-1">
                            <Link href="/tentang/visi-misi" class="px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Visi dan Misi</Link>
                            <Link href="/tentang/sejarah" class="px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Sejarah</Link>
                            <Link href="/tentang/kepengurusan" class="px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Susunan Kepengurusan</Link>
                        </div>
                    </div>
                </div>

                <Link href="/galeri" :class="['font-medium transition-colors hover:text-blue-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Galeri</Link>
                <Link href="/artikel" :class="['font-medium transition-colors hover:text-blue-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Artikel/Berita</Link>
                
                <div class="relative group">
                    <button :class="['flex items-center gap-1 font-medium transition-colors hover:text-blue-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">
                        Donasi
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 transition-transform group-hover:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                    </button>
                    <div class="absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 w-48 flex flex-col gap-1">
                            <Link href="/donasi/rekening" class="px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Rekening Donasi</Link>
                            <Link href="/donasi/kebutuhan" class="px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Daftar Kebutuhan</Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- CTA & Mobile Toggle -->
            <div class="flex items-center gap-4">
                <Link href="/kontak" class="hidden md:inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-lg hover:shadow-blue-500/30">
                    Hubungi Kami
                </Link>
                
                <button @click="toggleMobileMenu" class="md:hidden p-2 rounded-md" :class="isScrolled ? 'text-gray-800' : 'text-white'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-show="isMobileMenuOpen" class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl py-4 flex flex-col px-4 gap-2 border-t border-gray-100 max-h-[85vh] overflow-y-auto">
            <Link href="/" class="text-gray-800 font-medium p-3 hover:bg-blue-50 rounded-lg transition-colors">Beranda</Link>
            
            <details class="group">
                <summary class="flex justify-between items-center text-gray-800 font-medium p-3 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer list-none">
                    Tentang Kami
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition-transform group-open:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                </summary>
                <div class="flex flex-col pl-6 pr-2 pt-1 pb-2 gap-1 border-l-2 border-blue-100 ml-4 mt-1">
                    <Link href="/tentang/visi-misi" class="text-gray-600 text-sm p-2 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Visi dan Misi</Link>
                    <Link href="/tentang/sejarah" class="text-gray-600 text-sm p-2 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Sejarah</Link>
                    <Link href="/tentang/kepengurusan" class="text-gray-600 text-sm p-2 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Susunan Kepengurusan</Link>
                </div>
            </details>

            <Link href="/galeri" class="text-gray-800 font-medium p-3 hover:bg-blue-50 rounded-lg transition-colors">Galeri</Link>
            <Link href="/artikel" class="text-gray-800 font-medium p-3 hover:bg-blue-50 rounded-lg transition-colors">Artikel/Berita</Link>
            
            <details class="group">
                <summary class="flex justify-between items-center text-gray-800 font-medium p-3 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer list-none">
                    Donasi
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition-transform group-open:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                </summary>
                <div class="flex flex-col pl-6 pr-2 pt-1 pb-2 gap-1 border-l-2 border-blue-100 ml-4 mt-1">
                    <Link href="/donasi/rekening" class="text-gray-600 text-sm p-2 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Rekening Donasi</Link>
                    <Link href="/donasi/kebutuhan" class="text-gray-600 text-sm p-2 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Daftar Kebutuhan</Link>
                </div>
            </details>

            <div class="mt-4 px-2">
                <Link href="/kontak" class="flex justify-center w-full px-5 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition-all">
                    Hubungi Kami
                </Link>
            </div>
        </div>
    </header>
</template>
