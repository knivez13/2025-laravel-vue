import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
import router from '@/router';

const api = new Resource('currency');

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: null,
        validation: [],
        processing: false,
        error: null
    }),
    getters: {
        get_token: (state) => state.token
    },
    actions: {
        // Check if the user has a specific permission
        check(permission) {
            return permission === 'user' || api.decrypt(this.token)['permission'].includes(permission);
        },

        // Clear user data and redirect to login
        async clear() {
            try {
                await api.csrf();
                await api.logout();
                this.token = null;
                this.user = [];
                this.roles = [];
                this.permission = [];
                setTimeout(() => router.push('/login'), 100);
            } catch (error) {
                console.error('Error during logout:', error);
            }
        },

        // Login user and handle authentication
        async loginUser(credentials) {
            if (this.processing) return;
            this.processing = true;
            this.token = null;
            this.error = null;
            try {
                await api.csrf();
                const { data } = await api.login(credentials);
                // console.log(api.decrypt(data?.response_data));
                if (api.decrypt(data?.response_data) === 'Wrong Username or Password') {
                    this.error = 'Wrong Username or Password';
                } else if (data) {
                    this.token = data?.response_data;
                    router.push('/admin/dashboard');
                }
            } catch (error) {
                console.error('Login Error:', error);
            } finally {
                this.processing = false;
            }
        }
    },
    persist: true
});
