const profileRoutes = [
    { path: 'about-me', meta: { access: 'user' }, component: () => import('@/views/profile/aboutMe/index.vue') },
    { path: 'security', meta: { access: 'user' }, component: () => import('@/views/profile/security/index.vue') },
    { path: 'verification', meta: { access: 'user' }, component: () => import('@/views/profile/verification/index.vue') }
];
export default profileRoutes;
