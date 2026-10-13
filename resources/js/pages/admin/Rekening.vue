<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

interface BankItem {
    id: number;
    nama_bank: string;
    nomor_rekening: string;
    atas_nama: string;
    logo?: string;
}

const props = defineProps<{
    bankList?: BankItem[];
}>();

const banks = ref(
    props.bankList && props.bankList.length > 0 
        ? JSON.parse(JSON.stringify(props.bankList))
        : []
);

const showAddModal = ref(false);
const newForm = useForm({
    nama_bank: '',
    nomor_rekening: '',
    atas_nama: 'Yayasan Raharja Mandiri',
    logo: null as File | null,
});

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        newForm.logo = target.files[0];
    }
};

const submitNew = () => {
    newForm.post('/admin/rekening', {
        onSuccess: () => {
            showAddModal.value = false;
            newForm.reset();
            alert('Rekening baru berhasil ditambahkan!');
        },
    });
};

const saveAll = () => {
    const payload = banks.value.map((b: any) => ({
        id: b.id,
        name: b.nama_bank,
        account: b.nomor_rekening,
        owner: b.atas_nama,
    }));

    router.post('/admin/rekening/update', {
        banks: payload,
    }, {
        preserveScroll: true,
        onSuccess: () => alert('Perubahan rekening berhasil disimpan!'),
    });
};

const deleteBank = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus rekening ini?')) return;

    router.delete(`/admin/rekening/${id}`, {
        preserveScroll: true,
        onSuccess: () => alert('Rekening berhasil dihapus.'),
    });
};
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

            <!-- Modal Tambah Rekening -->
            <div v-if="showAddModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Tambah Rekening Bank Baru</h3>
                    
                    <form @submit.prevent="submitNew" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Bank / E-Wallet</label>
                            <input v-model="newForm.nama_bank" type="text" required placeholder="Contoh: Bank Syariah Indonesia (BSI)" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nomor Rekening / VA</label>
                            <input v-model="newForm.nomor_rekening" type="text" required placeholder="Contoh: 712 345 6789" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-black tracking-wider" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Atas Nama (A/N)</label>
                            <input v-model="newForm.atas_nama" type="text" required placeholder="Contoh: Yayasan Raharja Mandiri" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500" />
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
                    <h2 class="text-xl font-bold text-gray-900">Daftar Rekening Aktif</h2>
                    <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all flex items-center gap-2 text-sm">
                        + Tambah Rekening
                    </button>
                </div>
                
                <div class="p-8 space-y-6">
                    <div v-for="bank in banks" :key="bank.id" class="p-6 border border-gray-200 rounded-2xl flex flex-col md:flex-row gap-6 relative group bg-white">
                        <button @click="deleteBank(bank.id)" type="button" class="absolute top-4 right-4 text-red-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                        
                        <div class="w-full md:w-1/3">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Bank/Instansi</label>
                            <input v-model="bank.nama_bank" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        
                        <div class="w-full md:w-2/3 space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nomor Rekening / Virtual Account</label>
                                <input v-model="bank.nomor_rekening" type="text" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-black text-xl tracking-wider text-gray-900" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Atas Nama (A/N)</label>
                                <input v-model="bank.atas_nama" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button @click="saveAll" type="button" class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Perubahan Rekening
                    </button>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
