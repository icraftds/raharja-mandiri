<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import { ref } from 'vue';

const categories = ['Semua Momen', 'Pendidikan', 'Kesehatan', 'Keagamaan', 'Kunjungan'];
const activeCategory = ref('Semua Momen');

const photos = [
    { id: 1, url: '/assets/images/bukber-1.jpg', title: 'Kegiatan Belajar Mengajar', category: 'Pendidikan', height: 'h-96' },
    { id: 2, url: '/assets/images/relawan-1.jpg', title: 'Kunjungan Donatur', category: 'Kunjungan', height: 'h-72' },
    { id: 3, url: '/assets/images/sepatu-1.jpg', title: 'Pemeriksaan Kesehatan', category: 'Kesehatan', height: 'h-80' },
    { id: 4, url: '/assets/images/tanam-1.jpg', title: 'Pengajian Rutin', category: 'Keagamaan', height: 'h-96' },
    { id: 5, url: '/assets/images/bukber-2.jpg', title: 'Pembagian Sembako', category: 'Kunjungan', height: 'h-72' },
    { id: 6, url: '/assets/images/relawan-2.jpg', title: 'Belajar Komputer', category: 'Pendidikan', height: 'h-80' },
];
</script>

<template>
    <Head title="Galeri | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/relawan-1.jpg" alt="Galeri" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-teal-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Rekam Jejak</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-teal-500">Momen</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Mengabadikan senyuman, semangat, dan kehangatan kebersamaan anak-anak dalam setiap langkah perjuangan mereka.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-teal-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <!-- Filters -->
                <div class="flex flex-wrap justify-center gap-3 mb-16 relative z-30">
                    <button 
                        v-for="cat in categories" 
                        :key="cat"
                        @click="activeCategory = cat"
                        :class="[
                            'px-8 py-4 rounded-full text-sm uppercase tracking-widest font-bold transition-all duration-300 shadow-xl border border-white/50 backdrop-blur-md',
                            activeCategory === cat ? 'bg-teal-600 text-white scale-105 shadow-teal-500/30' : 'bg-white/80 text-gray-600 hover:bg-white hover:scale-105'
                        ]"
                    >
                        {{ cat }}
                    </button>
                </div>

                <!-- Cinematic Masonry Grid -->
                <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8">
                    <div v-for="photo in photos" :key="photo.id" class="group relative rounded-[2rem] overflow-hidden shadow-2xl hover:shadow-[0_20px_50px_rgba(0,0,0,0.2)] transition-all duration-700 break-inside-avoid cursor-pointer">
                        <img :src="photo.url" :alt="photo.title" :class="['w-full object-cover transform group-hover:scale-110 transition-transform duration-1000', photo.height]" />
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8 md:p-10">
                            <span class="text-teal-400 text-sm font-bold uppercase tracking-widest mb-3 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ photo.category }}</span>
                            <h3 class="text-white font-extrabold text-2xl md:text-3xl leading-tight transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">{{ photo.title }}</h3>
                        </div>
                    </div>
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
