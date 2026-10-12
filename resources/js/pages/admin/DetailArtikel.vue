<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const form = ref({
    title: 'Bantuan Pendidikan Semester Ganjil 2026',
    category: 'Pendidikan',
    date: '2026-10-10',
    shortDesc: 'Penyerahan bantuan alat tulis dan biaya sekolah untuk 50 anak asuh di awal semester ganjil.',
    content: 'Teks panjang artikel di sini...'
});
</script>
<template>
    <Head title="Edit Artikel | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="flex items-center gap-4 mb-6">
                <Link href="/admin/artikel" class="p-2 bg-white rounded-xl shadow-sm hover:bg-gray-50 border border-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tulis / Edit Artikel</h2>
                    <p class="text-sm text-gray-500">Sesuaikan konten berita agar terlihat sempurna di halaman publik</p>
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.158 3.71 3.71 1.159-1.157a2.625 2.625 0 000-3.711z" /><path d="M10.731 12.27l-5.352 5.353a.75.75 0 00-.205.38l-1.125 4.5a.75.75 0 00.915.914l4.5-1.125a.75.75 0 00.38-.205l5.352-5.353-4.465-4.464z" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Editor Artikel</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Lengkapi <strong>Judul, Kategori, Deskripsi Singkat (Muncul di Card), dan Tanggal</strong>. Upload gambar sampul yang menarik, lalu tuliskan isi lengkap artikel di editor utama bawah.
                    </p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Editor -->
                <div class="w-full lg:w-2/3 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden p-8 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                            <input v-model="form.title" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-bold text-lg" placeholder="Masukkan Judul..." />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat (Muncul di Card)</label>
                            <textarea v-model="form.shortDesc" rows="3" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Isi Konten Berita</label>
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <div class="bg-gray-50 border-b border-gray-200 p-3 flex gap-2">
                                    <button class="p-2 hover:bg-gray-200 rounded font-bold text-gray-700">B</button>
                                    <button class="p-2 hover:bg-gray-200 rounded italic text-gray-700">I</button>
                                    <button class="p-2 hover:bg-gray-200 rounded underline text-gray-700">U</button>
                                </div>
                                <textarea v-model="form.content" rows="15" class="w-full px-5 py-4 focus:outline-none font-medium resize-y"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Editor -->
                <div class="w-full lg:w-1/3 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden p-8 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select v-model="form.category" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white">
                                <option>Pendidikan</option>
                                <option>Kesehatan</option>
                                <option>Keagamaan</option>
                                <option>Kunjungan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Terbit</label>
                            <input v-model="form.date" type="date" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Sampul</label>
                            <div class="h-40 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 hover:border-teal-500 cursor-pointer transition-colors relative overflow-hidden">
                                <img src="/assets/images/pendidikan-1.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60" />
                                <div class="relative z-10 bg-white/80 backdrop-blur px-4 py-2 rounded-xl text-sm font-bold text-gray-800">Ubah Gambar</div>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <button class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                                Simpan & Publikasikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
