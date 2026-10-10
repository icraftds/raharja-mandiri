<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';

// Dummy data for news
const latestNews = [
    {
        id: 1,
        title: 'Bantuan Pendidikan Semester Ganjil',
        date: '10 Okt 2026',
        summary: 'Penyaluran dana bantuan pendidikan untuk 50 anak asuh di tingkat SD dan SMP.',
        image: '/assets/images/relawan-1.jpg',
    },
    {
        id: 2,
        title: 'Kunjungan Komunitas Berbagi Kasih',
        date: '05 Okt 2026',
        summary: 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas Berbagi Kasih.',
        image: '/assets/images/relawan-2.jpg',
    },
    {
        id: 3,
        title: 'Pembangunan Ruang Belajar Baru',
        date: '28 Sep 2026',
        summary: 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti.',
        image: '/assets/images/tanam-1.jpg',
    }
];
</script>

<template>
    <Head title="Beranda | PSRM Raharja Mandiri" />

    <div class="min-h-screen bg-gray-50 font-sans text-gray-800">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/assets/images/sepatu-1.jpg" alt="Anak-anak Panti Sosial" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-b from-blue-900/80 via-black/50 to-black/80"></div>
            </div>
            
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-20">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-500/30 text-blue-200 backdrop-blur-sm border border-blue-500/40 text-sm font-semibold tracking-wider mb-6 animate-fade-in-up">
                    Wujudkan Harapan Mereka
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-lg">
                    Bersama Berbagi Kasih,<br/> Membangun Masa Depan
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto drop-shadow-md leading-relaxed">
                    Panti Sosial Raharja Mandiri (PSRM) berdedikasi untuk memberikan kehidupan yang lebih baik, pendidikan yang layak, dan lingkungan penuh kasih bagi anak-anak di Tanjungsari, Sumedang.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Link href="/donasi/rekening" class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-full font-bold text-lg transition-all shadow-[0_0_20px_rgba(37,99,235,0.4)] hover:scale-105">
                        Donasi Sekarang
                    </Link>
                    <Link href="/tentang/visi-misi" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 rounded-full font-bold text-lg transition-all hover:scale-105">
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
                            <img src="/assets/images/tanam-3.jpg" alt="Tentang Kami" class="w-full h-full object-cover" />
                        </div>
                        <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-blue-100 rounded-full -z-0"></div>
                        <div class="absolute -top-8 -left-8 w-32 h-32 bg-pink-100 rounded-full -z-0"></div>
                    </div>
                    
                    <div>
                        <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-2">Tentang Kami</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            Rumah Kedua yang Penuh dengan Kehangatan
                        </h3>
                        <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                            Panti Sosial Raharja Mandiri hadir di Tanjungsari, Sumedang sebagai wadah untuk merangkul anak-anak yatim piatu dan dhuafa. Kami berkomitmen memberikan lingkungan yang aman, mendidik, dan penuh kasih sayang.
                        </p>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            Visi kami adalah membentuk generasi yang mandiri, cerdas, dan berakhlak mulia. Bersama kita bisa memberikan mereka kesempatan yang setara untuk meraih cita-cita.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="text-4xl font-black text-gray-900">120+</p>
                                <p class="text-sm text-gray-500 font-medium mt-1">Anak Asuh</p>
                            </div>
                            <div class="border-l-4 border-pink-500 pl-4">
                                <p class="text-4xl font-black text-gray-900">15</p>
                                <p class="text-sm text-gray-500 font-medium mt-1">Tahun Berdiri</p>
                            </div>
                        </div>
                        
                        <Link href="/tentang/sejarah" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 transition-colors">
                            Baca Sejarah Lengkap
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Galeri Sekilas -->
        <section class="py-24 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                    <div>
                        <h2 class="text-pink-600 font-bold tracking-wide uppercase text-sm mb-2">Galeri Kegiatan</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Momen Bahagia Bersama</h3>
                    </div>
                    <Link href="/galeri" class="hidden md:inline-flex items-center gap-2 text-pink-600 font-bold hover:text-pink-700 transition-colors mt-4 md:mt-0">
                        Lihat Semua Foto
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </Link>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="aspect-square rounded-2xl overflow-hidden group shadow-sm">
                        <img src="/assets/images/sepatu-3.jpg" alt="Kegiatan Belajar" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
                    </div>
                    <div class="aspect-square rounded-2xl overflow-hidden group shadow-sm">
                        <img src="/assets/images/bukber-1.jpg" alt="Bantuan Sosial" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
                    </div>
                    <div class="aspect-square rounded-2xl overflow-hidden group shadow-sm">
                        <img src="/assets/images/tanam-4.jpg" alt="Bermain Bersama" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
                    </div>
                    <div class="aspect-square rounded-2xl overflow-hidden group shadow-sm">
                        <img src="/assets/images/relawan-4.jpg" alt="Makan Bersama" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
                    </div>
                </div>
                
                <div class="mt-8 text-center md:hidden">
                    <Link href="/galeri" class="inline-flex items-center gap-2 text-pink-600 font-bold hover:text-pink-700 transition-colors">
                        Lihat Semua Foto
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Program Unggulan (Colorful cards to match logo) -->
        <section class="py-24 bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-2">Program Kami</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-16">Fokus Utama Pembinaan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1 (Blue) -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Pendidikan</h4>
                        <p class="text-gray-600">Pembiayaan sekolah formal dan bimbingan belajar tambahan untuk memastikan masa depan cerah.</p>
                    </div>
                    
                    <!-- Card 2 (Teal) -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Kesehatan & Gizi</h4>
                        <p class="text-gray-600">Pemenuhan kebutuhan makanan bergizi, vitamin, dan pemeriksaan kesehatan secara berkala.</p>
                    </div>

                    <!-- Card 3 (Pink) -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-pink-100 text-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-pink-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.492-3.053c.24-.294.59-.47.962-.47h3.428m-6.882 4.045l-3.053 2.492c-.294.24-.47.59-.47.962v3.428m-4.045-6.882l5.877 5.877A2.652 2.652 0 0011.42 21m-5.877-5.877L2.492 11.42c-.24-.294-.47-.59-.47-.962V7.03m6.882 4.045l3.053-2.492c.294-.24.47-.59.47-.962V4.14m4.045 6.882l-5.877-5.877A2.652 2.652 0 0111.42 3h3.428m0 0l5.877 5.877" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Pembinaan Karakter</h4>
                        <p class="text-gray-600">Kegiatan keagamaan, pelatihan soft skill, dan pengembangan bakat untuk kemandirian.</p>
                    </div>
                    <!-- Card 4 (Amber) -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Anak Asuh & Relawan</h4>
                        <p class="text-gray-600">Memberi ruang bagi masyarakat menjadi orang tua asuh atau relawan pendidik.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mitra & Kolaborasi -->
        <section class="py-20 bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-gray-500 font-medium tracking-wide uppercase text-sm mb-8">Mitra Kerja & Kolaborasi Kami</h2>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                    <div class="text-xl font-black text-gray-400">Pemerintah Daerah</div>
                    <div class="text-xl font-black text-gray-400">Dinas Sosial</div>
                    <div class="text-xl font-black text-gray-400">RS Mitra Keluarga</div>
                    <div class="text-xl font-black text-gray-400">Komunitas Peduli</div>
                    <div class="text-xl font-black text-gray-400">Donatur Perusahaan</div>
                </div>
                <p class="mt-8 text-sm text-gray-400 max-w-2xl mx-auto">Banyak pihak yang telah membantu kami dalam upaya mewujudkan kesejahteraan anak-anak Panti Sosial Raharja Mandiri.</p>
            </div>
        </section>

        <!-- Instagram Feed Vibe / Berita -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-2">@psrm_raharja_mandiri</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Kegiatan Terbaru</h3>
                    </div>
                    <a href="https://www.instagram.com/psrm_raharja_mandiri/" target="_blank" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                        Kunjungi Instagram
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article v-for="news in latestNews" :key="news.id" class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="relative h-64 overflow-hidden">
                            <img :src="news.image" :alt="news.title" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                            <!-- Instagram Icon overlay -->
                            <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm p-2 rounded-full text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <span class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider">{{ news.date }}</span>
                            <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                <Link href="/artikel">{{ news.title }}</Link>
                            </h4>
                            <p class="text-gray-600 text-sm flex-1 line-clamp-3 mb-4">
                                {{ news.summary }}
                            </p>
                            <Link href="/artikel" class="inline-flex items-center gap-1 text-blue-600 text-sm font-bold mt-auto">
                                Baca selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </div>
                
                <div class="mt-8 text-center md:hidden">
                    <a href="https://www.instagram.com/psrm_raharja_mandiri/" target="_blank" class="inline-flex items-center gap-2 text-blue-600 font-semibold">
                        Lihat di Instagram &rarr;
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 relative overflow-hidden bg-blue-900">
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
                <p class="text-blue-100 text-lg mb-10">
                    Bantuan sekecil apapun akan sangat berarti bagi kelangsungan pendidikan dan kehidupan anak-anak Panti Sosial Raharja Mandiri. Mari berbagi kebaikan bersama kami.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Link href="/donasi/rekening" class="px-8 py-4 bg-white text-blue-900 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors shadow-xl">
                        Mulai Berdonasi
                    </Link>
                    <Link href="/donasi/kebutuhan" class="px-8 py-4 bg-transparent border-2 border-blue-400 text-white rounded-full font-bold text-lg hover:bg-blue-800 transition-colors">
                        Lihat Kebutuhan Mendesak
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />

        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/6281322101618?text=Halo%20Pengurus%20Panti%20Sosial%20Raharja%20Mandiri,%20saya%20ingin%20bertanya%20seputar%20donasi." 
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
