<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Home',
        items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' }]
    },
    {
        label: 'UI Components',
        items: [
            { label: 'Form Layout', icon: 'pi pi-fw pi-id-card', to: '/uikit/formlayout', meta: 'user' },
            { label: 'Input', icon: 'pi pi-fw pi-check-square', to: '/uikit/input', meta: 'user' },
            { label: 'Button', icon: 'pi pi-fw pi-mobile', to: '/uikit/button', class: 'rotated-icon', meta: 'user' },
            { label: 'Table', icon: 'pi pi-fw pi-table', to: '/uikit/table', meta: 'user' },
            { label: 'List', icon: 'pi pi-fw pi-list', to: '/uikit/list', meta: 'user' },
            { label: 'Tree', icon: 'pi pi-fw pi-share-alt', to: '/uikit/tree', meta: 'user' },
            { label: 'Panel', icon: 'pi pi-fw pi-tablet', to: '/uikit/panel', meta: 'user' },
            { label: 'Overlay', icon: 'pi pi-fw pi-clone', to: '/uikit/overlay', meta: 'user' },
            { label: 'Media', icon: 'pi pi-fw pi-image', to: '/uikit/media', meta: 'user' },
            { label: 'Menu', icon: 'pi pi-fw pi-bars', to: '/uikit/menu', meta: 'user' },
            { label: 'Message', icon: 'pi pi-fw pi-comment', to: '/uikit/message', meta: 'user' },
            { label: 'File', icon: 'pi pi-fw pi-file', to: '/uikit/file', meta: 'user' },
            { label: 'Chart', icon: 'pi pi-fw pi-chart-bar', to: '/uikit/charts', meta: 'user' },
            { label: 'Timeline', icon: 'pi pi-fw pi-calendar', to: '/uikit/timeline', meta: 'user' },
            { label: 'Misc', icon: 'pi pi-fw pi-circle', to: '/uikit/misc', meta: 'user' }
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
