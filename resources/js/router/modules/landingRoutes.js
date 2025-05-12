const landingRoutes = [
    { path: '', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'rent', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
];
export default landingRoutes;
