import { defineStore } from 'pinia';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('admin/dashboard');

export const useDashboard = defineStore('admin-dashboard', {
    state: () => ({
        ///data
        list: [],
        cockfighting_earning: [],

        perm: {
            can_add: false,
            can_delete: false,
            can_edit: false,
            can_restore: false,
            can_show_date: false
        },
        //loading
        processing: false,
        modal_close: false,
        load_modal_close: false,

        //error
        error: [],
        filter: {
            keywords: null,
            sortBy: 'created_at',
            sortOrder: -1,
            rows: 10,
            page: 0
        },
        total: 0,
        toast: useToast()
    }),
    getters: {
        // get_token: (state) => state.token
    },
    actions: {
        async set_processing(data) {
            this.filter.processing = data;
        },
        async set_rows(data) {
            this.filter.rows = data;
        },
        async set_keywords(data) {
            this.filter.keywords = data;
        },
        async set_page(data) {
            this.filter.page = data;
        },
        async set_sort(data) {
            this.filter.sortBy = data.sortBy;
            this.filter.sortOrder = data.sortOrder;
            this.filter.page = 0;
        },
        async clearError() {
            this.error = [];
        },
        async fnFetch() {
            this.error = null;
            this.list = [];
            await api
                .list()
                .then(({ data }) => {
                    console.log(api.decrypt(data?.data));
                    this.cockfighting_earning = api.decrypt(data?.data)?.cockfighting_earning;
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {
                    this.processing = false;
                });
        }
    },
    persist: true
});
