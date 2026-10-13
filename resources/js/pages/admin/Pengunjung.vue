<script setup lang="ts">
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';

interface Statistik {
    total: number;
    hari_ini: number;
    minggu_ini: number;
    bulan_ini: number;
    unik: number;
}

interface GrafikItem {
    tanggal: string;
    tanggal_lengkap: string;
    jumlah: number;
}

interface DistribusiItem {
    nama: string;
    total: number;
    persen: number;
}

interface HalamanItem {
    halaman: string;
    judul_halaman: string | null;
    total: number;
}

interface LogItem {
    id: number;
    alamat_ip: string;
    halaman: string;
    judul_halaman: string;
    perangkat: string;
    browser: string;
    sistem_operasi: string;
    waktu: string;
    waktu_relatif: string;
}

const props = defineProps<{
    statistik: Statistik;
    grafik_harian: GrafikItem[];
    distribusi_perangkat: DistribusiItem[];
    distribusi_browser: DistribusiItem[];
    halaman_populer: HalamanItem[];
    log_kunjungan: LogItem[];
    filter_rentang: number;
}>();

const pencarianLog = ref('');
const filterRentangAktif = ref(props.filter_rentang || 7);
const hoveredIndex = ref<number | null>(null);

const ubahRentang = (hari: number) => {
    filterRentangAktif.value = hari;
    hoveredIndex.value = null;
    router.get('/admin/pengunjung', { rentang: hari }, {
        preserveState: true,
        preserveScroll: true,
    });
};

// Hitung nilai maksimum grafik untuk skala SVG
const maxKunjungan = computed(() => {
    const max = Math.max(...props.grafik_harian.map(item => item.jumlah), 1);
    return Math.ceil(max * 1.15); // Beri ruang di atas bar
});

// Perhitungan koordinat SVG Chart (Canvas 1000 x 260)
const svgChartData = computed(() => {
    const list = props.grafik_harian;
    const n = list.length;
    if (n === 0) return [];

    const paddingKiri = 55;
    const paddingKanan = 25;
    const lebarBersih = 1000 - paddingKiri - paddingKanan;
    const slotWidth = lebarBersih / n;
    const maxVal = maxKunjungan.value;

    const baseHeight = 175;
    const baseY = 215;

    // Batasi lebar bar agar proporsional di 7, 14, maupun 30 hari
    const barWidth = Math.max(Math.min(slotWidth * 0.65, 46), 10);

    return list.map((item, idx) => {
        const slotCenterX = paddingKiri + (idx * slotWidth) + (slotWidth / 2);
        const x = slotCenterX - (barWidth / 2);
        const barHeight = maxVal > 0 ? Math.max((item.jumlah / maxVal) * baseHeight, 6) : 6;
        const y = baseY - barHeight;

        // Tampilkan label tanggal cerdas agar tidak bertumpuk
        let showDateLabel = true;
        if (n > 20) {
            showDateLabel = idx === 0 || idx === n - 1 || idx % 5 === 0;
        } else if (n > 10) {
            showDateLabel = idx === 0 || idx === n - 1 || idx % 2 === 0;
        }

        return {
            ...item,
            x,
            y,
            barWidth,
            barHeight,
            slotCenterX,
            showDateLabel,
        };
    });
});

// Item yang sedang di-hover atau default item terakhir
const activeHoveredItem = computed(() => {
    if (hoveredIndex.value !== null && svgChartData.value[hoveredIndex.value]) {
        return svgChartData.value[hoveredIndex.value];
    }
    return svgChartData.value[svgChartData.value.length - 1] || null;
});

// Filter log kunjungan berdasarkan kata kunci
const logKunjunganFiltered = computed(() => {
    if (!pencarianLog.value.trim()) return props.log_kunjungan;
    const q = pencarianLog.value.toLowerCase();
    return props.log_kunjungan.filter(item => 
        item.halaman.toLowerCase().includes(q) ||
        item.judul_halaman.toLowerCase().includes(q) ||
        item.alamat_ip.toLowerCase().includes(q) ||
        item.browser.toLowerCase().includes(q) ||
        item.perangkat.toLowerCase().includes(q)
    );
});
</script>

