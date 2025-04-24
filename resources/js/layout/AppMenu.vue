<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Portfolio',
        meta: 'user',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/portfolio/dashboard', meta: 'user' },
            { label: 'Assets', icon: 'pi pi-fw pi-home', to: '/portfolio/asset', meta: 'user' },
            { label: 'Analytics', icon: 'pi pi-fw pi-home', to: '/portfolio/analytics', meta: 'user' },
            { label: 'Transactions', icon: 'pi pi-fw pi-home', to: '/portfolio/transaction', meta: 'user' }
        ]
    },
    {
        label: 'Profile',
        meta: 'user',
        items: [
            { label: 'About Me', icon: 'pi pi-fw pi-home', to: '/profile/about-me', meta: 'user' },
            { label: 'Security', icon: 'pi pi-fw pi-home', to: '/profile/security', meta: 'user' },
            { label: 'Verification (KYC)', icon: 'pi pi-fw pi-home', to: '/profile/verification', meta: 'user' }
        ]
    },
    {
        label: 'Finance',
        meta: 'user',
        items: [
            { label: 'Deposit', icon: 'pi pi-fw pi-home', to: '/finance/deposit', meta: 'user' },
            { label: 'Withdraw', icon: 'pi pi-fw pi-home', to: '/finance/withdraw', meta: 'user' },
            { label: 'Transfer Log', icon: 'pi pi-fw pi-home', to: '/finance/transfer-log', meta: 'user' }
        ]
    },
    {
        label: 'Affiliate',
        meta: 'user',
        items: [
            { label: 'Registrations', icon: 'pi pi-fw pi-home', to: '/affiliate/registration', meta: 'user' },
            { label: 'Commission (USD)', icon: 'pi pi-fw pi-home', to: '/affiliate/commission', meta: 'user' },
            { label: 'Rate (10%)', icon: 'pi pi-fw pi-home', to: '/affiliate/rate', meta: 'user' },
            { label: 'Available For Withdrawal', icon: 'pi pi-fw pi-home', to: '/affiliate/available-withdraw', meta: 'user' },
            { label: 'Transfer to Trading Account', icon: 'pi pi-fw pi-home', to: '/affiliate/transfer-trading-account', meta: 'user' }
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
