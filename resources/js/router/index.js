import AppLayout from '@/layout/AppLayout.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/useAuthStore.js';
import landingRoutes from '@/router/modules/landingRoutes.js';
import manageRentalRoutes from '@/router/modules/manageRentalRoutes.js';
import adminRoutes from '@/router/modules/adminRoutes.js';

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
