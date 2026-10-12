<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const sejarahData = ref([
    { year: '2009', title: 'Awal Mula Perjalanan', desc: 'PSRM didirikan dari sebuah inisiatif kecil...' },
    { year: '2013', title: 'Perluasan Asrama', desc: 'Melihat antusiasme dan bertambahnya jumlah anak asuh...' },
]);
</script>
<template>
    <Head title="Edit Sejarah | CMS" />
    <AdminLayout>
        <div class="max-w-5xl mx-auto">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl mb-8 flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm.04 4.542a.75.75 0 01.71.75v3.693l2.258 1.13a.75.75 0 11-.67 1.342l-2.67-1.335A.75.75 0 0111.25 11.6V7.542a.75.75 0 01.79-.75z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Halaman Sejarah</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda sedang mengedit <strong>Timeline Sejarah</strong>. Perubahan di bawah ini akan langsung tampil di halaman <i>Tentang Kami -> Sejarah</i>.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Linimasa (Timeline)</h2>
                    <button class="px-5 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg hover:bg-blue-200 transition-colors text-sm">
                        + Tambah Tahun
                    </button>
                </div>
                
                <div class="p-8 space-y-6">
                    <div v-for="(item, index) in sejarahData" :key="index" class="p-6 border border-gray-200 rounded-2xl flex flex-col md:flex-row gap-6 relative group">
                        <button class="absolute top-4 right-4 text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                        <div class="w-full md:w-1/4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tahun</label>
                            <input v-model="item.year" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        <div class="w-full md:w-3/4 space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Judul Peristiwa</label>
                                <input v-model="item.title" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Deskripsi Lengkap</label>
                                <textarea v-model="item.desc" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Perubahan Sejarah
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
