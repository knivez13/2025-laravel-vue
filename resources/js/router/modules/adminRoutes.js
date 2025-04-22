const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/admin/dashboard/Dashboard.vue') }

    // {
    //     path: 'subscription-management',
    //     children: [
    //         { path: 'user-subscription', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/UserSubscription.vue') },
    //         { path: 'expired-month', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/ExpiredMonth.vue') },
    //         { path: 'for-approval', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/ForApproval.vue') },
    //         { path: 'subscription-type', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/SubscriptionType.vue') }
    //     ]
    // }
];
export default adminRoutes;
