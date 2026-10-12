<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import { onMounted, computed, watch } from 'vue';

const page = usePage();

const urlParams = computed(() => {
    const search = page.url.split('?')[1] || '';
    return new URLSearchParams(search);
});

const dynamicTitle = computed(() => urlParams.value.get('title') || 'Membangun Harapan Baru Melalui Pendidikan Inklusif di Pelosok Sumedang');
const dynamicImg = computed(() => urlParams.value.get('img') || '/assets/images/sepatu-3.jpg');
const dynamicCat = computed(() => urlParams.value.get('category') || 'Pendidikan');
const dynamicSummary = computed(() => urlParams.value.get('summary') || 'Pendidikan adalah jendela dunia, namun bagi sebagian anak-anak di Tanjungsari, jendela itu masih tertutup rapat. Kami hadir untuk membukanya lebar-lebar.');

const allJournals = [
    { 
        title: 'Bantuan Pendidikan Semester Ganjil 2026 Telah Berhasil Disalurkan', 
        image: '/assets/images/sepatu-2.jpg', 
        category: 'Pendidikan', 
        summary: 'Penyaluran dana bantuan pendidikan untuk 50 anak asuh di tingkat SD dan SMP...',
        content: {
            firstLetter: 'P',
            firstParagraphRemaining: 'erjalanan panjang Yayasan Raharja Mandiri dalam memberikan pendidikan yang layak tidaklah mudah. Banyak rintangan yang dihadapi, mulai dari keterbatasan fasilitas hingga akses lokasi yang menantang.',
            secondParagraph: 'Bulan ini, kami berhasil mendistribusikan ratusan paket pendidikan berupa seragam, buku tulis, dan perlengkapan sekolah kepada lebih dari 50 anak asuh. Bantuan ini merupakan hasil kolektif dari para donatur yang dermawan.',
            quote: 'Mereka tidak meminta untuk dilahirkan dalam keterbatasan, tapi kita bisa memilih untuk memberi mereka ketidakterbatasan.',
            quoteAuthor: 'H. Ahmad Sunaryo, Ketua Yayasan',
            subtitle: 'Langkah Nyata di Lapangan',
            thirdParagraph: 'Kami tidak hanya memberikan bantuan materi. Setiap akhir pekan, relawan kami terjun langsung memberikan bimbingan belajar ekstra.',
            images: ['/assets/images/sepatu-1.jpg', '/assets/images/sepatu-3.jpg'],
            finalParagraph: 'Dengan adanya program rutin ini, kami berharap tidak ada lagi anak yang putus sekolah hanya karena alasan biaya. Mari terus bergandengan tangan membangun masa depan mereka.'
        }
    },
    { 
        title: 'Kunjungan Komunitas Berbagi Kasih', 
        image: '/assets/images/relawan-3.jpg', 
        category: 'Kunjungan', 
        summary: 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas di hari Minggu...',
        content: {
            firstLetter: 'H',
            firstParagraphRemaining: 'ari Minggu kemarin menjadi momen yang sangat membahagiakan bagi anak-anak asuh kami. Kehadiran kakak-kakak relawan dari Komunitas Berbagi Kasih membawa keceriaan yang tak ternilai harganya.',
            secondParagraph: 'Acara dimulai dengan sesi permainan edukatif yang dirancang untuk melatih kerja sama tim dan kreativitas. Tawa canda memenuhi seluruh ruangan aula.',
            quote: 'Melihat senyum mereka adalah bayaran termahal yang pernah kami terima. Energi mereka sungguh luar biasa.',
            quoteAuthor: 'Sarah, Koordinator Komunitas',
            subtitle: 'Merajut Tali Kasih',
            thirdParagraph: 'Selain bermain, komunitas ini juga membagikan bingkisan berupa alat tulis dan makanan ringan bergizi. Kehadiran figur-figur inspiratif ini memberikan motivasi tersendiri.',
            images: ['/assets/images/relawan-1.jpg', '/assets/images/relawan-2.jpg'],
            finalParagraph: 'Kami sangat terbuka dengan kunjungan dari berbagai pihak yang ingin berbagi inspirasi dan kebahagiaan. Terima kasih Komunitas Berbagi Kasih!'
        }
    },
    { 
        title: 'Pembangunan Ruang Belajar Baru', 
        image: '/assets/images/tanam-2.jpg', 
        category: 'Infrastruktur', 
        summary: 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti...',
        content: {
            firstLetter: 'S',
            firstParagraphRemaining: 'ejalan dengan bertambahnya jumlah anak asuh, kebutuhan akan fasilitas ruang belajar yang memadai menjadi sebuah urgensi. Kami bersyukur, mimpi itu kini mulai terwujud.',
            secondParagraph: 'Pagi ini, telah dilaksanakan prosesi peletakan batu pertama untuk pembangunan dua kelas baru. Ruangan ini nantinya akan dilengkapi dengan perpustakaan mini dan fasilitas komputer dasar.',
            quote: 'Pendidikan yang baik membutuhkan lingkungan yang mendukung. Ruang baru ini adalah fondasi masa depan mereka.',
            quoteAuthor: 'Ir. Budi Santoso, Donatur Utama',
            subtitle: 'Target Penyelesaian',
            thirdParagraph: 'Proses pembangunan diperkirakan akan memakan waktu sekitar tiga bulan. Kami bekerja sama dengan kontraktor lokal yang juga memberdayakan warga sekitar panti.',
            images: ['/assets/images/tanam-1.jpg', '/assets/images/tanam-3.jpg'],
            finalParagraph: 'Dukungan doa dan materi dari para dermawan masih sangat kami harapkan agar proyek ini dapat selesai tepat waktu. Mari wujudkan ruang belajar impian mereka.'
        }
    },
    { 
        title: 'Cek Kesehatan Gratis Bersama RSUD', 
        image: '/assets/images/bukber-2.jpg', 
        category: 'Kesehatan', 
        summary: 'Seluruh anak asuh mendapatkan pemeriksaan kesehatan komprehensif secara gratis...',
        content: {
            firstLetter: 'K',
            firstParagraphRemaining: 'esehatan adalah aspek fundamental yang seringkali terabaikan di lingkungan panti. Menyadari hal ini, kami berkolaborasi dengan RSUD setempat mengadakan cek kesehatan rutin.',
            secondParagraph: 'Sebanyak 70 anak asuh mengikuti serangkaian pemeriksaan yang meliputi cek gigi, mata, THT, hingga status gizi. Beberapa anak yang membutuhkan penanganan lebih lanjut telah dirujuk.',
            quote: 'Tindakan preventif jauh lebih baik. Kami senang bisa memastikan anak-anak ini tumbuh dalam kondisi fisik yang prima.',
            quoteAuthor: 'Dr. Andi Pratama, Ketua Tim Medis',
            subtitle: 'Pentingnya Gizi Seimbang',
            thirdParagraph: 'Selain pemeriksaan medis, tim dokter juga memberikan edukasi mengenai pentingnya cuci tangan dan menjaga kebersihan diri kepada anak-anak.',
            images: ['/assets/images/bukber-1.jpg', '/assets/images/relawan-4.jpg'],
            finalParagraph: 'Program ini direncanakan akan menjadi agenda rutin setiap enam bulan sekali. Terima kasih kepada seluruh tim medis RSUD yang telah meluangkan waktunya.'
        }
    }
];

