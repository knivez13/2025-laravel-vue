const adminRoutes = [
    { path: 'dashboard', meta: { access: 'user' }, component: () => import('@/views/admin/dashboard/Dashboard.vue') },
    { path: 'message', meta: { access: 'user' }, component: () => import('@/views/admin/message/ChatRoom.vue') },
    {
        path: 'property-management',
        children: [
            { path: 'property-list', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/PropertyList.vue') },
            { path: 'for-approval', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/ForApproval.vue') },
            { path: 'active', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/Active.vue') },
            { path: 'reject', meta: { access: 'user' }, component: () => import('@/views/admin/propertyManagement/Reject.vue') }
        ]
    },
    {
        path: 'maintenance',
        children: [
            { path: 'amenity', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/Amenity.vue') },
            { path: 'appliances', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/Appliances.vue') },
            { path: 'file-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/FileType.vue') },
            { path: 'mode-of-payment', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/ModeOfPayment.vue') },
            { path: 'price-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PriceType.vue') },
            { path: 'property-type', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PropertyType.vue') },
            { path: 'property-status', meta: { access: 'user' }, component: () => import('@/views/admin/maintenance/PropertyStatus.vue') }
        ]
    },
    {
        path: 'user-management',
        children: [
            { path: 'user-list', meta: { access: 'user' }, component: () => import('@/views/admin/userManagement/UserList.vue') },
            { path: 'role', meta: { access: 'user' }, component: () => import('@/views/admin/userManagement/Role.vue') }
        ]
    },
    {
        path: 'subscription-management',
        children: [
            { path: 'user-subscription', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/UserSubscription.vue') },
            { path: 'expired-month', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/ExpiredMonth.vue') },
            { path: 'for-approval', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/ForApproval.vue') },
            { path: 'subscription-type', meta: { access: 'user' }, component: () => import('@/views/admin/subscriptionManagement/SubscriptionType.vue') }
        ]
    }
];
export default adminRoutes;
