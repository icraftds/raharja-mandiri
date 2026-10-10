<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
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

// Dummy data for news
const latestNews = [
    {
        id: 1,
        title: 'Bantuan Pendidikan Semester Ganjil',
        date: '10 Okt 2026',
        summary: 'Penyaluran dana bantuan pendidikan untuk 50 anak asuh di tingkat SD dan SMP.',
        image: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 2,
        title: 'Kunjungan Komunitas Berbagi Kasih',
        date: '05 Okt 2026',
        summary: 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas Berbagi Kasih.',
        image: 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 3,
        title: 'Pembangunan Ruang Belajar Baru',
        date: '28 Sep 2026',
        summary: 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti.',
        image: 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    }
];
</script>

<template>
    <Head title="Beranda | Panti Asuhan Raharja Mandiri" />

    <div class="min-h-screen bg-gray-50 font-sans text-gray-800">
        <!-- Navbar -->
        <header 
            :class="[
                'fixed w-full z-50 transition-all duration-300',
                isScrolled ? 'bg-white shadow-md py-3' : 'bg-transparent py-5'
            ]"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold text-xl">
                        RM
                    </div>
                    <span :class="['font-bold text-xl tracking-tight transition-colors', isScrolled ? 'text-gray-900' : 'text-white drop-shadow-md']">
                        Raharja Mandiri
                    </span>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex gap-6 lg:gap-8 items-center">
                    <Link href="/" :class="['font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Beranda</Link>
                    
                    <div class="relative group">
                        <button :class="['flex items-center gap-1 font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">
                            Tentang Kami
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 transition-transform group-hover:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 w-56 flex flex-col gap-1">
                                <Link href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">Visi dan Misi</Link>
                                <Link href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">Sejarah</Link>
                                <Link href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">Susunan Kepengurusan</Link>
                            </div>
                        </div>
                    </div>

                    <Link href="#" :class="['font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Galeri</Link>
                    <Link href="#" :class="['font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Artikel/Berita</Link>
                    
                    <div class="relative group">
                        <button :class="['flex items-center gap-1 font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">
                            Donasi
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 transition-transform group-hover:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 w-48 flex flex-col gap-1">
                                <Link href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">Rekening Donasi</Link>
                                <Link href="#" class="px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-lg transition-colors">Daftar Kebutuhan</Link>
                            </div>
                        </div>
                    </div>
                    
                    <Link href="#" :class="['font-medium transition-colors hover:text-emerald-400', isScrolled ? 'text-gray-600' : 'text-gray-100']">Hubungi Kami</Link>
                </nav>

                <!-- CTA & Mobile Toggle -->
                <div class="flex items-center gap-4">
                    <Link href="#" class="hidden md:inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-emerald-600 hover:bg-emerald-700 transition-all shadow-lg hover:shadow-emerald-500/30">
                        Donasi Sekarang
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
                <Link href="/" class="text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors">Beranda</Link>
                
                <details class="group">
                    <summary class="flex justify-between items-center text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors cursor-pointer list-none">
                        Tentang Kami
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition-transform group-open:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                    </summary>
                    <div class="flex flex-col pl-6 pr-2 pt-1 pb-2 gap-1 border-l-2 border-emerald-100 ml-4 mt-1">
                        <Link href="#" class="text-gray-600 text-sm p-2 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Visi dan Misi</Link>
                        <Link href="#" class="text-gray-600 text-sm p-2 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Sejarah</Link>
                        <Link href="#" class="text-gray-600 text-sm p-2 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Susunan Kepengurusan</Link>
                    </div>
                </details>

                <Link href="#" class="text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors">Galeri</Link>
                <Link href="#" class="text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors">Artikel/Berita</Link>
                
                <details class="group">
                    <summary class="flex justify-between items-center text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors cursor-pointer list-none">
                        Donasi
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition-transform group-open:rotate-180"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
                    </summary>
                    <div class="flex flex-col pl-6 pr-2 pt-1 pb-2 gap-1 border-l-2 border-emerald-100 ml-4 mt-1">
                        <Link href="#" class="text-gray-600 text-sm p-2 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Rekening Donasi</Link>
                        <Link href="#" class="text-gray-600 text-sm p-2 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Daftar Kebutuhan</Link>
                    </div>
                </details>
                
                <Link href="#" class="text-gray-800 font-medium p-3 hover:bg-emerald-50 rounded-lg transition-colors">Hubungi Kami</Link>

                <div class="mt-4 px-2">
                    <Link href="#" class="flex justify-center w-full px-5 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 transition-all">
                        Donasi Sekarang
                    </Link>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Anak-anak Panti Asuhan" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
            </div>
            
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-20">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 text-emerald-300 backdrop-blur-sm border border-emerald-500/30 text-sm font-semibold tracking-wider mb-6 animate-fade-in-up">
                    Wujudkan Harapan Mereka
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-lg">
                    Ciptakan Senyum,<br/> Bangun Masa Depan
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto drop-shadow-md leading-relaxed">
                    Panti Asuhan Raharja Mandiri berdedikasi untuk memberikan kehidupan yang lebih baik, pendidikan yang layak, dan kasih sayang bagi anak-anak yatim piatu.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Link href="#" class="w-full sm:w-auto px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full font-bold text-lg transition-all shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:scale-105">
                        Donasi Sekarang
                    </Link>
                    <Link href="#tentang" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 rounded-full font-bold text-lg transition-all hover:scale-105">
                        Pelajari Lebih Lanjut
                    </Link>
                </div>
            </div>
        </section>

        <!-- Profil Singkat -->
        <section id="tentang" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="relative">
                        <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl relative z-10">
                            <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tentang Kami" class="w-full h-full object-cover" />
                        </div>
                        <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-emerald-100 rounded-full -z-0"></div>
                        <div class="absolute -top-8 -left-8 w-32 h-32 bg-amber-100 rounded-full -z-0"></div>
                    </div>
                    
                    <div>
                        <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-2">Tentang Kami</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            Menjadi Rumah Kedua bagi Anak-anak yang Membutuhkan
                        </h3>
                        <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                            Sejak didirikan, Panti Asuhan Raharja Mandiri telah berkomitmen untuk tidak hanya menyediakan tempat tinggal, tetapi juga lingkungan yang mendukung pertumbuhan karakter dan pendidikan anak-anak kami.
                        </p>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            Kami percaya bahwa setiap anak memiliki potensi yang luar biasa. Dengan dukungan Anda, kita bisa membantu mereka meraih cita-cita.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div class="border-l-4 border-emerald-500 pl-4">
                                <p class="text-4xl font-black text-gray-900">120+</p>
                                <p class="text-sm text-gray-500 font-medium mt-1">Anak Asuh</p>
                            </div>
                            <div class="border-l-4 border-amber-500 pl-4">
                                <p class="text-4xl font-black text-gray-900">15</p>
                                <p class="text-sm text-gray-500 font-medium mt-1">Tahun Berdiri</p>
                            </div>
                        </div>
                        
                        <Link href="#" class="inline-flex items-center gap-2 text-emerald-600 font-bold hover:text-emerald-700 transition-colors">
                            Baca Profil Lengkap
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Unggulan -->
        <section class="py-24 bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-2">Program Kami</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-16">Fokus Utama Pembinaan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Pendidikan</h4>
                        <p class="text-gray-600">Pembiayaan sekolah formal dan bimbingan belajar tambahan untuk memastikan masa depan cerah.</p>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Kesehatan & Gizi</h4>
                        <p class="text-gray-600">Pemenuhan kebutuhan makanan bergizi, vitamin, dan pemeriksaan kesehatan secara berkala.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.492-3.053c.24-.294.59-.47.962-.47h3.428m-6.882 4.045l-3.053 2.492c-.294.24-.47.59-.47.962v3.428m-4.045-6.882l5.877 5.877A2.652 2.652 0 0011.42 21m-5.877-5.877L2.492 11.42c-.24-.294-.47-.59-.47-.962V7.03m6.882 4.045l3.053-2.492c.294-.24.47-.59.47-.962V4.14m4.045 6.882l-5.877-5.877A2.652 2.652 0 0111.42 3h3.428m0 0l5.877 5.877" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Pembinaan Karakter</h4>
                        <p class="text-gray-600">Kegiatan keagamaan, pelatihan soft skill, dan pengembangan bakat untuk kemandirian.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Terbaru -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-2">Publikasi</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Kabar Terbaru</h3>
                    </div>
                    <Link href="#" class="hidden md:inline-flex items-center gap-2 text-emerald-600 font-semibold hover:text-emerald-700">
                        Lihat Semua Berita
                        <span aria-hidden="true">&rarr;</span>
                    </Link>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article v-for="news in latestNews" :key="news.id" class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-56 overflow-hidden">
                            <img :src="news.image" :alt="news.title" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800">
                                {{ news.date }}
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                <Link href="#">{{ news.title }}</Link>
                            </h4>
                            <p class="text-gray-600 text-sm flex-1 line-clamp-3 mb-4">
                                {{ news.summary }}
                            </p>
                            <Link href="#" class="inline-flex items-center gap-1 text-emerald-600 text-sm font-bold mt-auto">
                                Baca selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </div>
                
                <div class="mt-8 text-center md:hidden">
                    <Link href="#" class="inline-flex items-center gap-2 text-emerald-600 font-semibold">
                        Lihat Semua Berita &rarr;
                    </Link>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 relative overflow-hidden bg-emerald-900">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern)" />
                </svg>
            </div>
            
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Ulurkan Tangan Anda Hari Ini</h2>
                <p class="text-emerald-100 text-lg mb-10">
                    Bantuan sekecil apapun akan sangat berarti bagi kelangsungan pendidikan dan kehidupan anak-anak panti. Mari berbagi kebaikan bersama kami.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Link href="#" class="px-8 py-4 bg-white text-emerald-900 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors shadow-xl">
                        Mulai Berdonasi
                    </Link>
                    <Link href="#" class="px-8 py-4 bg-transparent border-2 border-emerald-400 text-white rounded-full font-bold text-lg hover:bg-emerald-800 transition-colors">
                        Lihat Kebutuhan Mendesak
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold">
                            RM
                        </div>
                        <span class="font-bold text-xl text-white">Raharja Mandiri</span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-sm">
                        Membangun generasi mandiri, berakhlak mulia, dan bermanfaat bagi sesama. Rumah kedua penuh kasih sayang bagi mereka yang membutuhkan.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-emerald-600 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-emerald-600 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-6">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><Link href="#" class="hover:text-emerald-400 transition-colors">Tentang Kami</Link></li>
                        <li><Link href="#" class="hover:text-emerald-400 transition-colors">Program Utama</Link></li>
                        <li><Link href="#" class="hover:text-emerald-400 transition-colors">Galeri Kegiatan</Link></li>
                        <li><Link href="#" class="hover:text-emerald-400 transition-colors">Laporan Transparansi</Link></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span class="text-sm">Jl. Kebajikan No. 123, Kelurahan Harapan, Kota Bandung 40123</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-500 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <span class="text-sm">+62 813-2210-1618</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-500 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span class="text-sm">halo@raharjamandiri.org</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500">
                <p>&copy; 2026 Panti Asuhan Raharja Mandiri. All rights reserved.</p>
            </div>
        </footer>

        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/6281322101618?text=Halo%20Pengurus%20Panti%20Asuhan%20Raharja%20Mandiri,%20saya%20ingin%20bertanya%20seputar%20donasi." 
           target="_blank"
           class="fixed bottom-6 right-6 bg-[#25D366] text-white p-4 rounded-full shadow-2xl hover:scale-110 transition-transform duration-300 z-50 flex items-center justify-center group"
           aria-label="Hubungi via WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.898-4.45 9.898-9.892 0-5.442-4.45-9.892-9.896-9.892-5.45 0-9.898 4.45-9.898 9.892 0 1.91.525 3.792 1.516 5.462l-1.01 3.687 3.798-1.009zm8.175-7.79c-.197-.1-1.168-.578-1.348-.644-.181-.067-.312-.1-.444.1-.132.199-.512.645-.628.777-.116.133-.232.149-.429.05-.198-.1-.835-.308-1.591-.984-.585-.526-.979-1.176-1.096-1.374-.116-.199-.012-.306.086-.405.089-.089.197-.229.296-.345.099-.115.132-.198.198-.33.065-.133.033-.248-.016-.347-.05-.1-.444-1.072-.608-1.468-.16-.389-.322-.336-.444-.343-.115-.006-.248-.007-.379-.007-.132 0-.348.05-.53.248-.181.198-.694.678-.694 1.653 0 .975.711 1.918.81 2.051.099.132 1.398 2.132 3.385 2.991.472.204.84.326 1.127.418.475.152.908.13 1.25.078.384-.059 1.168-.477 1.332-.938.165-.461.165-.856.116-.938-.05-.082-.181-.132-.379-.23z" />
            </svg>
            <span class="absolute right-14 bg-white text-gray-800 text-sm px-3 py-1.5 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap font-medium">
                Hubungi Kami
            </span>
        </a>
    </div>
</template>

<style>
/* Custom animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}
</style>
