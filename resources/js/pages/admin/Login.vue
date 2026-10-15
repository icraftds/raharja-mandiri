<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: 'admin@raharjamandiri.org',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/admin/login', {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Login Admin | CMS Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="p-10 border-b border-gray-100 text-center bg-gray-900 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500/20 to-blue-500/20"></div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-black tracking-widest text-teal-400 mb-2">ADMIN<span class="text-white">PANEL</span></h1>
                    <p class="text-gray-400 text-sm">Sistem Manajemen Konten Website</p>
                </div>
            </div>
            
            <form @submit.prevent="submit" class="p-10 space-y-6">
                <!-- Alert Error -->
                <div v-if="form.errors.email || form.errors.password" class="p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-medium">
                    {{ form.errors.email || form.errors.password }}
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Admin</label>
                    <input 
                        v-model="form.email" 
                        type="email" 
                        required 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all text-gray-800" 
                        placeholder="admin@raharjamandiri.org" 
                    />
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input 
                        v-model="form.password" 
                        type="password" 
                        required 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all text-gray-800" 
                        placeholder="••••••••" 
                    />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer text-gray-600">
                        <input v-model="form.remember" type="checkbox" class="rounded text-teal-600 focus:ring-teal-500" />
                        <span>Ingat Saya</span>
                    </label>
                </div>
                
                <div class="pt-2">
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="flex justify-center items-center w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-center shadow-lg hover:shadow-teal-500/30 hover:-translate-y-1 transition-all disabled:opacity-50"
                    >
                        <span v-if="form.processing">Memproses...</span>
                        <span v-else>Masuk ke Dashboard</span>
                    </button>
                </div>
                
                <p class="text-xs text-center text-gray-400 mt-6">
                    Akses ini terbatas hanya untuk pengurus resmi panti asuhan.
                </p>
            </form>
        </div>
    </div>
</template>
