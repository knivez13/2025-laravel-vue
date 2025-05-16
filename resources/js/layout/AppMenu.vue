<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Menu',
        meta: 'user',
        items: [
            { label: 'Home', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            // { label: 'Live Casino', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            // { label: 'Scatter Game', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            // { label: 'Lotto', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            // { label: 'Sabong', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            // { label: 'Sports Betting', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Betting History', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'Transaction', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' }
        ]
    },
    {
        label: 'Management',
        meta: 'user',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/admin/dashboard', meta: 'user' },
            { label: 'Earnings', icon: 'pi pi-fw pi-home', to: '/admin/earning', meta: 'user' },
            { label: 'Live Games', icon: 'pi pi-fw pi-home', to: '/admin/liveGames', meta: 'user' },
            { label: 'Agent & Player', icon: 'pi pi-fw pi-home', to: '/admin/agentPlayer', meta: 'user' },
            {
                label: 'Maintenance',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    { label: 'Game Present', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/gamePresent', meta: 'user' },
                    { label: 'Game Option', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/GameOption', meta: 'user' },
                    { label: 'Game Announcement', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/gamePresentAnnouncement', meta: 'user' },
                    { label: 'Game Videos', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/gameVideo', meta: 'user' },
                    { label: 'Game Type', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/gameType', meta: 'user' },
                    { label: 'Agent Type', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/agentType', meta: 'user' },
                    { label: 'Video Type', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/videoType', meta: 'user' },
                    { label: 'Bank Type', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/bankType', meta: 'user' },
                    { label: 'Game Provider', icon: 'pi pi-fw pi-home', to: '/admin/maintenance/provider', meta: 'user' }
                ]
            }
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
