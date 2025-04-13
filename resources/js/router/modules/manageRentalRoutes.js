const manageRentalRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') },
    { path: 'my-listing', meta: { access: 'user' }, component: () => import('@/views/Amenity.vue') }
];
export default manageRentalRoutes;
