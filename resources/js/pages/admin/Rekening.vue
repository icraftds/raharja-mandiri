<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const banks = ref([
    { id: 1, name: 'BCA', account: '1234567890', owner: 'Panti Sosial Raharja Mandiri', logo: '/assets/images/bank-bca.png' },
    { id: 2, name: 'BSI', account: '0987654321', owner: 'Panti Sosial Raharja Mandiri', logo: '/assets/images/bank-bsi.png' },
]);
</script>
<template>
    <Head title="Manajemen Rekening | CMS" />
    <AdminLayout>
        <div class="max-w-5xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" /><path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Rekening Donasi</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Tambahkan, ubah, atau hapus <strong>Nomor Rekening Bank & E-Wallet</strong> yang akan ditampilkan kepada para donatur di halaman publik.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Rekening Aktif</h2>
                    <button class="px-5 py-2 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all flex items-center gap-2">
                        + Tambah Rekening
                    </button>
                </div>
                
                <div class="p-8 space-y-6">
                    <!-- Form template for each bank account -->
                    <div v-for="(bank, index) in banks" :key="index" class="p-6 border border-gray-200 rounded-2xl flex flex-col md:flex-row gap-6 relative group">
                        <button class="absolute top-4 right-4 text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                        
                        <div class="w-full md:w-1/4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Bank/Instansi</label>
                            <input v-model="bank.name" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                            
                            <label class="block text-xs font-bold text-gray-500 uppercase mt-4 mb-2">Logo Bank (URL/Upload)</label>
                            <div class="h-16 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-xs font-bold text-gray-500 cursor-pointer">
                                Ubah Logo
                            </div>
                        </div>
                        
                        <div class="w-full md:w-3/4 space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nomor Rekening / Virtual Account</label>
                                <input v-model="bank.account" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-black text-xl tracking-wider text-gray-900" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Atas Nama (A/N)</label>
                                <input v-model="bank.owner" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Perubahan Rekening
                    </button>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
