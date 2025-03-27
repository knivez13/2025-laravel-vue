import { defineStore } from 'pinia';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('admin/game-moderator/live-games');

export const useLiveGame = defineStore('admin-game-moderator-live-games', {
    state: () => ({
        ///data
        list: [],
        game_present: [],
        multiplier: [],
        video_list: [],
        rate_list: [],

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
        async set_modal_close(data) {
            this.modal_close = data;
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
                    this.list = api.decrypt(data?.data)?.list;
                    this.game_present = api.decrypt(data?.data)?.game_present;
                    this.video_list = api.decrypt(data?.data)?.video_list;
                    this.multiplier = api.decrypt(data?.data)?.multiplier;
                    this.rate_list = api.decrypt(data?.data)?.rate_list;
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
        },

        async fnUpdate(id, res) {
            // if (this.processing) return;
            // this.processing = true;
            this.error = null;
            this.list = [];

            await api
                .update(id, {
                    enm: api.encrypt({ data: res })
                })
                .then(async ({ data }) => {
                    console.log(data);

                    this.toast.add({ severity: 'success', summary: 'Notification', detail: data.message, life: 3000 });

                    await this.set_modal_close(false);
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
