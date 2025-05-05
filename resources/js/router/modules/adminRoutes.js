const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    {
        path: 'maintenance',
        children: [
            { path: 'bankType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/BankType.vue') },
            { path: 'agentType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/agentType.vue') },
            { path: 'gameType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/GameType.vue') },
            { path: 'videoType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/VideoType.vue') },
            { path: 'provider', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/Provider.vue') },
            { path: 'gameVideo', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/LiveVideo.vue') },
            { path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
        ]
    }
];
export default adminRoutes;
