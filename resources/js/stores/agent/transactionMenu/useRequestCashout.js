import { defineStore } from 'pinia';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('agent/transaction-menu/request-cashout');

export const useRequestCashout = defineStore('agent-transaction-menu-request-cashout', {
    state: () => ({
        ///data
        list: [],

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
                .list({
                    enm: api.encrypt({
                        keyword: this.filter.keywords,
                        sortBy: this.filter.sortBy,
                        sortOrder: this.filter.sortOrder,
                        rows: this.filter.rows,
                        page: this.filter.page ? this.filter.page : 1
                    })
                })
                .then(({ data }) => {
                    console.log(api.decrypt(data?.data));
                    this.list = api.decrypt(data?.data)?.list.data;
                    this.total = api.decrypt(data?.data)?.list.total;
                })
                .catch((e) => {
                    this.error = e;
                    console.log(this.error);
                    if (e.status == 401) {
                        this.toast.add({ severity: 'error', summary: 'Notification', detail: 'Authentication Required', life: 3000 });
                    } else if (e.status == 422) {
                    } else if (e.status == 403) {
                        this.toast.add({ severity: 'error', summary: 'Notification', detail: "You're not allowed to do that.", life: 3000 });
                    } else if (e.status == 500) {
                        this.toast.add({ severity: 'error', summary: 'Notification', detail: 'Something went really bad. Sorry.', life: 3000 });
                    } else {
                        this.toast.add({ severity: 'error', summary: 'Notification', detail: 'Something went wrong. Please try again later.', life: 3000 });
                    }
                })
                .finally(() => {
                    this.processing = false;
                });
        }
    }
    // persist: true
});
