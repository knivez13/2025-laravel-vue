const affiliateRoutes = [
    { path: 'available-withdraw', meta: { access: 'user' }, component: () => import('@/views/affiliate/availableWithdraw/index.vue') },
    { path: 'commission', meta: { access: 'user' }, component: () => import('@/views/affiliate/commission/index.vue') },
    { path: 'rate', meta: { access: 'user' }, component: () => import('@/views/affiliate/rate/index.vue') },
    { path: 'registration', meta: { access: 'user' }, component: () => import('@/views/affiliate/registration/index.vue') },
    { path: 'transfer-trading-account', meta: { access: 'user' }, component: () => import('@/views/affiliate/transferTradingAccount/index.vue') }
];
export default affiliateRoutes;
