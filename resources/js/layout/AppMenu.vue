<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Manage Rental',
        meta: 'user',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },
            { label: 'My Listing', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },
            { label: 'Create Property', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },
            { label: 'Message', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },
            { label: 'Subcription', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },
            { label: 'Favorites', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' }
        ]
    },
    {
        label: 'Admin',
        meta: 'user',
        items: [
            {
                label: 'Dashboard',
                icon: 'pi pi-fw pi-globe',
                to: '/landing',
                meta: 'user'
            },
            { label: 'Message', icon: 'pi pi-fw pi-home', to: '/', meta: 'user' },

            {
                label: 'Property Management',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    {
                        label: 'Property List',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/auth/login',
                        meta: 'user'
                    },
                    {
                        label: 'For Approval',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    },
                    {
                        label: 'Active',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    },
                    {
                        label: 'Reject',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    }
                ]
            },
            {
                label: 'Maintenance',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    {
                        label: 'Amenity',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/auth/login',
                        meta: 'user'
                    },
                    {
                        label: 'Appliances',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    },
                    {
                        label: 'File Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    },
                    {
                        label: 'Mode of Payment',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    },
                    {
                        label: 'Price Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    },
                    {
                        label: 'Property Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    },
                    {
                        label: 'Property Status',
                        icon: 'pi pi-fw pi-lock',
                        to: '/auth/access',
                        meta: 'user'
                    }
                ]
            },
            {
                label: 'User Management',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    {
                        label: 'User List',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/auth/login',
                        meta: 'user'
                    },
                    {
                        label: 'Role',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    }
                ]
            },
            {
                label: 'Subscription Management',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    {
                        label: 'User Subscription',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/auth/login',
                        meta: 'user'
                    },
                    {
                        label: 'Expired this Month',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    },
                    {
                        label: 'For Approval',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    },
                    {
                        label: 'Subscription Type',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/auth/error',
                        meta: 'user'
                    }
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
