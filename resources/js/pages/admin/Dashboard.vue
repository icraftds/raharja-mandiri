<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

const props = defineProps<{
    heroData?: {
        titleTop: string;
        titleBottom: string;
        description: string;
        badgeText?: string;
        bgImage?: string;
    };
}>();

const form = useForm({
    titleTop: props.heroData?.titleTop || 'Bersama Berbagi Kasih,',
    titleBottom: props.heroData?.titleBottom || 'Membangun Masa Depan',
    description: props.heroData?.description || 'Panti Sosial Raharja Mandiri (PSRM) berdedikasi...',
    badgeText: props.heroData?.badgeText || 'Wujudkan Harapan Mereka',
    bgImageFile: null as File | null,
});

const previewImg = ref<string | null>(props.heroData?.bgImage || null);

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.bgImageFile = target.files[0];
        previewImg.value = URL.createObjectURL(target.files[0]);
    }
};

const submit = () => {
    form.post('/admin/dashboard/hero', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Perubahan Hero Section berhasil disimpan!');
        },
    });
};
</script>

<template>
    <Head title="Edit Hero Section | CMS" />
    <AdminLayout>
        <div class="max-w-4xl mx-auto">
            
            <!-- Peringatan Instruksional -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl mb-8 flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.733l-1.052 4.208c-.153.611-.72 1.051-1.353 1.051h-1.073c-.633 0-1.2-.44-1.353-1.051l-1.052-4.208c-.311-1.27.98-2.306 2.126-1.733zm.494-4.808a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Panduan Pengeditan Admin</h3>
                    <p class="text-blue-600 leading-relaxed">
                        Anda saat ini sedang berada di pengaturan <strong>Hero Section (Bagian paling atas Halaman Beranda)</strong>. <br/>
                        Semua teks dan gambar yang Anda ubah pada kolom di bawah ini akan langsung mengubah tampilan judul dan deskripsi yang pertama kali dilihat oleh publik saat membuka website.
                    </p>
                </div>
            </div>

            <!-- Form Editor CMS -->
            <form @submit.prevent="submit" class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Ubah Teks & Gambar Utama (Homepage)</h2>
                </div>
                
                <div class="p-8 space-y-8">
                    <!-- Live Preview Box -->
                    <div class="bg-gray-900 rounded-2xl p-8 relative overflow-hidden group">
                        <img v-if="previewImg" :src="previewImg" class="absolute inset-0 w-full h-full object-cover opacity-30" />
                        <div class="absolute inset-0 bg-gradient-to-r from-teal-500/20 to-blue-500/20"></div>
                        <div class="relative z-10">
                            <span class="text-xs text-teal-400 uppercase tracking-widest font-bold mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                                Live Preview Tampilan
                            </span>
                            <span class="inline-block py-1 px-3 rounded-full bg-blue-500/30 text-blue-200 text-xs font-semibold mb-3">
                                {{ form.badgeText }}
                            </span>
                            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4 leading-tight">
                                {{ form.titleTop }} <br/>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-blue-400">{{ form.titleBottom }}</span>
                            </h1>
                            <p class="text-gray-300 text-sm max-w-2xl leading-relaxed">{{ form.description }}</p>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Teks Lencana (Badge)</label>
                            <input v-model="form.badgeText" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-medium" />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Baris Pertama (Teks Putih)</label>
                            <input v-model="form.titleTop" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-medium" />
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Baris Kedua (Teks Warna-Warni)</label>
                            <input v-model="form.titleBottom" type="text" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-medium" />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Paragraf Penjelasan</label>
                            <textarea v-model="form.description" rows="4" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all text-gray-800 font-medium resize-none leading-relaxed"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Background Hero (Opsional)</label>
                            <div class="flex items-center gap-4">
                                <label class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl cursor-pointer transition-colors text-sm">
                                    Pilih Gambar Baru
                                    <input type="file" accept="image/*" class="hidden" @change="onFileChange" />
                                </label>
                                <span v-if="form.bgImageFile" class="text-sm font-medium text-teal-600 truncate">{{ form.bgImageFile.name }}</span>
                                <span v-else class="text-sm text-gray-400">Gunakan berkas JPG/PNG max 2MB</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button type="submit" :disabled="form.processing" class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-teal-500/30 hover:-translate-y-1 transition-all flex items-center gap-2 disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span v-if="form.processing">Menyimpan...</span>
                        <span v-else>Simpan Perubahan Publik</span>
                    </button>
                </div>
            </form>

        </div>
    </AdminLayout>
</template>
