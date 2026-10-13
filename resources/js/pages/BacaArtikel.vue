<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import { onMounted, computed, watch } from 'vue';

const props = defineProps<{
    article?: {
        id: number;
        title: string;
        slug: string;
        category: string;
        summary: string;
        content: string;
        image: string;
        quote?: string;
        quoteAuthor?: string;
        additionalImages?: string[];
        date?: string;
    };
    recommended?: Array<{
        id: number;
        title: string;
        slug: string;
        category: string;
        summary: string;
        image: string;
    }>;
}>();

const page = usePage();

const urlParams = computed(() => {
    const search = page.url.split('?')[1] || '';
    return new URLSearchParams(search);
});

const dynamicTitle = computed(() => {
    return props.article?.title || urlParams.value.get('title') || 'Membangun Harapan Baru Melalui Pendidikan Inklusif di Pelosok Sumedang';
});

const dynamicImg = computed(() => {
    return props.article?.image || urlParams.value.get('img') || '/assets/images/sepatu-3.jpg';
});

const dynamicCat = computed(() => {
    return props.article?.category || urlParams.value.get('category') || 'Pendidikan';
});

const dynamicDate = computed(() => {
    return props.article?.date || '10 Oktober 2026';
});

const dynamicSummary = computed(() => {
    return props.article?.summary || urlParams.value.get('summary') || 'Pendidikan adalah jendela dunia, namun bagi sebagian anak-anak di Tanjungsari, jendela itu masih tertutup rapat. Kami hadir untuk membukanya lebar-lebar.';
});

const dynamicContent = computed(() => {
    if (props.article?.content) {
        return props.article.content;
    }
    return 'Perjalanan panjang Yayasan Raharja Mandiri dalam memberikan pendidikan yang layak tidaklah mudah. Banyak rintangan yang dihadapi, mulai dari keterbatasan fasilitas hingga akses lokasi yang menantang.\n\nBulan ini, kami berhasil mendistribusikan ratusan paket pendidikan berupa seragam, buku tulis, dan perlengkapan sekolah kepada lebih dari 50 anak asuh. Bantuan ini merupakan hasil kolektif dari para donatur yang dermawan.';
});

const dynamicQuote = computed(() => {
    return props.article?.quote || 'Mereka tidak meminta untuk dilahirkan dalam keterbatasan, tapi kita bisa memilih untuk memberi mereka ketidakterbatasan.';
});

const dynamicQuoteAuthor = computed(() => {
    return props.article?.quoteAuthor || 'H. Ahmad Sunaryo, Ketua Yayasan';
});

const dynamicAdditionalImages = computed(() => {
    if (props.article?.additionalImages && props.article.additionalImages.length > 0) {
        return props.article.additionalImages;
    }
    return ['/assets/images/sepatu-1.jpg', '/assets/images/sepatu-3.jpg'];
});

const defaultRecommended = [
    { 
        title: 'Kunjungan Komunitas Berbagi Kasih', 
        slug: 'kunjungan-komunitas-berbagi-kasih',
        image: '/assets/images/relawan-3.jpg', 
        category: 'Kunjungan', 
        summary: 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas di hari Minggu...',
    },
    { 
        title: 'Pembangunan Ruang Belajar Baru', 
        slug: 'pembangunan-ruang-belajar-baru',
        image: '/assets/images/tanam-2.jpg', 
        category: 'Infrastruktur', 
        summary: 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti...',
    }
];

const recommendedJournals = computed(() => {
    if (props.recommended && props.recommended.length > 0) {
        return props.recommended;
    }
    return defaultRecommended;
});

onMounted(() => {
    window.scrollTo(0, 0);
});

