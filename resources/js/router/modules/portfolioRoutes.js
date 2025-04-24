const portfolioRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/portfolio/dashboard/index.vue') },
    { path: 'asset', meta: { access: 'user' }, component: () => import('@/views/portfolio/asset/index.vue') },
    { path: 'analytics', meta: { access: 'user' }, component: () => import('@/views/portfolio/analytics/index.vue') },
    { path: 'transaction', meta: { access: 'user' }, component: () => import('@/views/portfolio/transaction/index.vue') }

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
export default portfolioRoutes;
