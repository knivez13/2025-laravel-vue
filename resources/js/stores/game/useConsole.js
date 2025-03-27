import { defineStore } from 'pinia';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('game/live-game-console');

export const useConsole = defineStore('game-live-game-console', {
    state: () => ({
        ///data
        game_list_id: null,
        list: [],
        live_game: [],
        player: [],

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
        set_game_list_id(res) {
            this.game_list_id = res;
        },

        set_live_game(res) {
            this.live_game = res;
        },
        set_player(res) {
            this.player = res;
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
        async fnShow() {
            if (this.game_list_id == null) {
                setTimeout(() => router.push('/game'), 100);
            }
            // if (this.processing) return;
            // this.processing = true;
            this.error = null;
            this.list = [];
            console.log(this.game_list_id);
            await api
                .get(this.game_list_id)
                .then(({ data }) => {
                    console.log('game');
                    console.log(api.decrypt(data?.data));
                    this.live_game = api.decrypt(data?.data)?.live_game;
                    this.player = api.decrypt(data?.data)?.player;
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
    },
    persist: true
});
