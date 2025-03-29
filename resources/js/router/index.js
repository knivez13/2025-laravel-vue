import AppLayout from '@/layout/AppLayout.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/useAuthStore.js';

// Landing Page Routes
const landingRoutes = [
    { path: '', meta: { access: 'user' }, component: () => import('@/views/landing/Landing.vue') },
    { path: 'rent', meta: { access: 'user' }, component: () => import('@/views/landing/Rent.vue') },
    { path: 'sell', meta: { access: 'user' }, component: () => import('@/views/landing/Sell.vue') },
    { path: 'new-listing', meta: { access: 'user' }, component: () => import('@/views/landing/NewList.vue') },
    { path: 'pricing', meta: { access: 'user' }, component: () => import('@/views/landing/Pricing.vue') },
    { path: 'about-us', meta: { access: 'user' }, component: () => import('@/views/landing/AboutUs.vue') }
];

// Manage Rental Routes
const manageRentalRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/setting/Dashboard.vue') },
    { path: 'my-listing', meta: { access: 'user' }, component: () => import('@/views/setting/MyListing.vue') },
    { path: 'create-property', meta: { access: 'user' }, component: () => import('@/views/setting/CreateProperty.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/setting/ChatRoom.vue') },
    { path: 'subscription', meta: { access: 'user' }, component: () => import('@/views/setting/Subscription.vue') },
    { path: 'favorites', meta: { access: 'user' }, component: () => import('@/views/setting/Favorites.vue') },
    { path: 'save', meta: { access: 'user' }, component: () => import('@/views/setting/Save.vue') }
];

// Admin Routes
const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/admin/dashboard/Dashboard.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/admin/message/ChatRoom.vue') },
    {
        path: 'property-management',
        children: [
            { path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/PropertyList.vue') },
            { path: 'for-approval', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/ForApproval.vue') },
            { path: 'active', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/Active.vue') },
            { path: 'reject', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/Reject.vue') }
        ]
    },
    {
        path: 'maintenance',
        children: [
            { path: 'amenity', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/Amenity.vue') },
            { path: 'appliances', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/Appliances.vue') },
            { path: 'file-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/FileType.vue') },
            { path: 'mode-of-payment', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/ModeOfPayment.vue') },
            { path: 'price-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PriceType.vue') },
            { path: 'property-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PropertyType.vue') },
            { path: 'property-status', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PropertyStatus.vue') }
        ]
    },
    {
        path: 'user-management',
        children: [
            { path: 'user-list', meta: { access: 'user' }, component: () => import('@/views/users/UserList.vue') },
            { path: 'role', meta: { access: 'user' }, component: () => import('@/views/users/Role.vue') }
        ]
    },
    {
        path: 'subscription-management',
        children: [
            { path: 'user-subscription', meta: { access: 'user' }, component: () => import('@/views/subscription/UserSubscription.vue') },
            { path: 'expired-month', meta: { access: 'user' }, component: () => import('@/views/subscription/ExpiredMonth.vue') },
            { path: 'for-approval', meta: { access: 'user' }, component: () => import('@/views/subscription/ForApproval.vue') },
            { path: 'subscription-type', meta: { access: 'user' }, component: () => import('@/views/subscription/SubscriptionType.vue') }
        ]
    }
];

// Define Routes
const routes = [
    {
        path: '/',
        children: landingRoutes
    },
    {
        path: '/manage-rental',
        component: AppLayout,
        children: manageRentalRoutes
    },
    {
        path: '/admin',
        component: AppLayout,
        children: adminRoutes
    },
    { path: '/login', meta: { access: 'user' }, component: () => import('@/views/Login.vue') },
    { path: '/auth/access', meta: { access: 'user' }, component: () => import('@/views/Access.vue') },
    { path: '/auth/error', meta: { access: 'user' }, component: () => import('@/views/Error.vue') }
];

// Create Router
const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior: () => ({ left: 0, top: 0 })
});

// Navigation Guard
router.beforeEach((to) => {
    const authStore = useAuthStore();
    if (!authStore.check(to.meta.access)) {
        return '/login';
    }
});

export default router;
