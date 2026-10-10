<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
</script>

<template>
    <Head title="Hubungi Kami | PSRM Raharja Mandiri" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-800">
        <Navbar />
        
        <div class="relative pt-40 pb-32 bg-blue-900 overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern-bg" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern-bg)" />
                </svg>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight animate-fade-in-up">Hubungi Kami</h1>
                <p class="text-lg text-blue-200 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.1s;">
                    Pintu kami selalu terbuka untuk Anda. Silakan hubungi kami atau kunjungi langsung panti sosial kami.
                </p>
            </div>
        </div>

        <main class="flex-grow -mt-20 relative z-20 pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Info Panel -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                            
                            <div class="space-y-8 mb-10">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Alamat Lengkap</h4>
                                        <p class="text-gray-600 leading-relaxed">Tanjungsari, Kabupaten Sumedang<br/>Jawa Barat, 45362</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Telepon & WhatsApp</h4>
                                        <p class="text-gray-600 leading-relaxed">+62 813-2210-1618<br/>Senin - Minggu (08:00 - 17:00)</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Email</h4>
                                        <p class="text-gray-600 leading-relaxed">psrm@raharjamandiri.org</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Instagram</h4>
                                        <a href="https://www.instagram.com/psrm_raharja_mandiri/?hl=id" target="_blank" class="text-blue-600 hover:text-blue-700 leading-relaxed font-medium">@psrm_raharja_mandiri</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Maps Placeholder -->
                        <div class="w-full h-48 bg-gray-200 rounded-2xl overflow-hidden relative group">
                            <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Peta Lokasi" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <a href="https://maps.google.com/?q=Tanjungsari+Sumedang" target="_blank" class="px-6 py-2 bg-white text-gray-900 rounded-full font-bold shadow-lg hover:shadow-xl transition-all">Buka di Maps</a>
                            </div>
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirimkan Pesan</h2>
                        <form @submit.prevent class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" placeholder="Masukkan nama Anda" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email / Telepon</label>
                                <input type="text" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" placeholder="Alamat email atau nomor WA" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pesan Anda</label>
                                <textarea rows="4" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none resize-none" placeholder="Apa yang ingin Anda sampaikan?"></textarea>
                            </div>
                            <button class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-blue-700 transition-colors shadow-lg hover:shadow-blue-500/30">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </main>
        
        <Footer />
    </div>
</template>

<style scoped>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
</style>