const currentArticle = computed(() => {
    return allJournals.find(j => j.title === dynamicTitle.value) || allJournals[0];
});

const recommendedJournals = computed(() => {
    // Filter out the currently viewed journal and take the first 2
    return allJournals.filter(j => j.title !== dynamicTitle.value).slice(0, 2);
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
                    <span class="text-gray-300 text-sm font-medium tracking-wide">10 Oktober 2026</span>
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

                    <p>
                        <span class="float-left text-7xl font-black text-gray-900 leading-none pr-3 pt-2">{{ currentArticle.content.firstLetter }}</span>
                        {{ currentArticle.content.firstParagraphRemaining }}
                    </p>

                    <p>
                        {{ currentArticle.content.secondParagraph }}
                    </p>

                    <!-- Cinematic Pull Quote -->
                    <figure class="my-14 border-y border-gray-200 py-10 text-center relative">
                        <div class="absolute inset-0 flex items-center justify-center opacity-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-48 h-48"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                        </div>
                        <blockquote class="relative z-10">
                            <p class="text-3xl md:text-4xl font-black text-gray-900 leading-tight mb-4 tracking-tight">"{{ currentArticle.content.quote }}"</p>
                        </blockquote>
                        <figcaption class="relative z-10 text-sm font-bold text-gray-500 tracking-widest uppercase mt-6">
                            — {{ currentArticle.content.quoteAuthor }}
                        </figcaption>
                    </figure>

                    <h3 class="text-3xl font-black text-gray-900 mb-6 mt-12">{{ currentArticle.content.subtitle }}</h3>
                    <p>
                        {{ currentArticle.content.thirdParagraph }}
                    </p>

                    <!-- In-article Image Grid -->
                    <div class="grid grid-cols-2 gap-4 my-12">
                        <div class="overflow-hidden rounded-2xl">
                            <img :src="currentArticle.content.images[0]" alt="Dokumentasi 1" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" />
                        </div>
                        <div class="overflow-hidden rounded-2xl">
                            <img :src="currentArticle.content.images[1]" alt="Dokumentasi 2" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" />
                        </div>
                    </div>

                    <p>
                        {{ currentArticle.content.finalParagraph }}
                    </p>
                </article>

                <!-- Share & Tags -->
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold uppercase tracking-wider">Pendidikan</span>
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
                    <Link v-for="(journal, index) in recommendedJournals" :key="index" :href="'/artikel/baca?img=' + encodeURIComponent(journal.image) + '&title=' + encodeURIComponent(journal.title) + '&category=' + encodeURIComponent(journal.category) + '&summary=' + encodeURIComponent(journal.summary)" class="flex flex-col bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 group">
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
