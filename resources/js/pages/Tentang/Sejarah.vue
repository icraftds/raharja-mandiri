<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

const milestones = [
    {
        year: '2009',
        title: 'Awal Mula Pendirian',
        desc: 'Panti Sosial Raharja Mandiri bermula dari sebuah rumah kecil di Tanjungsari, Sumedang. Berawal dari kepedulian terhadap anak-anak yatim piatu di lingkungan sekitar, sekelompok relawan memutuskan untuk menyewa tempat sederhana guna memberikan mereka perlindungan, pendidikan, dan kasih sayang awal.',
        image: '/assets/images/tanam-2.jpg',
        textColor: 'text-blue-600',
        bgColor: 'bg-blue-600',
    },
    {
        year: '2015',
        title: 'Langkah Pertama Ekspansi',
        desc: 'Seiring berjalannya waktu dan meningkatnya kepercayaan donatur, yayasan berhasil membebaskan lahan sendiri. Pembangunan asrama permanen pertama dimulai, memungkinkan kami untuk menampung hingga 50 anak dan memberikan fasilitas hidup yang jauh lebih layak.',
        image: '/assets/images/bukber-2.jpg',
        textColor: 'text-teal-600',
        bgColor: 'bg-teal-600',
    },
    {
        year: '2020',
        title: 'Pengembangan Fasilitas Pendidikan',
        desc: 'Tahun bersejarah di mana kami meresmikan ruang belajar mandiri dan perpustakaan, serta mendapatkan legalitas penuh dari kementerian. Kurikulum pembinaan karakter mulai distandarisasi secara profesional untuk menjamin masa depan cerah anak-anak.',
        image: '/assets/images/relawan-3.jpg',
        textColor: 'text-pink-600',
        bgColor: 'bg-pink-600',
    },
    {
        year: 'Sekarang',
        title: 'Membangun Generasi Masa Depan',
        desc: 'Kini, dengan lebih dari ratusan anak asuh, Raharja Mandiri telah bertransformasi menjadi pusat pembinaan terpadu. Dukungan komunitas, relawan, dan mitra kerja terus mengalir tanpa henti, menjadikan yayasan ini sebuah rumah kedua yang kokoh bagi mereka.',
        image: '/assets/images/sepatu-2.jpg',
        textColor: 'text-amber-600',
        bgColor: 'bg-amber-600',
    }
];
</script>

<template>
    <Head title="Sejarah | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[75vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/bukber-1.jpg" alt="Sejarah Kami" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-blue-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Dokumenter Perjalanan</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Jejak Langkah <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-teal-300">Raharja Mandiri</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Menelusuri sejarah dedikasi, kasih sayang, dan perjuangan panjang sejak tahun 2009 untuk membangun generasi yang mandiri dan berakhlak mulia.
                </p>
                
                <!-- Scroll indicator -->
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-blue-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <!-- Alternating Timeline Sections -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <div v-for="(item, index) in milestones" :key="index" class="mb-32 last:mb-0">
                    <div :class="['flex flex-col gap-12 lg:gap-24 items-center', index % 2 === 0 ? 'lg:flex-row' : 'lg:flex-row-reverse']">
                        
                        <!-- Image Side -->
                        <div class="w-full lg:w-1/2 relative group">
                            <!-- Decorative background block -->
                            <div class="absolute inset-0 bg-gray-200 rounded-3xl transform translate-x-4 translate-y-4 transition-transform duration-500 group-hover:translate-x-6 group-hover:translate-y-6"></div>
                            
                            <div class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
                                <img :src="item.image" :alt="item.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" />
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500"></div>
                            </div>
                            
                            <!-- Large Year Badge Overlay -->
                            <div class="absolute -top-6 -left-6 bg-white py-4 px-8 rounded-2xl shadow-xl border border-gray-100 z-10 hidden md:block transform transition-transform group-hover:-translate-y-2 group-hover:-translate-x-2">
                                <span :class="['text-5xl font-extrabold tracking-tighter', item.textColor]">{{ item.year }}</span>
                            </div>
                        </div>
                        
                        <!-- Text Side -->
                        <div class="w-full lg:w-1/2 relative">
                            <!-- Mobile Year Badge -->
                            <div class="mb-6 md:hidden">
                                <span :class="['text-4xl font-extrabold', item.textColor]">{{ item.year }}</span>
                            </div>
                            
                            <h3 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                {{ item.title }}
                            </h3>
                            
                            <!-- Colored separator line -->
                            <div class="w-24 h-2 bg-gray-200 rounded-full mb-8 overflow-hidden">
                                <div :class="['h-full rounded-full w-1/2 transition-all duration-1000 transform -translate-x-full group-hover:translate-x-0', item.bgColor]"></div>
                                <div :class="['h-full rounded-full w-full opacity-30', item.bgColor]"></div>
                            </div>
                            
                            <p class="text-gray-600 text-lg md:text-xl leading-relaxed text-justify">
                                {{ item.desc }}
                            </p>
                        </div>
                        
                    </div>
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
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
    opacity: 0;
}
</style>
