const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/admin/Dashboard.vue') },
    { path: 'agent', meta: { access: 'user' }, component: () => import('@/views/admin/Agent.vue') },
    { path: 'player', meta: { access: 'user' }, component: () => import('@/views/admin/Player.vue') },
    { path: 'transaction', meta: { access: 'user' }, component: () => import('@/views/admin/Transaction.vue') },
    { path: 'report', meta: { access: 'user' }, component: () => import('@/views/admin/Report.vue') },
    {
        path: 'liveGames',
        children: [
            { path: '', meta: { access: 'user' }, component: () => import('@/views/admin/LiveGames/LiveGames.vue') },
            { path: 'sabongConsole', meta: { access: 'user' }, component: () => import('@/views/admin/LiveGames/SabongConsole.vue') }
        ]
    },
    {
        path: 'maintenance',
        children: [
            { path: 'bankType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/BankType.vue') },
            { path: 'agentType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/agentType.vue') },
            { path: 'gameType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/GameType.vue') },
            { path: 'videoType', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/VideoType.vue') },
            { path: 'gameVideo', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/LiveVideo.vue') },
            { path: 'gamePresent', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/GamePresent.vue') },
            { path: 'GameOption', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/GameOption.vue') },
            { path: 'gamePresentAnnouncement', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/GamePresentAnnouncement.vue') }
        ]
    }
];
export default adminRoutes;
