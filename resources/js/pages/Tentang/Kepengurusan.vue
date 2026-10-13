<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

import { computed } from 'vue';

const props = defineProps<{
    team?: Array<{
        id: number;
        nama: string;
        jabatan: string;
        foto?: string;
        urutan?: number;
        aktif?: boolean;
    }>;
}>();

const defaultTeam = [
    {
        id: 1,
        name: 'H. Ahmad Sudirman, M.Ag',
        role: 'Ketua Yayasan',
        image: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 2,
        name: 'Hj. Siti Aminah, S.Pd',
        role: 'Sekretaris',
        image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 3,
        name: 'Budi Santoso, S.E',
        role: 'Bendahara',
        image: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 4,
        name: 'Ust. Rahman Hakim',
        role: 'Kepala Pengasuh',
        image: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 5,
        name: 'Rina Marlina, Amd.Kep',
        role: 'Divisi Kesehatan',
        image: 'https://images.unsplash.com/photo-1594824432258-293674682054?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    },
    {
        id: 6,
        name: 'Arief Hidayat, S.Kom',
        role: 'Humas & Kemitraan',
        image: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    }
];

const teamItems = computed(() => {
    if (!props.team || props.team.length === 0) return defaultTeam;
    return props.team.map((person: any) => ({
        id: person.id,
        name: person.nama || person.name,
        role: person.jabatan || person.role,
        image: person.foto || person.image || '/assets/images/relawan-1.jpg',
    }));
});
</script>

<template>
    <Head title="Susunan Kepengurusan | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[65vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/relawan-2.jpg" alt="Kepengurusan" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-teal-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Di Balik Layar</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Susunan <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-teal-500">Pengurus</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Sosok-sosok luar biasa yang dengan ikhlas mendedikasikan waktu dan tenaga demi kelancaran operasional panti asuhan.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-teal-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <!-- Grid Kepengurusan Cinematic -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="person in teamItems" :key="person.id" class="group relative rounded-[2.5rem] overflow-hidden shadow-2xl h-[450px] lg:h-[500px]">
                        <!-- Image with grayscale effect by default, color on hover -->
                        <img :src="person.image" :alt="person.name" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000 grayscale group-hover:grayscale-0" />
                        
                        <!-- Dark overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Content -->
                        <div class="absolute inset-0 flex flex-col justify-end p-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <span class="text-teal-400 font-bold uppercase tracking-widest text-sm mb-3 drop-shadow-md">{{ person.role }}</span>
                            <h3 class="text-3xl font-extrabold text-white leading-tight drop-shadow-lg">{{ person.name }}</h3>
                            
                            <!-- A decorative line that expands on hover -->
                            <div class="w-0 h-1 bg-teal-500 mt-6 transition-all duration-700 group-hover:w-20 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action Internal -->
                <div class="max-w-5xl mx-auto mt-24">
                    <div class="bg-gray-900 rounded-[3rem] p-12 md:p-20 text-center text-white shadow-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiMzMzMiLz48L3N2Zz4=')] opacity-30"></div>
                        <div class="relative z-10 flex flex-col items-center">
                            <h3 class="text-4xl md:text-5xl font-extrabold mb-6">Ingin Menjadi Relawan?</h3>
                            <p class="text-gray-400 text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                                Mari berkolaborasi bersama tim kami. Kami selalu terbuka untuk Anda yang ingin membagikan keahlian dan waktu berharga bagi kemajuan anak-anak.
                            </p>
                            <Link href="/kontak" class="px-12 py-6 bg-teal-600 text-white rounded-full font-bold text-xl hover:bg-teal-500 transition-all shadow-xl hover:-translate-y-2 inline-flex items-center gap-3">
                                Bergabung Sekarang
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </Link>
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
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
    opacity: 0;
}
</style>
