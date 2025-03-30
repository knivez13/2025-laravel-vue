const landingRoutes = [
    { path: '', meta: { access: 'user' }, component: () => import('@/views/landing/Landing.vue') },
    { path: 'rent', meta: { access: 'user' }, component: () => import('@/views/landing/Rent.vue') },
    { path: 'sell', meta: { access: 'user' }, component: () => import('@/views/landing/Sell.vue') },
    { path: 'new-listing', meta: { access: 'user' }, component: () => import('@/views/landing/NewList.vue') },
    { path: 'pricing', meta: { access: 'user' }, component: () => import('@/views/landing/Pricing.vue') },
    { path: 'about-us', meta: { access: 'user' }, component: () => import('@/views/landing/AboutUs.vue') }
];
export default landingRoutes;
