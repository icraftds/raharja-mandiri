<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';

const featuredArticle = {
    id: 1,
    title: 'Bantuan Pendidikan Semester Ganjil 2026 Telah Berhasil Disalurkan',
    date: '10 Okt 2026',
    category: 'Pendidikan',
    summary: 'Penyaluran dana bantuan pendidikan untuk 50 anak asuh di tingkat SD dan SMP telah berhasil dilakukan berkat partisipasi seluruh donatur. Semangat belajar mereka kini semakin menyala terang dan menjadi bekal kuat untuk menyongsong masa depan.',
    image: '/assets/images/sepatu-2.jpg',
};

const articles = [
    {
        id: 2,
        title: 'Kunjungan Komunitas Berbagi Kasih',
        date: '05 Okt 2026',
        category: 'Kunjungan',
        summary: 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas di hari Minggu yang ceria dan penuh makna kebersamaan.',
        image: '/assets/images/relawan-3.jpg',
    },
    {
        id: 3,
        title: 'Pembangunan Ruang Belajar Baru',
        date: '28 Sep 2026',
        category: 'Infrastruktur',
        summary: 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti yang ditargetkan selesai akhir bulan depan.',
        image: '/assets/images/tanam-2.jpg',
    },
    {
        id: 4,
        title: 'Cek Kesehatan Gratis Bersama RSUD',
        date: '15 Sep 2026',
        category: 'Kesehatan',
        summary: 'Seluruh anak asuh mendapatkan pemeriksaan kesehatan komprehensif secara gratis dari tim dokter relawan.',
        image: '/assets/images/bukber-2.jpg',
    }
];
</script>

<template>
    <Head title="Artikel & Berita | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/relawan-4.jpg" alt="Artikel" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-blue-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Jurnal Kegiatan</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Kabar <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-blue-500">Terbaru</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Menyajikan laporan transparan, kisah inspiratif, dan rekam jejak setiap program yang berjalan di Raharja Mandiri.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-blue-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <!-- Featured Article (Cinematic Left-Right Layout) -->
                <Link :href="'/artikel/baca?img=' + encodeURIComponent(featuredArticle.image) + '&title=' + encodeURIComponent(featuredArticle.title) + '&category=' + encodeURIComponent(featuredArticle.category) + '&summary=' + encodeURIComponent(featuredArticle.summary)" class="bg-white rounded-[3rem] shadow-2xl overflow-hidden mb-20 flex flex-col lg:flex-row group border border-gray-100 hover:shadow-3xl block">
                    <div class="w-full lg:w-3/5 h-80 lg:h-auto relative overflow-hidden">
                        <img :src="featuredArticle.image" :alt="featuredArticle.title" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000" />
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-black/20 hidden lg:block"></div>
                    </div>
                    <div class="w-full lg:w-2/5 p-10 md:p-16 flex flex-col justify-center relative">
                        <span class="inline-block px-5 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider mb-6 w-max">{{ featuredArticle.category }}</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight group-hover:text-blue-600 transition-colors">
                            {{ featuredArticle.title }}
                        </h2>
                        <p class="text-gray-500 text-lg md:text-xl leading-relaxed mb-10">{{ featuredArticle.summary }}</p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-8 mt-auto">
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ featuredArticle.date }}</span>
                            <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center text-white group-hover:bg-blue-600 transition-colors transform group-hover:translate-x-2 shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </Link>

                <!-- Standard Articles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <Link v-for="news in articles" :key="news.id" :href="'/artikel/baca?img=' + encodeURIComponent(news.image) + '&title=' + encodeURIComponent(news.title) + '&category=' + encodeURIComponent(news.category) + '&summary=' + encodeURIComponent(news.summary)" class="flex flex-col bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 group">
                        <div class="relative h-72 overflow-hidden">
                            <img :src="news.image" :alt="news.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                            <div class="absolute bottom-6 left-6">
                                <span class="bg-blue-600 text-white px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">{{ news.category }}</span>
                            </div>
                        </div>
                        <div class="p-8 md:p-10 flex-1 flex flex-col">
                            <h4 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors leading-tight">
                                {{ news.title }}
                            </h4>
                            <p class="text-gray-500 text-lg flex-1 mb-8 leading-relaxed">
                                {{ news.summary }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ news.date }}</span>
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

                <div class="text-center mt-20">
                    <button class="px-12 py-5 border-2 border-gray-900 text-gray-900 rounded-full font-extrabold text-lg uppercase tracking-widest hover:bg-gray-900 hover:text-white transition-colors duration-500">
                        Muat Lebih Banyak
                    </button>
                </div>

            </div>
        </main>
        
        <Footer />
    </div>
</template>

<style scoped>
@keyframes slowZoom {
    0% { transform: scale(1); }
    100% { transform: scale(1.15); }
}
.animate-slow-zoom {
    animation: slowZoom 20s ease-in-out infinite alternate;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
    opacity: 0;
}
</style>
