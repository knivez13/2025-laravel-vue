import { defineStore } from 'pinia';
import router from '@/router';
import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('admin/user/player');

export const useProfile = defineStore('admin-user-profile', {
    state: () => ({
        ///data
        select_profile: [],
        toast: useToast()
    }),
    getters: {
        // get_token: (state) => state.token
    },
    actions: {
        set_select_profile(data) {
            this.select_profile = data;
            setTimeout(() => router.push('/admin/user/profile'), 500);
        },
        set_select_profile_agent(data) {
            this.select_profile = data;
            // setTimeout(() => router.push('/agent/basic-mode/agent/user-profile'), 500);
        }
    },
    persist: true
});
