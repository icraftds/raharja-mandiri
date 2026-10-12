<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';

const articles = [
    { id: 1, title: 'Bantuan Pendidikan Semester Ganjil 2026', date: '10 Okt 2026', category: 'Pendidikan', status: 'Published' },
    { id: 2, title: 'Kunjungan Komunitas Berbagi Kasih', date: '05 Okt 2026', category: 'Kunjungan', status: 'Published' },
    { id: 3, title: 'Draft: Persiapan Qurban', date: '-', category: 'Keagamaan', status: 'Draft' },
];
</script>
<template>
    <Head title="Manajemen Artikel | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Artikel & Berita</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda dapat membuat, mengedit, atau menghapus berita kegiatan. Berita terbaru akan otomatis tampil di atas pada halaman publik.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Artikel</h2>
                    <Link href="/admin/artikel/edit" class="px-6 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Tulis Artikel Baru
                    </Link>
                </div>
                
                <div>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-widest border-b border-gray-100">
                                <th class="p-6 font-bold">Judul Artikel</th>
                                <th class="p-6 font-bold">Kategori</th>
                                <th class="p-6 font-bold">Tanggal</th>
                                <th class="p-6 font-bold">Status</th>
                                <th class="p-6 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="news in articles" :key="news.id" class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="p-6">
                                    <p class="font-bold text-gray-900 text-lg">{{ news.title }}</p>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ news.category }}</span>
                                </td>
                                <td class="p-6 text-gray-500 font-medium">{{ news.date }}</td>
                                <td class="p-6">
                                    <span :class="['px-3 py-1 rounded-full text-xs font-bold', news.status === 'Published' ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600']">
                                        {{ news.status }}
                                    </span>
                                </td>
                                <td class="p-6 text-right space-x-2">
                                    <Link href="/admin/artikel/edit" class="inline-block p-2 bg-white border border-gray-200 rounded-lg text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                        Edit
                                    </Link>
                                    <button class="inline-block p-2 bg-white border border-gray-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition-colors">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
