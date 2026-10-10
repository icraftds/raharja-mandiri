<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

const items = [
    { 
        id: 1, 
        name: 'Sembako Utama', 
        desc: 'Beras, Minyak Goreng, Gula, dan Susu',
        qty: '50 Paket', 
        status: 'Mendesak', 
        color: 'text-pink-600',
        bgColor: 'bg-pink-600',
        lightBg: 'bg-pink-50' 
    },
    { 
        id: 2, 
        name: 'Pakaian Sekolah', 
        desc: 'Seragam lengkap untuk anak SD & SMP',
        qty: '30 Set', 
        status: 'Mendesak', 
        color: 'text-amber-600',
        bgColor: 'bg-amber-600',
        lightBg: 'bg-amber-50' 
    },
    { 
        id: 3, 
        name: 'Alat Tulis & Buku', 
        desc: 'Buku tulis, pensil, pulpen, dan alat peraga',
        qty: '100 Paket', 
        status: 'Rutin', 
        color: 'text-blue-600',
        bgColor: 'bg-blue-600',
        lightBg: 'bg-blue-50' 
    },
    { 
        id: 4, 
        name: 'Kebutuhan Harian', 
        desc: 'Perlengkapan mandi, sabun cuci, & kebersihan',
        qty: 'Bebas', 
        status: 'Rutin', 
        color: 'text-teal-600',
        bgColor: 'bg-teal-600',
        lightBg: 'bg-teal-50' 
    },
];
</script>

<template>
    <Head title="Daftar Kebutuhan | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[65vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/sepatu-3.jpg" alt="Daftar Kebutuhan" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-pink-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Bantuan Barang Fisik</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-300 to-pink-500">Kebutuhan</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Selain donasi tunai, kami juga sangat membutuhkan dan menerima bantuan berupa barang untuk mendukung operasional harian anak-anak panti.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-pink-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                    <div v-for="item in items" :key="item.id" class="group relative bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-8 md:p-12 transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl overflow-hidden">
                        
                        <!-- Accent Background Pattern -->
                        <div :class="['absolute top-0 right-0 w-32 h-32 rounded-bl-full -mr-8 -mt-8 transition-transform duration-700 group-hover:scale-[2.5]', item.lightBg]"></div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-8 gap-4">
                                <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900 w-3/4 leading-tight">{{ item.name }}</h3>
                                <span :class="['px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider whitespace-nowrap shadow-sm', item.color, item.lightBg]">
                                    {{ item.status }}
                                </span>
                            </div>
                            
                            <p class="text-gray-500 mb-10 text-lg leading-relaxed h-14">{{ item.desc }}</p>
                            
                            <div class="flex items-center gap-5 pt-6 border-t border-gray-100">
                                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-white transition-colors shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-gray-400 group-hover:text-gray-600 transition-colors">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-1">Dibutuhkan</p>
                                    <p class="text-2xl font-black text-gray-800">{{ item.qty }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to action -->
                <div class="text-center bg-white rounded-[3rem] p-12 md:p-20 shadow-2xl border border-gray-50 relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNFMkU4RjAiLz48L3N2Zz4=')] opacity-50"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h4 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6">Ingin Mengirimkan Barang?</h4>
                        <p class="text-gray-500 mb-10 text-xl max-w-2xl mx-auto">Silakan hubungi pengurus kami terlebih dahulu untuk memastikan ketersediaan dan kebutuhan barang saat ini.</p>
                        <Link href="/kontak" class="inline-flex items-center gap-4 px-12 py-6 bg-gray-900 text-white rounded-full font-bold text-xl hover:bg-blue-600 transition-all shadow-xl hover:-translate-y-2 group">
                            Hubungi Pengurus Panti
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 transform transition-transform group-hover:translate-x-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </Link>
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
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
    opacity: 0;
}
</style>
