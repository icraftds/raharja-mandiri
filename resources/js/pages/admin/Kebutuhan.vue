<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

interface KebutuhanItem {
    id: number;
    nama_barang: string;
    deskripsi?: string;
    target_jumlah: string;
    urgensi: string;
    warna_teks?: string;
    warna_latar?: string;
    warna_latar_muda?: string;
}

const props = defineProps<{
    kebutuhanList?: KebutuhanItem[];
}>();

const showAddModal = ref(false);
const newForm = useForm({
    nama_barang: '',
    deskripsi: '',
    target_jumlah: '',
    urgensi: 'Mendesak',
});

const submitNew = () => {
    newForm.post('/admin/kebutuhan', {
        onSuccess: () => {
            showAddModal.value = false;
            newForm.reset();
            alert('Kebutuhan donasi baru berhasil ditambahkan!');
        },
    });
};

const deleteItem = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus kebutuhan ini?')) return;

    router.delete(`/admin/kebutuhan/${id}`, {
        preserveScroll: true,
        onSuccess: () => alert('Kebutuhan berhasil dihapus.'),
    });
};
</script>

<template>
    <Head title="Manajemen Kebutuhan Donasi | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" /><path d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.738a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l1.372-.738z" /><path d="M3.265 15.102l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.738a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l1.372-.738z" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Daftar Kebutuhan Logistik</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Kelola barang-barang bantuan fisik yang dibutuhkan panti asuhan (sembako, seragam, perlengkapan mandi, dll.) agar donatur mengetahui kebutuhan mendesak saat ini.
                    </p>
                </div>
            </div>

            <!-- Modal Tambah Kebutuhan -->
            <div v-if="showAddModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Tambah Kebutuhan Barang Baru</h3>
                    
                    <form @submit.prevent="submitNew" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Barang / Paket</label>
                            <input v-model="newForm.nama_barang" type="text" required placeholder="Contoh: Sembako Utama" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Rincian Deskripsi</label>
                            <textarea v-model="newForm.deskripsi" rows="3" placeholder="Contoh: Beras, Minyak Goreng, Gula, Susu..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Target Jumlah (Kuantitas)</label>
                            <input v-model="newForm.target_jumlah" type="text" required placeholder="Contoh: 50 Paket atau Bebas" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tingkat Urgensi</label>
                            <select v-model="newForm.urgensi" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 bg-white font-medium">
                                <option value="Mendesak">Mendesak (Prioritas Tinggi)</option>
                                <option value="Rutin">Rutin (Kebutuhan Bulanan)</option>
                                <option value="Terpenuhi">Terpenuhi</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="showAddModal = false" class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100">Batal</button>
                            <button type="submit" :disabled="newForm.processing" class="px-6 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Kebutuhan Aktif</h2>
                    <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all flex items-center gap-2 text-sm">
                        + Tambah Kebutuhan
                    </button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div v-for="item in props.kebutuhanList" :key="item.id" class="border border-gray-200 p-6 rounded-2xl relative group bg-white hover:shadow-md transition-all">
                        <button @click="deleteItem(item.id)" type="button" class="absolute top-4 right-4 text-red-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                        
                        <div class="flex items-start justify-between pr-8 mb-3">
                            <h3 class="font-extrabold text-gray-900 text-xl">{{ item.nama_barang }}</h3>
                            <span :class="['px-3 py-1 rounded-full text-xs font-bold uppercase whitespace-nowrap', item.urgensi === 'Mendesak' ? 'bg-pink-100 text-pink-700' : 'bg-blue-100 text-blue-700']">
                                {{ item.urgensi }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ item.deskripsi || 'Tidak ada deskripsi tambahan.' }}</p>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs uppercase font-bold text-gray-400">Target Dibutuhkan</span>
                            <span class="text-lg font-black text-gray-900">{{ item.target_jumlah }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
