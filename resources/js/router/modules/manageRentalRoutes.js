const manageRentalRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/managementRental/Dashboard.vue') },
    { path: 'my-listing', meta: { access: 'user' }, component: () => import('@/views/managementRental/MyListing.vue') },
    { path: 'create-property', meta: { access: 'user' }, component: () => import('@/views/managementRental/CreateProperty.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/managementRental/ChatRoom.vue') },
    { path: 'subscription', meta: { access: 'user' }, component: () => import('@/views/managementRental/Subscription.vue') },
    { path: 'favorites', meta: { access: 'user' }, component: () => import('@/views/managementRental/Favorites.vue') },
    { path: 'save', meta: { access: 'user' }, component: () => import('@/views/managementRental/Save.vue') },
    { path: 'profile', meta: { access: 'user' }, component: () => import('@/views/Profile.vue') }
];
export default manageRentalRoutes;
