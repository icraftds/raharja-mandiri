<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="bg-gray-900 text-gray-300 pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-5 gap-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <Link href="/" class="group flex items-center gap-3">
                        <img 
                            src="/logo_raharja.png" 
                            alt="Logo Raharja Mandiri" 
                            class="h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-105" 
                        />
                        <span class="font-bold text-2xl text-white leading-none group-hover:text-blue-400 transition-colors">Raharja Mandiri</span>
                    </Link>
                </div>
                <p class="text-gray-400 mb-6 max-w-sm">
                    Membangun generasi mandiri, berakhlak mulia, dan bermanfaat bagi sesama. Rumah kedua penuh kasih sayang bagi anak-anak yang membutuhkan di Tanjungsari, Sumedang.
                </p>
                <div class="flex gap-4">
                    <a :href="($page.props.pengaturanGlobal as any)?.kontak_instagram_url || 'https://www.instagram.com/psrm_raharja_mandiri/'" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Tautan Cepat</h4>
                <ul class="space-y-3">
                    <li><Link href="/tentang/visi-misi" class="hover:text-blue-400 transition-colors">Tentang Kami</Link></li>
                    <li><Link href="/galeri" class="hover:text-blue-400 transition-colors">Galeri Kegiatan</Link></li>
                    <li><Link href="/artikel" class="hover:text-blue-400 transition-colors">Laporan & Berita</Link></li>
                    <li><Link href="/donasi/rekening" class="hover:text-blue-400 transition-colors">Donasi Sekarang</Link></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Legalitas & Izin</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="leading-relaxed">
                        <strong class="text-gray-300 block mb-1">Akta Pendirian:</strong>
                        {{ ($page.props.pengaturanGlobal as any)?.kontak_legalitas_akta || 'C-1051.HT.01.02.TH 2004' }}
                    </li>
                    <li class="leading-relaxed">
                        <strong class="text-gray-300 block mb-1">Tanda Daftar Yayasan:</strong>
                        {{ ($page.props.pengaturanGlobal as any)?.kontak_legalitas_tanda_daftar || '02/27.1BY.1/31.74/2019' }}
                    </li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500 shrink-0 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="text-sm">{{ ($page.props.pengaturanGlobal as any)?.kontak_alamat || 'Tanjungsari, Kabupaten Sumedang, Jawa Barat' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <span class="text-sm">{{ ($page.props.pengaturanGlobal as any)?.kontak_telepon || '+62 813-2210-1618' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span class="text-sm">{{ ($page.props.pengaturanGlobal as any)?.kontak_email || 'psrm@raharjamandiri.org' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Massive Sponsorship Logo (Replacing the giant font) -->
        <div class="mt-20 w-full flex flex-col items-center justify-center overflow-hidden px-4 pb-8 group">
            <span class="text-sm text-gray-500 mb-6 font-medium tracking-widest uppercase opacity-60 group-hover:opacity-100 transition-opacity duration-500">
                Didukung oleh
            </span>
            <img src="/assets/images/logo_iCraft.png" alt="iCraft Logo" class="w-[13vw] max-w-4xl object-contain opacity-30 group-hover:opacity-100 filter grayscale group-hover:grayscale-0 transition-all duration-700 transform group-hover:scale-105" />
        </div>

        <!-- Very Bottom Bar -->
        <div class="border-t border-gray-800/60 py-8 w-full mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-gray-500">&copy; 2026 Panti Sosial Raharja Mandiri. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>
