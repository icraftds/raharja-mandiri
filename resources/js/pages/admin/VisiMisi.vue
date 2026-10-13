<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';

interface MisiItem {
    id?: number;
    judul: string;
    deskripsi: string;
}

const props = defineProps<{
    visiAwal?: string;
    misiAwal?: MisiItem[];
}>();

const form = useForm({
    visi: props.visiAwal || 'Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia serta memberikan dampak nyata bagi masyarakat luas.',
    misi: props.misiAwal && props.misiAwal.length > 0 
        ? JSON.parse(JSON.stringify(props.misiAwal))
        : [
            { judul: 'Pendidikan Berkualitas', deskripsi: 'Memberikan akses pendidikan formal dan non-formal...' },
            { judul: 'Pembinaan Karakter & Akhlak', deskripsi: 'Membentuk kepribadian yang beriman...' }
        ]
});

const tambahMisi = () => {
    form.misi.push({
        judul: '',
        deskripsi: '',
    });
};

const hapusMisi = (index: number) => {
    if (form.misi.length <= 1) {
        alert('Minimal harus ada 1 misi.');
        return;
    }
    form.misi.splice(index, 1);
};

const submit = () => {
    form.post('/admin/visi-misi', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Visi & Misi berhasil disimpan!');
        },
    });
};
</script>

<template>
    <Head title="Edit Visi Misi | CMS" />
    <AdminLayout>
        <div class="max-w-5xl mx-auto space-y-10">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75-4.365 9.75-9.75 9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Visi & Misi</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda sedang mengedit <strong>Teks Visi Besar dan Daftar Misi</strong> yayasan.
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-8">
                <!-- Visi Editor -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="text-xl font-bold text-gray-900">Teks Visi Utama Yayasan</h2>
                    </div>
                    <div class="p-8">
                        <textarea v-model="form.visi" rows="4" required class="w-full px-6 py-5 rounded-2xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-bold text-lg resize-none leading-relaxed"></textarea>
                    </div>
                </div>

                <!-- Misi Editor -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">Daftar Misi (Langkah Nyata)</h2>
                        <button type="button" @click="tambahMisi" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition-colors text-sm shadow-md">
                            + Tambah Misi
                        </button>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div v-for="(item, index) in form.misi" :key="index" class="p-6 border border-gray-200 rounded-2xl relative group">
                            <button type="button" @click="hapusMisi(index)" class="absolute top-4 right-4 text-red-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>

                            <div class="flex items-center gap-4 mb-4 pr-12">
                                <span class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 font-black flex items-center justify-center shrink-0">{{ index + 1 }}</span>
                                <input v-model="item.judul" type="text" required class="flex-grow px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold text-gray-900" placeholder="Judul Misi (Contoh: Pendidikan Berkualitas)" />
                            </div>
                            <textarea v-model="item.deskripsi" rows="2" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none ml-14" style="width: calc(100% - 3.5rem)" placeholder="Uraikan langkah nyata misi ini..."></textarea>
                        </div>
                    </div>

                    <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-4">
                        <button type="submit" :disabled="form.processing" class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all disabled:opacity-50">
                            <span v-if="form.processing">Menyimpan...</span>
                            <span v-else>Simpan Semua Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
