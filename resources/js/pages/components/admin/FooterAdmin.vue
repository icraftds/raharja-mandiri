<script setup lang="ts">
const currentYear = new Date().getFullYear();
</script>

<template>
    <footer class="mt-auto bg-white border-t border-gray-100 px-8 py-4">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
            <p>© {{ currentYear }} Yayasan Raharja Mandiri. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-2">
                <span class="font-medium text-gray-600">Website Supported by</span>
                <img 
                    src="/assets/images/logo_iCraft.png" 
                    alt="iCraft Logo" 
                    class="h-5 w-auto object-contain transition-transform duration-200 hover:scale-105" 
                />
            </div>
        </div>
    </footer>
</template>
