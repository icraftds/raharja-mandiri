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

const ubahRentang = (hari: number) => {
    filterRentangAktif.value = hari;
    router.get('/admin/pengunjung', { rentang: hari }, {
        preserveState: true,
        preserveScroll: true,
    });
};

// Hitung nilai maksimum grafik untuk skala SVG Bar
const maxKunjungan = computed(() => {
    const max = Math.max(...props.grafik_harian.map(item => item.jumlah), 1);
    return max;
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
        <div class="space-y-8">
            <!-- Header Halaman -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-2xs">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Analitik Pengunjung Website</h2>
                            <p class="text-sm text-gray-500">Statistik lalu lintas, perangkat, dan riwayat interaksi pengunjung secara live</p>
                        </div>
                    </div>
                </div>

                <!-- Filter Periode Waktu -->
                <div class="flex items-center gap-1.5 p-1 bg-gray-100/80 rounded-xl border border-gray-200/50 self-start sm:self-auto">
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

            <!-- Ringkasan Kartu Metrik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- Total Kunjungan -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between relative overflow-hidden group hover:border-teal-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Kunjungan</span>
                        <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-gray-900">{{ statistik.total.toLocaleString('id-ID') }}</p>
                        <p class="text-xs text-gray-400 mt-1">Semua halaman publik</p>
                    </div>
                </div>

                <!-- Hari Ini -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between relative overflow-hidden group hover:border-emerald-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Hari Ini</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-gray-900">{{ statistik.hari_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-xs text-emerald-600 font-semibold mt-1">Aktivitas 24 jam</p>
                    </div>
                </div>

                <!-- Minggu Ini -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between relative overflow-hidden group hover:border-blue-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">7 Hari Terakhir</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.253M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-gray-900">{{ statistik.minggu_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-xs text-gray-400 mt-1">Tren sepekan</p>
                    </div>
                </div>

                <!-- Bulan Ini -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between relative overflow-hidden group hover:border-purple-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">30 Hari Terakhir</span>
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-gray-900">{{ statistik.bulan_ini.toLocaleString('id-ID') }}</p>
                        <p class="text-xs text-gray-400 mt-1">Akumulasi sebulan</p>
                    </div>
                </div>

                <!-- Pengunjung Unik -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-2xs flex flex-col justify-between relative overflow-hidden group hover:border-amber-300 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Pengunjung Unik</span>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-gray-900">{{ statistik.unik.toLocaleString('id-ID') }}</p>
                        <p class="text-xs text-gray-400 mt-1">Berdasarkan IP unik</p>
                    </div>
                </div>
            </div>

            <!-- Grafik Tren Kunjungan Harian -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-100 shadow-2xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Grafik Tren Kunjungan Harian</h3>
                        <p class="text-xs text-gray-500">Pola frekuensi kunjungan website selama periode terpilih</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-teal-700 bg-teal-50 px-3 py-1 rounded-full border border-teal-200">
                            <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                            {{ filterRentangAktif }} Hari Terakhir
                        </span>
                    </div>
                </div>

                <!-- Visual Bar Chart Interaktif -->
                <div class="h-64 flex items-end gap-2 sm:gap-3 pt-6 pb-2 border-b border-gray-100">
                    <div 
                        v-for="(item, idx) in grafik_harian" 
                        :key="idx" 
                        class="flex-1 flex flex-col items-center h-full justify-end group relative"
                    >
                        <!-- Tooltip Popover -->
                        <div class="absolute -top-12 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-2xs sm:text-xs rounded-lg py-1 px-2.5 pointer-events-none whitespace-nowrap z-20 shadow-lg">
                            <p class="font-bold">{{ item.jumlah }} Kunjungan</p>
                            <p class="text-gray-400 text-3xs">{{ item.tanggal_lengkap }}</p>
                        </div>

                        <!-- Bar Visual -->
                        <div 
                            class="w-full max-w-[38px] rounded-t-xl bg-gradient-to-t from-teal-500 to-teal-400 group-hover:from-teal-600 group-hover:to-teal-300 transition-all duration-300 relative shadow-2xs"
                            :style="{ height: `${Math.max((item.jumlah / maxKunjungan) * 100, 6)}%` }"
                        >
                            <!-- Label Nilai di atas bar saat cukup tinggi -->
                            <span 
                                v-if="item.jumlah > 0"
                                class="absolute -top-5 left-1/2 -translate-x-1/2 text-3xs font-bold text-teal-700"
                            >
                                {{ item.jumlah }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Label Sumbu X (Tanggal) -->
                <div class="flex justify-between gap-1 mt-3 px-1">
                    <div 
                        v-for="(item, idx) in grafik_harian" 
                        :key="idx"
                        class="flex-1 text-center text-3xs sm:text-2xs font-semibold text-gray-500 truncate"
                    >
                        {{ item.tanggal }}
                    </div>
                </div>
            </div>

            <!-- Demografi: Perangkat, Browser & Halaman Populer -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- 1. Perangkat Pengunjung -->
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900">Perangkat Pengunjung</h3>
                            <span class="text-xs text-gray-400">Distribusi</span>
                        </div>
                        <div class="space-y-4">
                            <div v-for="item in distribusi_perangkat" :key="item.nama" class="space-y-1.5">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <div class="flex items-center gap-2">
                                        <!-- Ikon Perangkat -->
                                        <span v-if="item.nama === 'Mobile'" class="text-teal-600">📱</span>
                                        <span v-else-if="item.nama === 'Tablet'" class="text-blue-600">📟</span>
                                        <span v-else class="text-purple-600">💻</span>
                                        <span class="text-gray-800">{{ item.nama }}</span>
                                    </div>
                                    <span class="text-gray-600 font-bold">{{ item.persen }}% <span class="text-gray-400 font-normal">({{ item.total }})</span></span>
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
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900">Browser Teratas</h3>
                            <span class="text-xs text-gray-400">Paling Sering</span>
                        </div>
                        <div class="space-y-4">
                            <div v-for="item in distribusi_browser" :key="item.nama" class="space-y-1.5">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-gray-800">{{ item.nama }}</span>
                                    <span class="text-gray-600 font-bold">{{ item.persen }}% <span class="text-gray-400 font-normal">({{ item.total }})</span></span>
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
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-bold text-gray-900">Halaman Populer</h3>
                            <span class="text-xs text-gray-400">Top Kunjungan</span>
                        </div>
                        <div class="space-y-3">
                            <div 
                                v-for="(item, idx) in halaman_populer" 
                                :key="idx" 
                                class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50/80 hover:bg-teal-50/50 transition-colors border border-gray-100"
                            >
                                <div class="truncate mr-3">
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
            <div class="bg-white rounded-3xl border border-gray-100 shadow-2xs overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Riwayat Kunjungan Terbaru</h3>
                        <p class="text-xs text-gray-500">Log interaksi terkini oleh pengunjung publik website (50 catatan terakhir)</p>
                    </div>
                    <!-- Input Pencarian Log -->
                    <div class="relative w-full sm:w-72">
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

                <!-- Tabel Data Log -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
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
