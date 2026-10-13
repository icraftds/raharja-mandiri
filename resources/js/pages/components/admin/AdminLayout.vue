<script setup lang="ts">
import Sidebar from './Sidebar.vue';
import Topbar from './Topbar.vue';
import FooterAdmin from './FooterAdmin.vue';
</script>
<template>
    <div class="min-h-screen bg-gray-50 flex overflow-x-hidden w-full max-w-full">
        <Sidebar />
        <div class="flex-grow ml-64 flex flex-col min-h-screen min-w-0 max-w-[calc(100vw-16rem)] overflow-x-hidden">
            <Topbar />
            <main class="flex-grow p-4 sm:p-6 lg:p-8 w-full min-w-0 max-w-full overflow-x-hidden">
                <slot />
            </main>
            <FooterAdmin />
        </div>
    </div>
</template>
