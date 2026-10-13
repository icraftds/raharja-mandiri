<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref, watch } from 'vue';

interface MitraItem {
    id: number;
    nama: string;
    kategori: string;
    tipe_ikon?: string | null;
    logo?: string | null;
    urutan?: number;
    aktif: boolean;
}

const props = defineProps<{
    mitraList?: MitraItem[];
}>();

const items = ref<MitraItem[]>(
    props.mitraList && props.mitraList.length > 0 
        ? JSON.parse(JSON.stringify(props.mitraList))
        : []
);

watch(
    () => props.mitraList,
    (newList) => {
        if (newList) {
            items.value = JSON.parse(JSON.stringify(newList));
        }
    },
    { deep: true }
);

// State Modals
const showAddModal = ref(false);
const showEditModal = ref(false);
const editingMitra = ref<MitraItem | null>(null);

// Form Tambah
const newForm = useForm({
    nama: '',
    kategori: '',
    tipe_ikon: 'community',
    logo: null as File | null,
    aktif: true,
});

const onNewLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        newForm.logo = target.files[0];
    }
};

const submitNew = () => {
    newForm.post('/admin/mitra', {
        preserveScroll: true,
        onSuccess: () => {
            showAddModal.value = false;
            newForm.reset();
            alert('Mitra kerja baru berhasil ditambahkan!');
        },
    });
};

// Form Edit
const editForm = useForm({
    nama: '',
    kategori: '',
    tipe_ikon: 'community',
    logo: null as File | null,
    aktif: true,
});

const openEditModal = (mitra: MitraItem) => {
    editingMitra.value = mitra;
    editForm.nama = mitra.nama;
    editForm.kategori = mitra.kategori;
    editForm.tipe_ikon = mitra.tipe_ikon || 'community';
    editForm.logo = null;
    editForm.aktif = Boolean(mitra.aktif);
    showEditModal.value = true;
};

const onEditLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        editForm.logo = target.files[0];
    }
};

const submitEdit = () => {
    if (!editingMitra.value) return;

    editForm.post(`/admin/mitra/${editingMitra.value.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            showEditModal.value = false;
            editingMitra.value = null;
            editForm.reset();
            alert('Perubahan data mitra berhasil disimpan!');
        },
    });
};

const deleteMitra = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus mitra ini?')) return;

    router.delete(`/admin/mitra/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            items.value = items.value.filter(m => m.id !== id);
            alert('Mitra kerja berhasil dihapus.');
        },
    });
};

// Pilihan Ikon Preset Bawaan
const iconPresets = [
    { value: 'pemda', label: 'Pemerintah / Pemda' },
    { value: 'dinsos', label: 'Dinas Sosial / Yayasan' },
    { value: 'hospital', label: 'Rumah Sakit / Kesehatan' },
    { value: 'community', label: 'Komunitas / Relawan' },
    { value: 'csr', label: 'Perusahaan / CSR' },
    { value: 'baznas', label: 'BAZNAS / Lembaga Zakat' },
    { value: 'kitabisa', label: 'Platform Donasi / Solidaritas' },
    { value: 'pmi', label: 'PMI / Kemanusiaan' },
];
</script>