watch(() => page.url, () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

<template>
    <Head :title="dynamicTitle + ' | Panti Sosial Raharja Mandiri'" />

    <div class="bg-gray-50 min-h-screen font-sans selection:bg-teal-500 selection:text-white">
        <Navbar />

        <!-- Cinematic Hero Header -->
        <header class="relative w-full h-[70vh] md:h-[85vh] overflow-hidden group">
            <div class="absolute inset-0 bg-black/60 z-10 transition-colors duration-700 group-hover:bg-black/40"></div>
            <img :src="dynamicImg" alt="Cover Jurnal" class="absolute inset-0 w-full h-full object-cover animate-slow-zoom" />
            
            <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-end pb-24 md:pb-32">
                <div class="flex items-center gap-4 mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                    <span class="px-4 py-1.5 bg-teal-500 text-white text-xs font-black uppercase tracking-widest rounded-full">{{ dynamicCat }}</span>
                    <span class="text-gray-300 text-sm font-medium tracking-wide">{{ dynamicDate }}</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] tracking-tight mb-8 animate-fade-in-up max-w-4xl" style="animation-delay: 0.3s;">
                    {{ dynamicTitle }}
                </h1>

                <div class="flex items-center gap-4 animate-fade-in-up" style="animation-delay: 0.5s;">
                    <div class="w-12 h-12 rounded-full border-2 border-white/20 bg-gray-800 flex items-center justify-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">Ditulis oleh Tim Redaksi</p>
                        <p class="text-gray-400 text-xs">Panti Sosial Raharja Mandiri</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Editorial Content -->
        <main class="relative z-30 -mt-10 bg-white rounded-t-[3rem] shadow-2xl">
            <div class="max-w-3xl mx-auto px-6 py-20 md:py-24">
                
                <article class="prose prose-lg md:prose-xl prose-gray max-w-none">
                    <p class="lead text-2xl md:text-3xl font-medium text-gray-800 leading-relaxed mb-10 border-l-4 border-teal-500 pl-6">
                        {{ dynamicSummary }}
                    </p>

                    <!-- Content Body -->
                    <div class="whitespace-pre-line text-lg md:text-xl text-gray-700 leading-relaxed space-y-6">
                        {{ dynamicContent }}
                    </div>

                    <!-- Cinematic Pull Quote -->
                    <figure v-if="dynamicQuote" class="my-14 border-y border-gray-200 py-10 text-center relative">
                        <div class="absolute inset-0 flex items-center justify-center opacity-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-48 h-48"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                        </div>
                        <blockquote class="relative z-10">
                            <p class="text-3xl md:text-4xl font-black text-gray-900 leading-tight mb-4 tracking-tight">"{{ dynamicQuote }}"</p>
                        </blockquote>
                        <figcaption v-if="dynamicQuoteAuthor" class="relative z-10 text-sm font-bold text-gray-500 tracking-widest uppercase mt-6">
                            — {{ dynamicQuoteAuthor }}
                        </figcaption>
                    </figure>

                    <!-- In-article Image Grid -->
                    <div v-if="dynamicAdditionalImages && dynamicAdditionalImages.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-12">
                        <div v-for="(imgUrl, imgIdx) in dynamicAdditionalImages" :key="imgIdx" class="overflow-hidden rounded-2xl aspect-[4/3]">
                            <img :src="imgUrl" :alt="'Dokumentasi ' + (imgIdx + 1)" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" />
                        </div>
                    </div>
                </article>

                <!-- Share & Tags -->
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold uppercase tracking-wider">{{ dynamicCat }}</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold uppercase tracking-wider">Sosial</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-bold text-gray-500 uppercase tracking-widest">Bagikan:</span>
                        <div class="flex gap-3">
                            <button class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center hover:bg-teal-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center hover:bg-teal-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- Related Journals -->
        <section class="bg-gray-900 py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">Baca Jurnal <br/><span class="text-gray-500">Lainnya</span></h2>
                    <Link href="/artikel" class="hidden md:flex items-center gap-2 text-teal-400 font-bold hover:text-white transition-colors group">
                        Lihat Semua 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 transform group-hover:translate-x-1 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Related Card -->
                    <Link v-for="(journal, index) in recommendedJournals" :key="index" :href="'/artikel/' + journal.slug" class="flex flex-col bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 group">
                        <div class="relative h-72 overflow-hidden">
                            <img :src="journal.image" :alt="journal.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                            <div class="absolute bottom-6 left-6">
                                <span class="bg-blue-600 text-white px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">{{ journal.category }}</span>
                            </div>
                        </div>
                        <div class="p-8 md:p-10 flex-1 flex flex-col">
                            <h4 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-8 group-hover:text-blue-600 transition-colors leading-tight">
                                {{ journal.title }}
                            </h4>
                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Rekomendasi</span>
                                <div class="inline-flex items-center text-gray-900 group-hover:text-blue-600 transition-colors font-bold uppercase tracking-widest text-sm">
                                    Baca Kisah
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
                
                <div class="mt-8 md:hidden">
                    <Link href="/artikel" class="flex justify-center items-center gap-2 text-teal-400 font-bold border border-teal-400/30 py-4 rounded-xl hover:bg-teal-400/10 transition-colors">
                        Lihat Semua Jurnal
                    </Link>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
