const manageRentalRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') },
    { path: 'my-listing', meta: { access: 'user' }, component: () => import('@/views/CreateProperty.vue') }
];
export default manageRentalRoutes;
