<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

interface PhotoItem {
    id: number;
    judul: string;
    kategori: string;
    gambar: string;
}

const props = defineProps<{
    photoList?: PhotoItem[];
}>();

const uploadForm = useForm({
    judul: '',
    kategori: 'Pendidikan',
    gambar: null as File | null,
});

const previewImg = ref<string | null>(null);

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        uploadForm.gambar = target.files[0];
        previewImg.value = URL.createObjectURL(target.files[0]);
    }
};

const submitUpload = () => {
    uploadForm.post('/admin/galeri', {
        preserveScroll: true,
        onSuccess: () => {
            uploadForm.reset();
            previewImg.value = null;
            alert('Foto baru berhasil diunggah ke galeri!');
        },
    });
};

const deletePhoto = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus foto ini dari galeri?')) return;

    router.delete(`/admin/galeri/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Foto berhasil dihapus.');
        },
    });
};
</script>

<template>
    <Head title="Manajemen Galeri | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Galeri Foto</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda dapat mengunggah foto baru, menetapkan kategori, dan mengubah judul foto yang akan tampil di halaman <strong>Galeri</strong> publik.
                    </p>
                </div>
            </div>

            <!-- Upload Box -->
            <form @submit.prevent="submitUpload" class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-xl font-bold text-gray-900">Upload Foto Baru</h2>
                </div>
                <div class="p-8 flex flex-col md:flex-row gap-8">
                    <label class="w-full md:w-1/3 h-52 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 hover:border-teal-500 cursor-pointer transition-colors group relative overflow-hidden">
                        <img v-if="previewImg" :src="previewImg" class="absolute inset-0 w-full h-full object-cover" />
                        <div v-else class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 mb-3 group-hover:text-teal-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            <span class="font-bold text-sm">Pilih Gambar</span>
                            <span class="text-xs mt-1">JPG, PNG, WebP max 2MB</span>
                        </div>
                        <input type="file" accept="image/*" class="hidden" required @change="onFileChange" />
                    </label>

                    <div class="w-full md:w-2/3 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto</label>
                            <input v-model="uploadForm.judul" type="text" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium" placeholder="Contoh: Belajar Komputer Bersama" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select v-model="uploadForm.kategori" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white">
                                <option>Pendidikan</option>
                                <option>Kesehatan</option>
                                <option>Keagamaan</option>
                                <option>Kunjungan</option>
                            </select>
                        </div>
                        <div class="pt-2">
                            <button type="submit" :disabled="uploadForm.processing" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all disabled:opacity-50">
                                <span v-if="uploadForm.processing">Mengunggah...</span>
                                <span v-else>Upload & Simpan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- List Foto -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Foto Galeri</h2>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div v-for="photo in props.photoList" :key="photo.id" class="border border-gray-200 rounded-2xl overflow-hidden group relative bg-gray-100">
                            <div class="h-44 overflow-hidden relative">
                                <img :src="photo.gambar" class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                    <button @click="deletePhoto(photo.id)" type="button" class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600 shadow transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4 bg-white">
                                <span class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-1 block">{{ photo.kategori }}</span>
                                <h4 class="font-bold text-gray-900 truncate">{{ photo.judul }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
