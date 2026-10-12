<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const contact = ref({
    address: 'Dusun Tanjungsari RT 01/02, Desa Tanjungsari, Kec. Tanjungsari, Kab. Sumedang, Jawa Barat 45362',
    phone: '0812-3456-7890',
    email: 'info@raharjamandiri.org',
    mapsUrl: 'https://maps.google.com/...',
    instagram: '@raharjamandiri'
});
</script>
<template>
    <Head title="Manajemen Kontak | CMS" />
    <AdminLayout>
        <div class="max-w-4xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Informasi Kontak & Lokasi</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Data kontak ini akan otomatis memperbarui informasi di <strong>Footer Website</strong> dan <strong>Halaman Hubungi Kami</strong>.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-xl font-bold text-gray-900">Ubah Data Kontak Publik</h2>
                </div>
                
                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Yayasan</label>
                        <textarea v-model="contact.address" rows="3" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                            <input v-model="contact.phone" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                            <input v-model="contact.email" type="email" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium text-blue-600" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Link Google Maps (Iframe/URL)</label>
                            <input v-model="contact.mapsUrl" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Username / Link Instagram</label>
                            <input v-model="contact.instagram" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium" />
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Pembaruan Kontak
                    </button>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
