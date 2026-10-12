<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const visiText = ref('Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia serta memberikan dampak nyata bagi masyarakat luas.');

const missions = ref([
    { title: 'Pendidikan Berkualitas', desc: 'Memberikan akses pendidikan formal dan non-formal...' },
    { title: 'Pembinaan Karakter & Akhlak', desc: 'Membentuk kepribadian yang beriman...' }
]);
</script>
<template>
    <Head title="Edit Visi Misi | CMS" />
    <AdminLayout>
        <div class="max-w-5xl mx-auto space-y-10">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Visi & Misi</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda sedang mengedit <strong>Teks Visi Besar dan Daftar Misi</strong>.
                    </p>
                </div>
            </div>

            <!-- Visi Editor -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-xl font-bold text-gray-900">Teks Visi Yayasan</h2>
                </div>
                <div class="p-8">
                    <textarea v-model="visiText" rows="4" class="w-full px-6 py-5 rounded-2xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-bold text-lg resize-none leading-relaxed"></textarea>
                </div>
            </div>

            <!-- Misi Editor -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Misi (Langkah Nyata)</h2>
                    <button class="px-5 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg hover:bg-blue-200 transition-colors text-sm">
                        + Tambah Misi
                    </button>
                </div>
                
                <div class="p-8 space-y-6">
                    <div v-for="(item, index) in missions" :key="index" class="p-6 border border-gray-200 rounded-2xl relative group">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-500">{{ index + 1 }}</span>
                            <input v-model="item.title" type="text" class="flex-grow px-4 py-2 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" placeholder="Judul Misi" />
                        </div>
                        <textarea v-model="item.desc" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none ml-12" style="width: calc(100% - 3rem)" placeholder="Deskripsi Misi..."></textarea>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-4">
                    <button class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Semua Perubahan
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
