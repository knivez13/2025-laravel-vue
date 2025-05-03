const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    {
        path: 'maintenance',
        children: [
            { path: 'bankType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/BankType.vue') },
            { path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
        ]
    }
];
export default adminRoutes;