<template>
    <AdminLayout>
        <div class="space-y-6 sm:space-y-8 w-full max-w-full min-w-0">
            <!-- Header Halaman -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-2xs w-full min-w-0">
                <div class="min-w-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h2 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight truncate">Analitik Pengunjung Website</h2>
                            <p class="text-xs sm:text-sm text-gray-500 truncate">Statistik lalu lintas, perangkat, dan riwayat interaksi pengunjung secara live</p>
                        </div>
                    </div>
                </div>

                <!-- Filter Periode Waktu -->
                <div class="flex items-center gap-1.5 p-1 bg-gray-100/80 rounded-xl border border-gray-200/50 shrink-0 self-start sm:self-auto">
                    <button
                        type="button"
                        @click="ubahRentang(7)"
                        :class="[
                            'px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all',
                            filterRentangAktif === 7 ? 'bg-white text-teal-700 shadow-2xs' : 'text-gray-600 hover:text-gray-900'
                        ]"
                    >
                        7 Hari
                    </button>
                    <button
                        type="button"
                        @click="ubahRentang(14)"
                        :class="[
                            'px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all',
                            filterRentangAktif === 14 ? 'bg-white text-teal-700 shadow-2xs' : 'text-gray-600 hover:text-gray-900'
                        ]"
                    >
                        14 Hari
                    </button>
                    <button
                        type="button"
                        @click="ubahRentang(30)"
                        :class="[
                            'px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all',
                            filterRentangAktif === 30 ? 'bg-white text-teal-700 shadow-2xs' : 'text-gray-600 hover:text-gray-900'
                        ]"
                    >
                        30 Hari
                    </button>
                </div>
            </div>

            <!-- Ringkasan Kartu Metrik (Responsif: 2 kolom mobile, 3 tablet, 5 layar besar) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3.5 sm:gap-4 w-full min-w-0">
                <!-- Total Kunjungan -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden group hover:border-teal-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-3xs sm:text-xs font-bold uppercase tracking-wider text-gray-500 truncate">Total Kunjungan</span>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4 min-w-0">
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 truncate">{{ statistik.total.toLocaleString('id-ID') }}</p>
                        <p class="text-3xs sm:text-xs text-gray-400 mt-0.5 truncate">Semua halaman publik</p>
                    </div>
                </div>

                <!-- Hari Ini -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden group hover:border-emerald-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-3xs sm:text-xs font-bold uppercase tracking-wider text-gray-500 truncate">Hari Ini</span>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4 min-w-0">
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 truncate">{{ statistik.hari_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-3xs sm:text-xs text-emerald-600 font-semibold mt-0.5 truncate">Aktivitas 24 jam</p>
                    </div>
                </div>

                <!-- Minggu Ini -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden group hover:border-blue-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-3xs sm:text-xs font-bold uppercase tracking-wider text-gray-500 truncate">7 Hari Terakhir</span>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.253M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4 min-w-0">
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 truncate">{{ statistik.minggu_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-3xs sm:text-xs text-gray-400 mt-0.5 truncate">Tren sepekan</p>
                    </div>
                </div>

                <!-- Bulan Ini -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden group hover:border-purple-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-3xs sm:text-xs font-bold uppercase tracking-wider text-gray-500 truncate">30 Hari Terakhir</span>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4 min-w-0">
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 truncate">{{ statistik.bulan_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-3xs sm:text-xs text-gray-400 mt-0.5 truncate">Akumulasi sebulan</p>
                    </div>
                </div>

                <!-- Pengunjung Unik -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden group hover:border-amber-300 transition-all col-span-2 sm:col-span-1">
                    <div class="flex items-center justify-between">
                        <span class="text-3xs sm:text-xs font-bold uppercase tracking-wider text-gray-500 truncate">Pengunjung Unik</span>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4 min-w-0">
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 truncate">{{ statistik.unik.toLocaleString('id-ID') }}</p>
                        <p class="text-3xs sm:text-xs text-gray-400 mt-0.5 truncate">Berdasarkan IP unik</p>
                    </div>
                </div>
            </div>

            <!-- Grafik Tren Kunjungan Harian (SVG Responsif 100% Lebar Tanpa Overflow) -->
            <div class="bg-white p-5 sm:p-7 rounded-3xl border border-gray-100 shadow-2xs w-full min-w-0 max-w-full overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-base sm:text-lg font-bold text-gray-900">Grafik Tren Kunjungan Harian</h3>
                            <span class="inline-flex items-center gap-1.5 text-2xs font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full border border-teal-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                {{ filterRentangAktif }} Hari
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Arahkan kursor ke batang grafik untuk melihat rincian tanggal & jumlah kunjungan</p>
                    </div>

                    <!-- Highlight Info Kunjungan Terpilih / Hover -->
                    <div v-if="activeHoveredItem" class="flex items-center gap-3 p-2 px-3.5 bg-gray-50 rounded-xl border border-gray-100 self-start sm:self-auto">
                        <div class="text-left">
                            <p class="text-3xs uppercase font-bold text-gray-400 tracking-wider">Kunjungan Terpilih</p>
                            <p class="text-xs font-bold text-gray-700">{{ activeHoveredItem.tanggal_lengkap }}</p>
                        </div>
                        <div class="text-right border-l border-gray-200 pl-3">
                            <p class="text-base font-black text-teal-600">{{ activeHoveredItem.jumlah }}</p>
                            <p class="text-3xs text-gray-400 font-medium">Hits</p>
                        </div>
                    </div>
                </div>

                <!-- Container SVG Chart (Strict 100% Width) -->
                <div class="w-full min-w-0 max-w-full overflow-hidden relative pt-2">
                    <svg 
                        viewBox="0 0 1000 250" 
                        class="w-full h-56 sm:h-64 block overflow-visible select-none"
                        preserveAspectRatio="none"
                    >
                        <defs>
                            <!-- Linear Gradient untuk Bar -->
                            <linearGradient id="barGradient" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#14B8A6" />
                                <stop offset="100%" stop-color="#0D9488" />
                            </linearGradient>
                            <linearGradient id="barGradientHover" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#2DD4BF" />
                                <stop offset="100%" stop-color="#0F766E" />
                            </linearGradient>
                        </defs>

                        <!-- Garis Grid Horizontal (0%, 33%, 66%, 100%) -->
                        <g class="text-gray-200" stroke="currentColor" stroke-dasharray="3,3" stroke-width="1">
                            <!-- 100% Top -->
                            <line x1="50" y1="40" x2="980" y2="40" />
                            <!-- 66% Mid-High -->
                            <line x1="50" y1="98" x2="980" y2="98" />
                            <!-- 33% Mid-Low -->
                            <line x1="50" y1="156" x2="980" y2="156" />
                            <!-- 0% Baseline -->
                            <line x1="50" y1="215" x2="980" y2="215" stroke-dasharray="none" stroke-width="1.5" stroke="#E5E7EB" />
                        </g>

                        <!-- Label Nilai Y-Axis di sisi kiri -->
                        <g class="text-gray-400 font-medium" fill="currentColor" font-size="10" text-anchor="end">
                            <text x="42" y="44">{{ maxKunjungan }}</text>
                            <text x="42" y="102">{{ Math.round(maxKunjungan * 0.66) }}</text>
                            <text x="42" y="160">{{ Math.round(maxKunjungan * 0.33) }}</text>
                            <text x="42" y="219">0</text>
                        </g>

                        <!-- Bars dan Hit Area Interaktif -->
                        <g v-for="(item, idx) in svgChartData" :key="idx">
                            <!-- Batang Visual (Rounded Bar) -->
                            <rect
                                :x="item.x"
                                :y="item.y"
                                :width="item.barWidth"
                                :height="item.barHeight"
                                rx="5"
                                ry="5"
                                :fill="hoveredIndex === idx ? 'url(#barGradientHover)' : 'url(#barGradient)'"
                                class="transition-all duration-200 cursor-pointer"
                                :opacity="hoveredIndex !== null && hoveredIndex !== idx ? 0.6 : 1"
                            />

                            <!-- Label Angka di Atas Bar (Muncul saat hover atau saat jumlah bar sedikit) -->
                            <text
                                v-if="(hoveredIndex === idx || svgChartData.length <= 10) && item.jumlah > 0"
                                :x="item.slotCenterX"
                                :y="Math.max(item.y - 6, 20)"
                                text-anchor="middle"
                                font-size="10"
                                font-weight="700"
                                fill="#0F766E"
                                class="pointer-events-none select-none transition-all"
                            >
                                {{ item.jumlah }}
                            </text>

                            <!-- Label Tanggal Sumbu X -->
                            <text
                                v-if="item.showDateLabel"
                                :x="item.slotCenterX"
                                y="235"
                                text-anchor="middle"
                                font-size="10"
                                :font-weight="hoveredIndex === idx ? '700' : '500'"
                                :fill="hoveredIndex === idx ? '#0F766E' : '#6B7280'"
                                class="pointer-events-none select-none"
                            >
                                {{ item.tanggal }}
                            </text>

                            <!-- Area Hitbox Transparan untuk interaksi mouse yang mudah dan mulus -->
                            <rect
                                :x="item.slotCenterX - ((1000 - 80) / svgChartData.length) / 2"
                                y="20"
                                :width="(1000 - 80) / svgChartData.length"
                                height="215"
                                fill="transparent"
                                class="cursor-pointer"
                                @mouseenter="hoveredIndex = idx"
                                @mouseleave="hoveredIndex = null"
                            />
                        </g>
                    </svg>
                </div>
            </div>

            <!-- Demografi: Perangkat, Browser & Halaman Populer (3 Kolom Responsif) -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 w-full min-w-0">
                <!-- 1. Perangkat Pengunjung -->
                <div class="bg-white p-5 sm:p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900 truncate">Perangkat Pengunjung</h3>
                            <span class="text-xs text-gray-400 shrink-0">Distribusi</span>
                        </div>
                        <div class="space-y-4">
                            <div v-for="item in distribusi_perangkat" :key="item.nama" class="space-y-1.5 min-w-0">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <div class="flex items-center gap-2 truncate">
                                        <span v-if="item.nama === 'Mobile'" class="text-teal-600 shrink-0">📱</span>
                                        <span v-else-if="item.nama === 'Tablet'" class="text-blue-600 shrink-0">📟</span>
                                        <span v-else class="text-purple-600 shrink-0">💻</span>
                                        <span class="text-gray-800 truncate">{{ item.nama }}</span>
                                    </div>
                                    <span class="text-gray-600 font-bold shrink-0 ml-2">{{ item.persen }}% <span class="text-gray-400 font-normal">({{ item.total }})</span></span>
                                </div>
                                <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                    <div 
                                        class="h-full rounded-full transition-all duration-500"
                                        :class="item.nama === 'Mobile' ? 'bg-teal-500' : (item.nama === 'Tablet' ? 'bg-blue-500' : 'bg-purple-500')"
                                        :style="{ width: `${item.persen}%` }"
                                    ></div>
                                </div>
                            </div>

                            <div v-if="distribusi_perangkat.length === 0" class="text-xs text-gray-400 text-center py-6">
                                Belum ada data kunjungan tercatat
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Browser Populer -->
                <div class="bg-white p-5 sm:p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900 truncate">Browser Teratas</h3>
                            <span class="text-xs text-gray-400 shrink-0">Paling Sering</span>
                        </div>
                        <div class="space-y-4">
                            <div v-for="item in distribusi_browser" :key="item.nama" class="space-y-1.5 min-w-0">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-gray-800 truncate">{{ item.nama }}</span>
                                    <span class="text-gray-600 font-bold shrink-0 ml-2">{{ item.persen }}% <span class="text-gray-400 font-normal">({{ item.total }})</span></span>
                                </div>
                                <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                    <div 
                                        class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-500"
                                        :style="{ width: `${item.persen}%` }"
                                    ></div>
                                </div>
                            </div>

                            <div v-if="distribusi_browser.length === 0" class="text-xs text-gray-400 text-center py-6">
                                Belum ada data browser
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Halaman Terpopuler -->
                <div class="bg-white p-5 sm:p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between min-w-0 overflow-hidden md:col-span-2 xl:col-span-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900 truncate">Halaman Populer</h3>
                            <span class="text-xs text-gray-400 shrink-0">Top Kunjungan</span>
                        </div>
                        <div class="space-y-2.5">
                            <div 
                                v-for="(item, idx) in halaman_populer" 
                                :key="idx" 
                                class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50/80 hover:bg-teal-50/50 transition-colors border border-gray-100 min-w-0"
                            >
                                <div class="truncate mr-3 min-w-0">
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ item.judul_halaman || item.halaman }}</p>
                                    <p class="text-3xs text-gray-400 font-mono truncate">{{ item.halaman }}</p>
                                </div>
                                <span class="text-xs font-black text-teal-600 bg-white px-2 py-0.5 rounded-lg border border-teal-200 shrink-0">
                                    {{ item.total }}x
                                </span>
                            </div>

                            <div v-if="halaman_populer.length === 0" class="text-xs text-gray-400 text-center py-6">
                                Belum ada data kunjungan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Log Kunjungan Terbaru -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-2xs overflow-hidden w-full min-w-0 max-w-full">
                <div class="p-5 sm:p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Riwayat Kunjungan Terbaru</h3>
                        <p class="text-xs text-gray-500">Log interaksi terkini oleh pengunjung publik website (50 catatan terakhir)</p>
                    </div>
                    <!-- Input Pencarian Log -->
                    <div class="relative w-full sm:w-72 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input
                            v-model="pencarianLog"
                            type="text"
                            placeholder="Cari halaman, IP, atau browser..."
                            class="w-full pl-10 pr-4 py-2 text-xs rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all"
                        />
                    </div>
                </div>

                <!-- Tabel Data Log (Scrollable horizontal terbatas di dalam card tabelnya saja) -->
                <div class="w-full overflow-x-auto min-w-0">
                    <table class="w-full text-left text-xs min-w-[640px]">
                        <thead class="bg-gray-50/75 border-b border-gray-100 text-gray-500 font-bold uppercase tracking-wider text-3xs">
                            <tr>
                                <th class="py-3.5 px-6">Waktu</th>
                                <th class="py-3.5 px-6">Halaman</th>
                                <th class="py-3.5 px-6">Perangkat</th>
                                <th class="py-3.5 px-6">Browser & OS</th>
                                <th class="py-3.5 px-6">Alamat IP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr 
                                v-for="log in logKunjunganFiltered" 
                                :key="log.id"
                                class="hover:bg-gray-50/80 transition-colors"
                            >
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">{{ log.waktu_relatif }}</div>
                                    <div class="text-3xs text-gray-400">{{ log.waktu }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-900">{{ log.judul_halaman }}</div>
                                    <div class="text-3xs text-teal-600 font-mono">{{ log.halaman }}</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <span 
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-3xs font-bold"
                                        :class="log.perangkat === 'Mobile' ? 'bg-teal-50 text-teal-700 border border-teal-200' : 'bg-gray-100 text-gray-700'"
                                    >
                                        {{ log.perangkat }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-semibold text-gray-800">{{ log.browser }}</div>
                                    <div class="text-3xs text-gray-400">{{ log.sistem_operasi }}</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap font-mono text-gray-500">
                                    {{ log.alamat_ip }}
                                </td>
                            </tr>

                            <tr v-if="logKunjunganFiltered.length === 0">
                                <td colspan="5" class="py-12 text-center text-gray-400">
                                    Tidak ada catatan kunjungan yang cocok dengan pencarian
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
