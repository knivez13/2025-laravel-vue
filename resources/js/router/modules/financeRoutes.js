const financeRoutes = [
    { path: 'deposit', meta: { access: 'user' }, component: () => import('@/views/finance/deposit/index.vue') },
    { path: 'withdraw', meta: { access: 'user' }, component: () => import('@/views/finance/withdraw/index.vue') },
    { path: 'transfer-log', meta: { access: 'user' }, component: () => import('@/views/finance/transferLog/index.vue') }
];
export default financeRoutes;
