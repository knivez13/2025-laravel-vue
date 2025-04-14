const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    {
        path: 'property-management',
        children: [{ path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }]
    }
];
export default adminRoutes;
