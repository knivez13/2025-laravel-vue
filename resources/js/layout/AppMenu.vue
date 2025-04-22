<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Portfolio',
        meta: 'user',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Assets', icon: 'pi pi-fw pi-home', to: '/manage-rental/my-listing', meta: 'user' },
            { label: 'Analytics', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' },
            { label: 'Transactions', icon: 'pi pi-fw pi-home', to: '/manage-rental/message', meta: 'user' }
        ]
    },
    {
        label: 'Profile',
        meta: 'user',
        items: [
            { label: 'About Me', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Security', icon: 'pi pi-fw pi-home', to: '/manage-rental/my-listing', meta: 'user' },
            { label: 'Verification (KYC)', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' }
        ]
    },
    {
        label: 'Finance',
        meta: 'user',
        items: [
            { label: 'Deposit', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Withdraw', icon: 'pi pi-fw pi-home', to: '/manage-rental/my-listing', meta: 'user' },
            { label: 'History Transfer', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' }
        ]
    },
    {
        label: 'Affiliate',
        meta: 'user',
        items: [
            { label: 'Registrations', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Commission (USD)', icon: 'pi pi-fw pi-home', to: '/manage-rental/my-listing', meta: 'user' },
            { label: 'Rate (10%)', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' },
            { label: 'Available For Withdrawal', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' },
            { label: 'Transfer to Trading Account', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' }
        ]
    }
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
