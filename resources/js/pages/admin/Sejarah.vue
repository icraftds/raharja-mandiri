<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref, watch } from 'vue';

interface SejarahItem {
    id?: number;
    tahun: string;
    judul: string;
    deskripsi: string;
    gambar?: string;
    urutan?: number;
}

const props = defineProps<{
    sejarahList?: SejarahItem[];
}>();

const items = ref<SejarahItem[]>(
    props.sejarahList && props.sejarahList.length > 0 
        ? JSON.parse(JSON.stringify(props.sejarahList))
        : []
);

// Sinkronkan state lokal items secara otomatis saat props.sejarahList diperbarui oleh server (Inertia)
watch(
    () => props.sejarahList,
    (newList) => {
        if (newList) {
            items.value = JSON.parse(JSON.stringify(newList));
        }
    },
    { deep: true }
);

const showAddModal = ref(false);
const newForm = useForm({
    tahun: '',
    judul: '',
    deskripsi: '',
    gambar: null as File | null,
});

const onNewFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        newForm.gambar = target.files[0];
    }
};

const submitNew = () => {
    newForm.post('/admin/sejarah', {
        preserveScroll: true,
        onSuccess: () => {
            showAddModal.value = false;
            newForm.reset();
            alert('Momentum sejarah baru berhasil ditambahkan!');
        },
    });
};

const saveAll = () => {
    router.post('/admin/sejarah/update', {
        sejarah: items.value,
    }, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Perubahan linimasa sejarah berhasil disimpan!');
        },
    });
};

const deleteItem = (id?: number, index?: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus momentum sejarah ini?')) return;
    
    if (id) {
        router.delete(`/admin/sejarah/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                // Hapus langsung dari array lokal agar tampilan Vue reaktif seketika tanpa refresh
                items.value = items.value.filter(it => it.id !== id);
                alert('Data berhasil dihapus.');
            },
        });
    } else if (index !== undefined) {
        items.value.splice(index, 1);
    }
};
</script>

<template>
    <Head title="Edit Sejarah | CMS" />
    <AdminLayout>
        <div class="max-w-5xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm.04 4.542a.75.75 0 01.71.75v3.693l2.258 1.13a.75.75 0 11-.67 1.342l-2.67-1.335A.75.75 0 0111.25 11.6V7.542a.75.75 0 01.79-.75z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Halaman Sejarah</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda sedang mengedit <strong>Linimasa Sejarah</strong>. Perubahan di bawah ini akan langsung tampil di halaman <i>Tentang Kami -> Sejarah</i>.
                    </p>
                </div>
            </div>

            <!-- Modal Tambah Baru -->
            <div v-if="showAddModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Tambah Momentum Sejarah Baru</h3>
                    
                    <form @submit.prevent="submitNew" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tahun / Periode</label>
                            <input v-model="newForm.tahun" type="text" required placeholder="Contoh: 2012 atau Sekarang" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Judul Peristiwa</label>
                            <input v-model="newForm.judul" type="text" required placeholder="Contoh: Perluasan Gedung Asrama" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi Lengkap</label>
                            <textarea v-model="newForm.deskripsi" rows="4" required placeholder="Jelaskan momentum tersebut..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Foto Dokumentasi (Opsional)</label>
                            <input type="file" accept="image/*" @change="onNewFileChange" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="showAddModal = false" class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100">Batal</button>
                            <button type="submit" :disabled="newForm.processing" class="px-6 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Sejarah -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Linimasa (Timeline)</h2>
                    <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition-colors text-sm shadow-md">
                        + Tambah Tahun Baru
                    </button>
                </div>
                
                <div class="p-8 space-y-6">
                    <div v-for="(item, index) in items" :key="item.id || index" class="p-6 border border-gray-200 rounded-2xl flex flex-col md:flex-row gap-6 relative group">
                        <button @click="deleteItem(item.id, index)" type="button" class="absolute top-4 right-4 text-red-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                        
                        <div class="w-full md:w-1/4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tahun / Periode</label>
                            <input v-model="item.tahun" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                            
                            <div v-if="item.gambar" class="mt-4 rounded-xl overflow-hidden h-24 border border-gray-100">
                                <img :src="item.gambar" class="w-full h-full object-cover" />
                            </div>
                        </div>

                        <div class="w-full md:w-3/4 space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Judul Peristiwa</label>
                                <input v-model="item.judul" type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Deskripsi Lengkap</label>
                                <textarea v-model="item.deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <div v-if="items.length === 0" class="text-center py-12 text-gray-400">
                        Belum ada momentum sejarah yang terdaftar. Klik "+ Tambah Tahun Baru" untuk menambahkan.
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button @click="saveAll" type="button" class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all">
                        Simpan Perubahan Sejarah
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
