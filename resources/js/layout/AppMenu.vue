<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Manage Rental',
        meta: 'user',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/manage-rental/dashboard', meta: 'user' },
            { label: 'My Listing', icon: 'pi pi-fw pi-home', to: '/manage-rental/my-listing', meta: 'user' },
            { label: 'Create Property', icon: 'pi pi-fw pi-home', to: '/manage-rental/create-property', meta: 'user' },
            { label: 'Message', icon: 'pi pi-fw pi-home', to: '/manage-rental/message', meta: 'user' },
            { label: 'Subcription', icon: 'pi pi-fw pi-home', to: '/manage-rental/subscription', meta: 'user' },
            { label: 'Favorites', icon: 'pi pi-fw pi-home', to: '/manage-rental/favorites', meta: 'user' },
            { label: 'Save', icon: 'pi pi-fw pi-home', to: '/manage-rental/save', meta: 'user' }
        ]
    },
    {
        label: 'Admin',
        meta: 'user',
        items: [
            {
                label: 'Dashboard',
                icon: 'pi pi-fw pi-globe',
                to: '/admin/dashboard',
                meta: 'user'
            },
            { label: 'Message', icon: 'pi pi-fw pi-home', to: '/admin/message', meta: 'user' },

            {
                label: 'Property Management',
                icon: 'pi pi-fw pi-user',
                meta: 'user',
                items: [
                    {
                        label: 'Property List',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/admin/property-management/property-list',
                        meta: 'user'
                    },
                    {
                        label: 'For Approval',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/property-management/for-approval',
                        meta: 'user'
                    },
                    {
                        label: 'Active',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/property-management/active',
                        meta: 'user'
                    },
                    {
                        label: 'Reject',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/property-management/reject',
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
                        to: '/admin/maintenance/amenity',
                        meta: 'user'
                    },
                    {
                        label: 'Appliances',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/maintenance/appliances',
                        meta: 'user'
                    },
                    {
                        label: 'File Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/file-type',
                        meta: 'user'
                    },
                    {
                        label: 'Mode of Payment',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/mode-of-payment',
                        meta: 'user'
                    },
                    {
                        label: 'Price Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/price-type',
                        meta: 'user'
                    },
                    {
                        label: 'Property Category',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/property-category',
                        meta: 'user'
                    },
                    {
                        label: 'Property Condition',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/property-condition',
                        meta: 'user'
                    },
                    {
                        label: 'Property Listing Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/property-listing-type',
                        meta: 'user'
                    },
                    {
                        label: 'Property Type',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/property-type',
                        meta: 'user'
                    },
                    {
                        label: 'Property Status',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/property-status',
                        meta: 'user'
                    },
                    {
                        label: 'Utility Included',
                        icon: 'pi pi-fw pi-lock',
                        to: '/admin/maintenance/utility-included',
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
                        to: '/admin/user-management/user-list',
                        meta: 'user'
                    },
                    {
                        label: 'Role',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/user-management/role',
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
                        to: '/admin/subscription-management/user-subscription',
                        meta: 'user'
                    },
                    {
                        label: 'Expired this Month',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/subscription-management/expired-month',
                        meta: 'user'
                    },
                    {
                        label: 'For Approval',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/subscription-management/for-approval',
                        meta: 'user'
                    },
                    {
                        label: 'Subscription Type',
                        icon: 'pi pi-fw pi-times-circle',
                        to: '/admin/subscription-management/subscription-type',
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
