<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

import { computed } from 'vue';

const props = defineProps<{
    visi?: string;
    missions?: Array<{
        id: number;
        judul: string;
        deskripsi: string;
        warna_teks?: string;
        warna_latar?: string;
        urutan?: number;
    }>;
}>();

const displayVisi = computed(() => {
    return props.visi || 'Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia serta memberikan dampak nyata bagi masyarakat luas.';
});

const defaultMissions = [
    {
        id: 1,
        title: 'Pendidikan Berkualitas',
        desc: 'Memberikan akses pendidikan formal dan non-formal yang komprehensif untuk membekali masa depan.',
        color: 'text-blue-600',
        bgColor: 'bg-blue-600',
    },
    {
        id: 2,
        title: 'Pembinaan Karakter & Akhlak',
        desc: 'Membentuk kepribadian yang beriman, bertakwa, dan berlandaskan nilai moral yang kuat.',
        color: 'text-teal-600',
        bgColor: 'bg-teal-600',
    },
    {
        id: 3,
        title: 'Kemandirian Berkelanjutan',
        desc: 'Mengembangkan life-skill agar anak asuh tangguh dan mandiri saat terjun ke masyarakat.',
        color: 'text-pink-600',
        bgColor: 'bg-pink-600',
    },
    {
        id: 4,
        title: 'Kesejahteraan Holistik',
        desc: 'Menjamin kebutuhan gizi, fisik, dan kesehatan mental dalam lingkungan yang suportif.',
        color: 'text-amber-600',
        bgColor: 'bg-amber-600',
    }
];

const missionItems = computed(() => {
    if (!props.missions || props.missions.length === 0) return defaultMissions;
    return props.missions.map((m: any) => ({
        id: m.id,
        title: m.judul || m.title,
        desc: m.deskripsi || m.desc,
        color: m.warna_teks || m.color || 'text-blue-600',
        bgColor: m.warna_latar || m.bgColor || 'bg-blue-600',
    }));
});
</script>

<template>
    <Head title="Visi & Misi | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[70vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/tanam-3.jpg" alt="Visi Misi" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-gray-900"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-blue-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Kompas Perjalanan</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Visi & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-blue-500">Misi</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Arah dan pijakan kami dalam mencetak generasi penerus yang tangguh, berdaya saing, dan berakhlak mulia.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-blue-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            
            <!-- Visi Section (Dark & Immersive) -->
            <div class="bg-gray-900 py-24 md:py-32 -mt-2 rounded-b-[3rem] md:rounded-b-[6rem] shadow-2xl relative z-30">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <span class="inline-block px-6 py-2 border border-blue-500/30 text-blue-400 rounded-full text-sm font-bold uppercase tracking-widest mb-10">
                        Visi Besar Kami
                    </span>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight md:leading-tight">
                        "{{ displayVisi }}"
                    </h2>
                </div>
            </div>

            <!-- Misi Section (Documentary Layout) -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 md:pt-32">
                <div class="flex flex-col md:flex-row gap-12 lg:gap-24">
                    
                    <div class="w-full md:w-1/3">
                        <div class="sticky top-32">
                            <h3 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">Langkah <br/> Nyata</h3>
                            <div class="w-20 h-2 bg-blue-600 rounded-full mb-8"></div>
                            <p class="text-xl text-gray-500 leading-relaxed">
                                Pilar utama yang menjadi pondasi setiap program edukasi dan kegiatan sosial di Raharja Mandiri.
                            </p>
                        </div>
                    </div>
                    
                    <div class="w-full md:w-2/3 space-y-10">
                        <div v-for="(misi, index) in missionItems" :key="misi.id" class="group bg-white p-10 md:p-12 rounded-[2.5rem] shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 flex flex-col sm:flex-row gap-8 relative overflow-hidden">
                            <div :class="['absolute left-0 top-0 bottom-0 w-3 transition-all duration-500 group-hover:w-6', misi.bgColor]"></div>
                            <div class="w-16 h-16 shrink-0">
                                <span :class="['text-6xl font-black opacity-20 group-hover:opacity-100 transition-opacity duration-500', misi.color]">0{{ index + 1 }}</span>
                            </div>
                            <div>
                                <h4 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ misi.title }}</h4>
                                <p class="text-xl text-gray-600 leading-relaxed">{{ misi.desc }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Call to Action Internal -->
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
                <div class="bg-blue-600 rounded-[3rem] p-12 md:p-20 text-center text-white shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-blue-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <h3 class="text-4xl md:text-5xl font-extrabold mb-6">Dukung Perjalanan Kami</h3>
                        <p class="text-blue-100 text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                            Setiap donasi Anda adalah bahan bakar bagi kami untuk terus merealisasikan visi mulia ini setiap harinya.
                        </p>
                        <Link href="/donasi/rekening" class="px-12 py-6 bg-white text-blue-600 rounded-full font-bold text-xl hover:bg-gray-50 transition-all shadow-xl hover:-translate-y-2 flex items-center gap-3">
                            Mulai Berdonasi
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
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
