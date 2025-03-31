<script setup>
import { useAmenityStore } from '@/stores/admin/maintenance/useAmenityStore.js';
const { fnFetch } = useAmenityStore();
const { error, processing } = storeToRefs(useAmenityStore());

onMounted(async () => {
    await fnFetch();
});
</script>

<template>
    <div class="grid grid-cols-12 gap-8"></div>
</template>
