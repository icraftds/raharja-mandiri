<script setup lang="ts">
import Sidebar from './Sidebar.vue';
import Topbar from './Topbar.vue';
</script>
<template>
    <div class="min-h-screen bg-gray-50 flex">
        <Sidebar />
        <div class="flex-grow ml-64 flex flex-col min-h-screen">
            <Topbar />
            <main class="flex-grow p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
