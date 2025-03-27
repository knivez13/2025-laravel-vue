import { defineStore } from 'pinia';
import router from '@/router';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('admin/game-moderator/create-game');

export const useNewGame = defineStore('admin-game-moderator-create-new-game', {
    state: () => ({
        ///data
        game_present: [],
        multiplier: [],
        video_list: [],
        rate_list: [],
        betting_type: [],

        bet_option: [],
        bet_payout: [],
        bet_winner: [],
        bet_option_count: null,
        bet_option_list: [],

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
        fn_bet_option(id) {
            this.bet_option_count = this.bet_option.filter((i) => {
                return i.id.includes(id);
            });
            this.bet_option_list = [];
            for (let i = 0; i < this.bet_option_count[0].amount; i++) {
                this.bet_option_list.push({
                    order: i,
                    name: null,
                    style: null,
                    bet_payout_id: null
                });
            }
            console.log(this.bet_option_count[0]);
        },
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
                    this.game_present = api.decrypt(data?.data)?.game_present;
                    this.betting_type = api.decrypt(data?.data)?.betting_type;
                    this.multiplier = api.decrypt(data?.data)?.multiplier;
                    this.rate_list = api.decrypt(data?.data)?.rate_list;

                    this.video_list = api.decrypt(data?.data)?.video_list;
                    this.bet_option = api.decrypt(data?.data)?.bet_option;
                    this.bet_payout = api.decrypt(data?.data)?.bet_payout;
                    this.bet_winner = api.decrypt(data?.data)?.bet_winner;
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
        async fnStore(res) {
            // if (this.processing) return;
            // this.processing = true;
            console.log(res);
            this.error = null;
            this.list = [];
            await api
                .store({
                    enm: api.encrypt({ data: res })
                })
                .then(async ({ data }) => {
                    console.log(api.decrypt(data?.data));
                    router.push('/admin/game-moderator/live-games');

                    this.toast.add({ severity: 'success', summary: 'Notification', detail: data.message, life: 3000 });
                })
                .catch((e) => {
                    this.error = e;
                    // console.log(this.error);
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
