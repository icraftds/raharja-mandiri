<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const props = defineProps<{
    isEdit?: boolean;
    articleData?: {
        id?: number;
        judul?: string;
        kategori?: string;
        ringkasan?: string;
        konten?: string;
        gambar_sampul?: string;
        kutipan?: string;
        penulis_kutipan?: string;
        status?: string;
        tanggal_publikasi?: string;
    } | null;
}>();

const form = useForm({
    judul: props.articleData?.judul || '',
    kategori: props.articleData?.kategori || 'Pendidikan',
    tanggal_publikasi: props.articleData?.tanggal_publikasi ? props.articleData.tanggal_publikasi.substring(0, 10) : new Date().toISOString().substring(0, 10),
    ringkasan: props.articleData?.ringkasan || '',
    konten: props.articleData?.konten || '',
    kutipan: props.articleData?.kutipan || '',
    penulis_kutipan: props.articleData?.penulis_kutipan || '',
    status: props.articleData?.status || 'published',
    gambar_sampul: null as File | null,
});

const previewImg = ref<string | null>(props.articleData?.gambar_sampul || null);

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.gambar_sampul = target.files[0];
        previewImg.value = URL.createObjectURL(target.files[0]);
    }
};

const submit = () => {
    if (props.isEdit && props.articleData?.id) {
        form.post(`/admin/artikel/${props.articleData.id}`, {
            onSuccess: () => alert('Artikel berhasil diperbarui!'),
        });
    } else {
        form.post('/admin/artikel', {
            onSuccess: () => alert('Artikel baru berhasil diterbitkan!'),
        });
    }
};
</script>

<template>
    <Head :title="(isEdit ? 'Edit Artikel' : 'Tulis Artikel Baru') + ' | CMS'" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="flex items-center gap-4 mb-6">
                <Link href="/admin/artikel" class="p-2.5 bg-white rounded-xl shadow-sm hover:bg-gray-50 border border-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ isEdit ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
                    <p class="text-sm text-gray-500">Sesuaikan konten berita agar terlihat sempurna di halaman publik</p>
                </div>
            </div>

            <form @submit.prevent="submit" class="flex flex-col lg:flex-row gap-8">
                <!-- Main Editor -->
                <div class="w-full lg:w-2/3 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden p-8 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                            <input v-model="form.judul" type="text" required class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-bold text-lg" placeholder="Masukkan Judul..." />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ringkasan Singkat (Muncul di Card Beranda)</label>
                            <textarea v-model="form.ringkasan" rows="3" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium resize-none" placeholder="Uraian singkat 1-2 kalimat..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Isi Konten Berita</label>
                            <textarea v-model="form.konten" rows="12" required class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 font-medium resize-y leading-relaxed" placeholder="Tuliskan isi berita lengkap di sini..."></textarea>
                        </div>

                        <!-- Kutipan Inspiratif (Opsional) -->
                        <div class="pt-4 border-t border-gray-100 space-y-4">
                            <h3 class="text-md font-bold text-gray-800">Kutipan Inspiratif (Quote Highlight)</h3>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kalimat Kutipan</label>
                                <input v-model="form.kutipan" type="text" placeholder="Contoh: Pendidikan adalah jendela dunia..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Tokoh / Narasumber</label>
                                <input v-model="form.penulis_kutipan" type="text" placeholder="Contoh: H. Ahmad Sudirman, Ketua Yayasan" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 text-sm" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Editor -->
                <div class="w-full lg:w-1/3 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden p-8 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi</label>
                            <select v-model="form.status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white">
                                <option value="published">Diterbitkan (Published)</option>
                                <option value="draft">Draf (Draft)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select v-model="form.kategori" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white">
                                <option>Pendidikan</option>
                                <option>Kesehatan</option>
                                <option>Keagamaan</option>
                                <option>Kunjungan</option>
                                <option>Infrastruktur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Terbit</label>
                            <input v-model="form.tanggal_publikasi" type="date" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium bg-white" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Sampul</label>
                            <label class="h-44 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 hover:border-teal-500 cursor-pointer transition-colors relative overflow-hidden block">
                                <img v-if="previewImg" :src="previewImg" class="absolute inset-0 w-full h-full object-cover" />
                                <div class="relative z-10 bg-white/90 backdrop-blur px-4 py-2 rounded-xl text-xs font-bold text-gray-800 shadow">
                                    {{ previewImg ? 'Ganti Gambar' : 'Pilih Gambar Sampul' }}
                                </div>
                                <input type="file" accept="image/*" class="hidden" @change="onFileChange" />
                            </label>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <button type="submit" :disabled="form.processing" class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:-translate-y-1 transition-all disabled:opacity-50">
                                <span v-if="form.processing">Menyimpan...</span>
                                <span v-else>{{ isEdit ? 'Simpan Perubahan' : 'Publikasikan Artikel' }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </AdminLayout>
</template>
