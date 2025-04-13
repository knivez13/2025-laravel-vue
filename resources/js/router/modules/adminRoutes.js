const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') },
    {
        path: 'property-management',
        children: [{ path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') }]
    }
];
export default adminRoutes;
