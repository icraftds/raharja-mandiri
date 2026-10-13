<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

import { ref, computed } from 'vue';

const props = defineProps<{
    banks?: Array<{
        id: number;
        name: string;
        account: string;
        holder: string;
        textColor?: string;
        bgColor?: string;
        lightBg?: string;
    }>;
}>();

const defaultBanks = [
    { 
        id: 1, 
        name: 'Bank Syariah Indonesia (BSI)', 
        account: '712 345 6789', 
        holder: 'Yayasan Raharja Mandiri', 
        textColor: 'text-teal-600',
        bgColor: 'bg-teal-600',
        lightBg: 'bg-teal-50',
    },
    { 
        id: 2, 
        name: 'Bank Mandiri', 
        account: '130 00 1234567 8', 
        holder: 'Yayasan Raharja Mandiri', 
        textColor: 'text-blue-600',
        bgColor: 'bg-blue-600',
        lightBg: 'bg-blue-50',
    },
    { 
        id: 3, 
        name: 'Bank Central Asia (BCA)', 
        account: '081 234 5678', 
        holder: 'Yayasan Raharja Mandiri', 
        textColor: 'text-blue-800',
        bgColor: 'bg-blue-800',
        lightBg: 'bg-blue-100',
    }
];

const bankList = computed(() => {
    return props.banks && props.banks.length > 0 ? props.banks : defaultBanks;
});

const copiedId = ref<number | null>(null);

const copyToClipboard = (account: string, id: number) => {
    navigator.clipboard.writeText(account);
    copiedId.value = id;
    setTimeout(() => {
        copiedId.value = null;
    }, 2500);
};
</script>

<template>
    <Head title="Rekening Donasi | Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <!-- Hero Documentary Style -->
        <div class="relative min-h-[65vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/tanam-4.jpg" alt="Donasi" class="w-full h-full object-cover transform scale-105 animate-slow-zoom" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-gray-50"></div>
            </div>
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <span class="text-amber-400 font-bold tracking-widest uppercase text-sm md:text-base mb-6 block animate-fade-in-up">Salurkan Kepedulian</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 tracking-tight leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Rekening <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500">Kebaikan</span>
                </h1>
                <p class="text-lg md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                    Bantu kami merajut asa dan menciptakan masa depan yang lebih baik. Setiap kebaikan yang Anda salurkan menjadi secercah harapan bagi mereka.
                </p>
                <div class="mt-16 flex justify-center animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-1 h-24 bg-gradient-to-b from-amber-500 to-transparent rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <main class="flex-grow relative z-20 pb-32">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
                
                <!-- Bank List (Premium Style) -->
                <div class="space-y-8 mb-24">
                    <div v-for="bank in bankList" :key="bank.id" class="group relative bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden transform transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)]">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-50 to-white z-0"></div>
                        
                        <!-- Left color strip -->
                        <div :class="['absolute left-0 top-0 bottom-0 w-3 md:w-4 z-10 transition-all duration-500 group-hover:w-8', bank.bgColor]"></div>
                        
                        <div class="relative z-20 flex flex-col md:flex-row items-center justify-between p-8 md:p-12 gap-8 md:gap-12 pl-12 md:pl-20">
                            
                            <!-- Info -->
                            <div class="w-full md:w-3/4 text-center md:text-left">
                                <div class="inline-flex items-center gap-4 mb-6">
                                    <div :class="['w-16 h-16 rounded-2xl flex items-center justify-center shadow-sm', bank.lightBg, bank.textColor]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ bank.name }}</h3>
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-4 items-center md:items-stretch">
                                    <div class="bg-gray-100/50 rounded-2xl p-5 inline-flex flex-col justify-center w-full md:w-auto">
                                        <p class="text-gray-400 uppercase tracking-widest text-xs font-bold mb-1">Nomor Rekening</p>
                                        <p :class="['text-2xl md:text-3xl font-black tracking-widest', bank.textColor]">{{ bank.account }}</p>
                                    </div>
                                    
                                    <div class="bg-gray-100/50 rounded-2xl p-5 inline-flex flex-col justify-center w-full md:w-auto">
                                        <p class="text-gray-400 uppercase tracking-widest text-xs font-bold mb-1">Atas Nama</p>
                                        <p class="text-lg md:text-xl text-gray-800 font-bold">{{ bank.holder }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action -->
                            <div class="w-full md:w-1/4 flex flex-col items-center md:items-end justify-center mt-4 md:mt-0">
                                <button @click="copyToClipboard(bank.account, bank.id)" :class="['px-8 py-5 w-full md:w-auto rounded-full font-bold text-lg transition-all flex items-center justify-center gap-3', bank.bgColor, 'text-white hover:opacity-90 shadow-xl group-hover:shadow-2xl hover:-translate-y-1']">
                                    <svg v-if="copiedId !== bank.id" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    {{ copiedId === bank.id ? 'Tersalin!' : 'Salin' }}
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi -->
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl group">
                    <div class="absolute inset-0 z-0">
                        <!-- Menggunakan foto kegiatan lain untuk background -->
                        <img src="/assets/images/bukber-2.jpg" alt="Konfirmasi" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000" />
                        <div class="absolute inset-0 bg-gray-900/80"></div>
                    </div>
                    <div class="relative z-10 p-12 md:p-24 text-center flex flex-col items-center">
                        <div class="w-24 h-24 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mb-8 border border-green-500/30 backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h4 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Konfirmasi Donasi Anda</h4>
                        <p class="text-gray-300 mb-12 max-w-2xl text-xl md:text-2xl leading-relaxed">
                            Mohon kesediaannya untuk melakukan konfirmasi agar donasi Anda dapat segera kami alokasikan secara transparan.
                        </p>
                        <a :href="'https://wa.me/' + ($page.props.pengaturanGlobal?.kontak_whatsapp || '6281322101618') + '?text=Halo%20Admin,%20saya%20sudah%20melakukan%20donasi.'" target="_blank" class="px-12 py-6 bg-[#25D366] text-white rounded-full font-extrabold text-xl hover:bg-[#20bd5a] transition-all shadow-xl hover:shadow-2xl hover:-translate-y-2 flex items-center gap-4 group/wa">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transform group-hover/wa:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.898-4.45 9.898-9.892 0-5.442-4.45-9.892-9.896-9.892-5.45 0-9.898 4.45-9.898 9.892 0 1.91.525 3.792 1.516 5.462l-1.01 3.687 3.798-1.009zm8.175-7.79c-.197-.1-1.168-.578-1.348-.644-.181-.067-.312-.1-.444.1-.132.199-.512.645-.628.777-.116.133-.232.149-.429.05-.198-.1-.835-.308-1.591-.984-.585-.526-.979-1.176-1.096-1.374-.116-.199-.012-.306.086-.405.089-.089.197-.229.296-.345.099-.115.132-.198.198-.33.065-.133.033-.248-.016-.347-.05-.1-.444-1.072-.608-1.468-.16-.389-.322-.336-.444-.343-.115-.006-.248-.007-.379-.007-.132 0-.348.05-.53.248-.181.198-.694.678-.694 1.653 0 .975.711 1.918.81 2.051.099.132 1.398 2.132 3.385 2.991.472.204.84.326 1.127.418.475.152.908.13 1.25.078.384-.059 1.168-.477 1.332-.938.165-.461.165-.856.116-.938-.05-.082-.181-.132-.379-.23z" /></svg>
                            Konfirmasi Sekarang
                        </a>
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
