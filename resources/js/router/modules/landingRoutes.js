const landingRoutes = [
    { path: '', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'profile', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
];
export default landingRoutes;
