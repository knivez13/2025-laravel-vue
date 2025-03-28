import AppLayout from '@/layout/AppLayout.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/useAuthStore.js';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: AppLayout,
            children: [
                {
                    path: '',
                    meta: { access: 'user' },
                    component: () => import('@/views/Dashboard.vue')
                },
                {
                    path: 'rent',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'sell',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'new-listing',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'pricing',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'about-us',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                }
            ]
        },
        {
            path: '/manage-rental',
            component: AppLayout,
            children: [
                {
                    path: 'dashboard',
                    meta: { access: 'user' },
                    component: () => import('@/views/Dashboard.vue')
                },
                {
                    path: 'my-listing',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'create-property',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'message',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'subscription',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'favorites',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'save',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                }
            ]
        },
        {
            path: '/admin',
            component: AppLayout,
            children: [
                {
                    path: 'dashboard',
                    meta: { access: 'user' },
                    component: () => import('@/views/Dashboard.vue')
                },
                {
                    path: 'message',
                    meta: { access: 'user' },
                    component: () => import('@/views/uikit/FormLayout.vue')
                },
                {
                    path: 'property-management',
                    children: [
                        {
                            path: 'property-list',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'for-approval',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'active',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'reject',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        }
                    ]
                },
                {
                    path: 'maintenance',
                    children: [
                        {
                            path: 'amenity',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'appliances',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'file-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'mode-of-payment',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'price-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'property-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'property-status',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        }
                    ]
                },
                {
                    path: 'user-management',
                    children: [
                        {
                            path: 'user-list',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'role',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        }
                    ]
                },
                {
                    path: 'subscription-management',
                    children: [
                        {
                            path: 'user-subscription',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'expired-month',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'for-approval',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        },
                        {
                            path: 'subscription-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/Dashboard.vue')
                        }
                    ]
                }
            ]
        },

        {
            path: '/pages/notfound',
            meta: { access: 'user' },
            component: () => import('@/views/pages/NotFound.vue')
        },
        {
            path: '/login',
            meta: { access: 'user' },
            component: () => import('@/views/Login.vue')
        },
        {
            path: '/auth/access',
            meta: { access: 'user' },
            component: () => import('@/views/Access.vue')
        },
        {
            path: '/auth/error',
            meta: { access: 'user' },
            component: () => import('@/views/Error.vue')
        }
    ],
    scrollBehavior() {
        return { left: 0, top: 0 };
    }
});

router.beforeEach((to, from) => {
    const authStore = useAuthStore();
    const canAccess = authStore.check(to.meta.access);
    if (!canAccess) return '/login';
});

export default router;
