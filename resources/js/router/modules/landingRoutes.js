const landingRoutes = [
    { path: '', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') },
    { path: 'rent', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') }
];
export default landingRoutes;
