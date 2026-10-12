<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Login Admin | CMS Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="p-10 border-b border-gray-100 text-center bg-gray-900 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500/20 to-blue-500/20"></div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-black tracking-widest text-teal-400 mb-2">CMS<span class="text-white">PANEL</span></h1>
                    <p class="text-gray-400 text-sm">Sistem Manajemen Konten Website</p>
                </div>
            </div>
            
            <div class="p-10 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username / Email</label>
                    <input type="text" value="admin@raharjamandiri.org" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all text-gray-800" />
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input type="password" value="rahasia123" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all text-gray-800" />
                </div>
                
                <div class="pt-4">
                    <Link href="/admin/dashboard" class="flex justify-center items-center w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-center shadow-lg hover:shadow-teal-500/30 hover:-translate-y-1 transition-all">
                        Masuk ke Dashboard
                    </Link>
                </div>
                
                <p class="text-xs text-center text-gray-400 mt-6">
                    Akses ini terbatas hanya untuk pengurus yayasan.
                </p>
            </div>
        </div>
    </div>
</template>
