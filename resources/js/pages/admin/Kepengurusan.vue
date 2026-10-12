<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const team = ref([
    { id: 1, name: 'Bpk. H. Ahmad Sunaryo', role: 'Ketua Yayasan', photo: '/assets/images/user1.jpg' },
    { id: 2, name: 'Ibu Hj. Siti Aminah', role: 'Bendahara', photo: '/assets/images/user2.jpg' },
]);
</script>
<template>
    <Head title="Manajemen Kepengurusan | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" /><path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 016.576-3.036c.32.32.613.67.878 1.042a.75.75 0 01-.58 1.15H5.082zM18.918 14.254a8.287 8.287 0 011.308 5.135 9.687 9.687 0 001.764-.44l.115-.04a.563.563 0 00.373-.487l.01-.121a3.75 3.75 0 00-6.576-3.036c-.32.32-.613.67-.878 1.042a.75.75 0 00.58 1.15h3.304z" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Struktur Kepengurusan</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Kelola data <strong>Ketua, Sekretaris, Bendahara, dan Pengurus lainnya</strong>. Tambahkan foto resmi, nama, dan jabatannya untuk memperbarui halaman publik secara instan.
                    </p>
                </div>
            </div>

            <!-- List Editor -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Pengurus Yayasan</h2>
                    <button class="px-5 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg hover:bg-blue-200 transition-colors text-sm">
                        + Tambah Pengurus
                    </button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="(person, index) in team" :key="index" class="border border-gray-200 p-6 rounded-2xl relative group">
                        <button class="absolute top-4 right-4 text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition-opacity z-10 bg-white rounded-full w-8 h-8 flex items-center justify-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>

                        <div class="w-full h-48 bg-gray-100 rounded-xl mb-4 overflow-hidden relative border-2 border-dashed border-gray-300 hover:border-teal-500 cursor-pointer">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 z-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 mb-1"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" /></svg>
                                <span class="text-xs font-bold">Ubah Foto</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                                <input v-model="person.name" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-teal-500 font-bold" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jabatan / Posisi</label>
                                <input v-model="person.role" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-teal-500 text-sm font-medium" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Struktur Kepengurusan
                    </button>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
