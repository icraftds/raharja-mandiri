<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';
import { ref } from 'vue';

interface Person {
    id: number;
    nama: string;
    jabatan: string;
    foto?: string;
}

const props = defineProps<{
    teamList?: Person[];
}>();

const showAddModal = ref(false);
const newForm = useForm({
    nama: '',
    jabatan: '',
    foto: null as File | null,
});

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        newForm.foto = target.files[0];
    }
};

const submitNew = () => {
    newForm.post('/admin/kepengurusan', {
        onSuccess: () => {
            showAddModal.value = false;
            newForm.reset();
            alert('Pengurus baru berhasil ditambahkan!');
        },
    });
};

const deletePerson = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus data pengurus ini?')) return;

    router.delete(`/admin/kepengurusan/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Data pengurus berhasil dihapus.');
        },
    });
};
</script>

<template>
    <Head title="Manajemen Kepengurusan | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Manajemen Struktur Kepengurusan</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Kelola data <strong>Ketua, Sekretaris, Bendahara, dan Pengurus lainnya</strong>. Tambahkan foto resmi, nama, dan jabatannya untuk memperbarui halaman publik secara instan.
                    </p>
                </div>
            </div>

            <!-- Modal Tambah Pengurus -->
            <div v-if="showAddModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-gray-900">Tambah Anggota Pengurus Baru</h3>
                    
                    <form @submit.prevent="submitNew" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap & Gelar</label>
                            <input v-model="newForm.nama" type="text" required placeholder="Contoh: H. Ahmad Sudirman, M.Ag" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 font-bold" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jabatan / Posisi</label>
                            <input v-model="newForm.jabatan" type="text" required placeholder="Contoh: Ketua Yayasan" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Foto Formal</label>
                            <input type="file" accept="image/*" @change="onFileChange" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="showAddModal = false" class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100">Batal</button>
                            <button type="submit" :disabled="newForm.processing" class="px-6 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Editor -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Pengurus Yayasan</h2>
                    <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition-colors text-sm shadow-md">
                        + Tambah Pengurus
                    </button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="person in props.teamList" :key="person.id" class="border border-gray-200 p-6 rounded-2xl relative group bg-white shadow-xs">
                        <button @click="deletePerson(person.id)" type="button" class="absolute top-4 right-4 text-red-400 hover:text-red-600 z-10 bg-white/90 hover:bg-red-50 rounded-full w-9 h-9 flex items-center justify-center shadow transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>

                        <div class="w-full h-48 bg-gray-100 rounded-xl mb-4 overflow-hidden relative shadow-inner">
                            <img v-if="person.foto" :src="person.foto" :alt="person.nama" class="w-full h-full object-cover" />
                            <div v-else class="w-full h-full flex items-center justify-center text-gray-400 font-bold">Foto Belum Ada</div>
                        </div>

                        <div class="space-y-1">
                            <h4 class="font-extrabold text-gray-900 text-lg leading-tight">{{ person.nama }}</h4>
                            <p class="text-teal-600 font-bold text-sm uppercase tracking-wider">{{ person.jabatan }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
