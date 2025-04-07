<script setup>
import { useDashboardStore } from '@/stores/managementRental/useDashboardStore.js';
const { loginUser, registerUser, clearError, check, checktoggle } = useDashboardStore();
const { error, processing } = storeToRefs(useDashboardStore());
</script>

<template>
    <div class="grid grid-cols-12 gap-8"></div>
</template>
