const landingRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/player/Dashboard.vue') },
    { path: 'betHistory', meta: { access: 'user' }, component: () => import('@/views/player/BetHistory.vue') },
    { path: 'transaction', meta: { access: 'user' }, component: () => import('@/views/player/Transaction.vue') },
    { path: 'profile', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
];
export default landingRoutes;
