import AppLayout from '@/layout/AppLayout.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/useAuthStore.js';
import landingRoutes from '@/router/modules/landingRoutes.js';
import portfolioRoutes from '@/router/modules/portfolioRoutes.js';
import profileRoutes from '@/router/modules/profileRoutes.js';
import financeRoutes from '@/router/modules/financeRoutes.js';
import affiliateRoutes from '@/router/modules/affiliateRoutes.js';

// Define Routes
const routes = [
    {
        path: '/',
        children: landingRoutes
    },
    {
        path: '/portfolio',
        component: AppLayout,
        children: portfolioRoutes
    },
    {
        path: '/profile',
        component: AppLayout,
        children: profileRoutes
    },
    {
        path: '/finance',
        component: AppLayout,
        children: financeRoutes
    },
    {
        path: '/affiliate',
        component: AppLayout,
        children: affiliateRoutes
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
