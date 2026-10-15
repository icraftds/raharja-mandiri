<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col fixed left-0 top-0 bottom-0 z-40 select-none">
        <div class="p-5 border-b border-gray-800">
            <h2 class="text-xl font-black tracking-widest text-teal-400">ADMIN<span class="text-white">PANEL</span></h2>
            <p class="text-xs text-gray-400 mt-0.5">PSRM Raharja Mandiri</p>
        </div>
        <nav class="flex-grow p-3 space-y-1 overflow-y-auto">
            <div class="px-3 pt-2 pb-1">
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Halaman Publik</span>
            </div>
            
            <Link href="/admin/dashboard" :class="[
                'flex items-center justify-between px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/dashboard' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    Hero Section
                </div>
                <div v-if="$page.url === '/admin/dashboard'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>
            
            <Link href="/admin/sejarah" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/sejarah' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                    Sejarah
                </div>
                <div v-if="$page.url === '/admin/sejarah'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>
            
            <Link href="/admin/visi-misi" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/visi-misi' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" /></svg>
                    Visi & Misi
                </div>
                <div v-if="$page.url === '/admin/visi-misi'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/kepengurusan" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/kepengurusan' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                    Kepengurusan
                </div>
                <div v-if="$page.url === '/admin/kepengurusan'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/mitra" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url.startsWith('/admin/mitra') ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.999-3.199a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    Mitra Kerja
                </div>
                <div v-if="$page.url.startsWith('/admin/mitra')" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/galeri" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/galeri' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    Galeri
                </div>
                <div v-if="$page.url === '/admin/galeri'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/artikel" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url.startsWith('/admin/artikel') ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>
                    Artikel & Berita
                </div>
                <div v-if="$page.url.startsWith('/admin/artikel')" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/rekening" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/rekening' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                    Rekening Donasi
                </div>
                <div v-if="$page.url === '/admin/rekening'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/kebutuhan" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/kebutuhan' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    Kebutuhan Donasi
                </div>
                <div v-if="$page.url === '/admin/kebutuhan'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/kontak" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/kontak' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h13.5A2.25 2.25 0 0120.25 4.5v13.5A2.25 2.25 0 0118 20.25H4.5z" /></svg>
                    Informasi Kontak
                </div>
                <div v-if="$page.url === '/admin/kontak'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <div class="px-3 pt-3 pb-1">
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Interaksi Pengunjung</span>
            </div>

            <Link href="/admin/pesan" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url === '/admin/pesan' ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                    Pesan Masuk
                </div>
                <div v-if="$page.url === '/admin/pesan'" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>

            <Link href="/admin/pengunjung" :class="[
                'flex items-center justify-between gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors',
                $page.url.startsWith('/admin/pengunjung') ? 'text-teal-400 bg-teal-500/10 font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'
            ]">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                    Pengunjung Website
                </div>
                <div v-if="$page.url.startsWith('/admin/pengunjung')" class="w-1.5 h-1.5 rounded-full bg-teal-400"></div>
            </Link>
        </nav>
        
        <div class="p-3 border-t border-gray-800">
            <Link href="/admin/logout" method="post" as="button" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-red-400 text-sm font-medium hover:bg-red-500/10 transition-colors w-full text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                Logout
            </Link>
        </div>
    </aside>
</template>
