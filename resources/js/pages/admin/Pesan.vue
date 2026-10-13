<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../components/admin/AdminLayout.vue';

interface PesanItem {
    id: number;
    nama: string;
    kontak: string;
    pesan: string;
    sudah_dibaca: boolean;
    created_at: string;
}

const props = defineProps<{
    messageList?: PesanItem[];
}>();

const markAsRead = (id: number) => {
    router.patch(`/admin/pesan/${id}/dibaca`, {}, {
        preserveScroll: true,
    });
};

const deleteMessage = (id: number) => {
    if (!confirm('Apakah Anda yakin ingin menghapus pesan ini?')) return;

    router.delete(`/admin/pesan/${id}`, {
        preserveScroll: true,
        onSuccess: () => alert('Pesan berhasil dihapus.'),
    });
};

const formatDate = (dateStr: string) => {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};
</script>

<template>
    <Head title="Kotak Masuk Pesan | CMS" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl flex items-start gap-4 shadow-sm">
                <div class="text-blue-500 mt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" /><path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" /></svg>
                </div>
                <div>
                    <h3 class="text-blue-800 font-bold text-lg mb-1">Kotak Masuk Pesan Pengunjung</h3>
                    <p class="text-blue-600 leading-relaxed text-sm">
                        Daftar pesan, pertanyaan, atau permohonan informasi yang dikirimkan oleh masyarakat melalui formulir pada halaman <strong>Hubungi Kami</strong>.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Pesan Masuk ({{ props.messageList?.length || 0 }})</h2>
                </div>
                
                <div v-if="!props.messageList || props.messageList.length === 0" class="p-16 text-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto mb-4 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                    <p class="text-lg font-bold text-gray-600">Belum ada pesan masuk</p>
                    <p class="text-sm mt-1">Pesan yang dikirim pengunjung melalui form kontak akan tampil di sini.</p>
                </div>

                <div v-else class="divide-y divide-gray-100">
                    <div v-for="item in props.messageList" :key="item.id" :class="['p-8 transition-colors flex flex-col md:flex-row gap-6 justify-between items-start', item.sudah_dibaca ? 'bg-white' : 'bg-teal-50/30']">
                        <div class="space-y-2 flex-grow">
                            <div class="flex items-center gap-3">
                                <h3 class="font-bold text-gray-900 text-lg">{{ item.nama }}</h3>
                                <span v-if="!item.sudah_dibaca" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-teal-500 text-white uppercase tracking-wider">Baru</span>
                                <span class="text-xs text-gray-400 font-medium">{{ formatDate(item.created_at) }}</span>
                            </div>

                            <p class="text-sm font-semibold text-blue-600">Kontak: {{ item.kontak }}</p>

                            <p class="text-gray-700 text-base leading-relaxed pt-2 whitespace-pre-wrap">{{ item.pesan }}</p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0 pt-2 md:pt-0">
                            <button v-if="!item.sudah_dibaca" @click="markAsRead(item.id)" type="button" class="px-4 py-2 bg-teal-100 text-teal-800 rounded-xl text-xs font-bold hover:bg-teal-200 transition-colors">
                                Tandai Dibaca
                            </button>
                            <button @click="deleteMessage(item.id)" type="button" class="p-2 text-red-400 hover:text-red-600 rounded-xl hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