<template>
    <Head title="Manajemen Mitra Kerja | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            <!-- Informasi Panduan -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" /><path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Mitra Kerja & Kolaborasi</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Kelola instansi pemerintah, rumah sakit, lembaga amal, donatur perusahaan, dan mitra strategis yang ditampilkan pada carousel beranda publik <strong>"Mitra Kerja & Kolaborasi Kami"</strong>.
                    </p>
                </div>
            </div>

            <!-- Modal Tambah Mitra -->
            <div v-if="showAddModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Tambah Mitra Baru</h3>
                    
                    <form @submit.prevent="submitNew" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Mitra / Instansi</label>
                            <input v-model="newForm.nama" type="text" required placeholder="Contoh: BAZNAS atau RSUD Sumedang" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori / Peran Sinergi</label>
                            <input v-model="newForm.kategori" type="text" required placeholder="Contoh: Badan Amil Zakat atau Layanan Medis" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pilihan Ikon Preset (Fallback)</label>
                            <select v-model="newForm.tipe_ikon" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium text-sm">
                                <option v-for="preset in iconPresets" :key="preset.value" :value="preset.value">
                                    {{ preset.label }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Upload Berkas Logo (Opsional)</label>
                            <input type="file" accept="image/*" @change="onNewLogoChange" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <p class="text-3xs text-gray-400 mt-1">Jika diunggah, logo gambar kustom ini akan diprioritaskan.</p>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <input type="checkbox" id="addAktif" v-model="newForm.aktif" class="w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-500" />
                            <label for="addAktif" class="text-xs font-bold text-gray-700">Tampilkan di Halaman Beranda (Status Aktif)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="showAddModal = false" class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100 text-sm">Batal</button>
                            <button type="submit" :disabled="newForm.processing" class="px-6 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md text-sm">Simpan Mitra</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Mitra -->
            <div v-if="showEditModal && editingMitra" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Edit Data Mitra</h3>
                    
                    <form @submit.prevent="submitEdit" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Mitra / Instansi</label>
                            <input v-model="editForm.nama" type="text" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori / Peran Sinergi</label>
                            <input v-model="editForm.kategori" type="text" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pilihan Ikon Preset (Fallback)</label>
                            <select v-model="editForm.tipe_ikon" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-medium text-sm">
                                <option v-for="preset in iconPresets" :key="preset.value" :value="preset.value">
                                    {{ preset.label }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ganti Berkas Logo (Opsional)</label>
                            <input type="file" accept="image/*" @change="onEditLogoChange" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <div v-if="editingMitra.logo" class="mt-2 flex items-center gap-2">
                                <span class="text-3xs text-gray-400">Logo saat ini:</span>
                                <img :src="editingMitra.logo" class="h-6 w-auto object-contain" />
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <input type="checkbox" id="editAktif" v-model="editForm.aktif" class="w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-500" />
                            <label for="editAktif" class="text-xs font-bold text-gray-700">Tampilkan di Halaman Beranda (Status Aktif)</label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="showEditModal = false" class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100 text-sm">Batal</button>
                            <button type="submit" :disabled="editForm.processing" class="px-6 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md text-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar Mitra Card Grid -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Mitra Aktif & Sinergi</h2>
                        <p class="text-xs text-gray-500 mt-1">Total {{ items.length }} mitra yang terdaftar dalam sistem</p>
                    </div>
                    <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md transition-all flex items-center gap-2 text-sm">
                        + Tambah Mitra Baru
                    </button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div 
                        v-for="mitra in items" 
                        :key="mitra.id" 
                        class="p-5 border border-gray-200 rounded-2xl flex flex-col justify-between relative group bg-white hover:border-teal-300 hover:shadow-md transition-all"
                    >
                        <!-- Header Card & Actions -->
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <!-- Logo / Icon Preview -->
                            <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center p-2 shrink-0">
                                <img v-if="mitra.logo" :src="mitra.logo" :alt="mitra.nama" class="w-full h-full object-contain" />
                                <div v-else class="text-teal-600 font-black text-sm uppercase">
                                    {{ (mitra.tipe_ikon || mitra.nama.substring(0, 2)).toUpperCase() }}
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-1">
                                <button 
                                    @click="openEditModal(mitra)" 
                                    type="button" 
                                    class="p-2 text-gray-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors"
                                    title="Edit Data"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                </button>
                                <button 
                                    @click="deleteMitra(mitra.id)" 
                                    type="button" 
                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Hapus Mitra"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Info Detail -->
                        <div>
                            <h4 class="font-bold text-gray-900 text-base leading-snug">{{ mitra.nama }}</h4>
                            <p class="text-xs text-gray-500 font-medium mt-1">{{ mitra.kategori }}</p>
                        </div>

                        <!-- Footer Card: Status Aktif -->
                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                            <span 
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-3xs font-bold"
                                :class="mitra.aktif ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-600'"
                            >
                                <span class="w-1.5 h-1.5 rounded-full" :class="mitra.aktif ? 'bg-emerald-500' : 'bg-gray-400'"></span>
                                {{ mitra.aktif ? 'Ditampilkan' : 'Disembunyikan' }}
                            </span>
                            <span class="text-3xs text-gray-400 font-mono">
                                Ikon: {{ mitra.tipe_ikon || '-' }}
                            </span>
                        </div>
                    </div>

                    <div v-if="items.length === 0" class="col-span-full text-center py-12 text-gray-400">
                        Belum ada mitra kerja yang terdaftar. Klik "+ Tambah Mitra Baru" untuk menambahkan.
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
