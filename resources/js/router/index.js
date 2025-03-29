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
                    component: () => import('@/views/landing/Landing.vue')
                },
                {
                    path: 'rent',
                    meta: { access: 'user' },
                    component: () => import('@/views/landing/Rent.vue')
                },
                {
                    path: 'sell',
                    meta: { access: 'user' },
                    component: () => import('@/views/landing/Sell.vue')
                },
                {
                    path: 'new-listing',
                    meta: { access: 'user' },
                    component: () => import('@/views/landing/NewList.vue')
                },
                {
                    path: 'pricing',
                    meta: { access: 'user' },
                    component: () => import('@/views/landing/Pricing.vue')
                },
                {
                    path: 'about-us',
                    meta: { access: 'user' },
                    component: () => import('@/views/landing/AboutUs.vue')
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
                    component: () => import('@/views/setting/Dashboard.vue')
                },
                {
                    path: 'my-listing',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/MyListing.vue')
                },
                {
                    path: 'create-property',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/CreateProperty.vue')
                },
                {
                    path: 'message',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/ChatRoom.vue')
                },
                {
                    path: 'subscription',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/Subscription.vue')
                },
                {
                    path: 'favorites',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/Favorites.vue')
                },
                {
                    path: 'save',
                    meta: { access: 'user' },
                    component: () => import('@/views/setting/Save.vue')
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
                    component: () => import('@/views/admin/dashboard/Dashboard.vue')
                },
                {
                    path: 'message',
                    meta: { access: 'user' },
                    component: () => import('@/views/admin/message/ChatRoom.vue')
                },
                {
                    path: 'property-management',
                    children: [
                        {
                            path: 'property-list',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/propertyManagement/PropertyList.vue')
                        },
                        {
                            path: 'for-approval',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/propertyManagement/ForApproval.vue')
                        },
                        {
                            path: 'active',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/propertyManagement/Active.vue')
                        },
                        {
                            path: 'reject',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/propertyManagement/Reject.vue')
                        }
                    ]
                },
                {
                    path: 'maintenance',
                    children: [
                        {
                            path: 'amenity',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/Amenity.vue')
                        },
                        {
                            path: 'appliances',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/Appliances.vue')
                        },
                        {
                            path: 'file-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/FileType.vue')
                        },
                        {
                            path: 'mode-of-payment',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/ModeOfPayment.vue')
                        },
                        {
                            path: 'price-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/PriceType.vue')
                        },
                        {
                            path: 'property-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/PropertyType.vue')
                        },
                        {
                            path: 'property-status',
                            meta: { access: 'user' },
                            component: () => import('@/views/admin/maintenance/PropertyStatus.vue')
                        }
                    ]
                },
                {
                    path: 'user-management',
                    children: [
                        {
                            path: 'user-list',
                            meta: { access: 'user' },
                            component: () => import('@/views/users/UserList.vue')
                        },
                        {
                            path: 'role',
                            meta: { access: 'user' },
                            component: () => import('@/views/users/Role.vue')
                        }
                    ]
                },
                {
                    path: 'subscription-management',
                    children: [
                        {
                            path: 'user-subscription',
                            meta: { access: 'user' },
                            component: () => import('@/views/subscription/UserSubscription.vue')
                        },
                        {
                            path: 'expired-month',
                            meta: { access: 'user' },
                            component: () => import('@/views/subscription/ExpiredMonth.vue')
                        },
                        {
                            path: 'for-approval',
                            meta: { access: 'user' },
                            component: () => import('@/views/subscription/ForApproval.vue')
                        },
                        {
                            path: 'subscription-type',
                            meta: { access: 'user' },
                            component: () => import('@/views/subscription/SubscriptionType.vue')
                        }
                    ]
                }
            ]
        },

        // {
        //     path: '/pages/notfound',
        //     meta: { access: 'user' },
        //     component: () => import('@/views/pages/NotFound.vue')
        // },
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
