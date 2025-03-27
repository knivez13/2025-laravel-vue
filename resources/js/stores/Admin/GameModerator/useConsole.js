import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';
import router from '@/router';

const api = new Resource('admin/game-moderator/live-games');
const api_update = new Resource('admin/game-moderator/update-console');

export const useConsole = defineStore('admin-game-moderator-console', {
    state: () => ({
        game_list_id: null,
        live_game: [],
        game_list: [],

        game_rounds: [],
        current: [],
        game_bet_option: [],
        player: [],

        option_draw: [],
        option_meron: [],
        option_wala: [],

        sum_meron: [],
        sum_wala: [],
        sum_draw: [],

        ods_meron: null,
        ods_wala: null,

        multi_sum_meron: null,
        multi_sum_wala: null,

        perm: {
            can_add: false,
            can_delete: false,
            can_edit: false,
            can_restore: false,
            can_show_date: false
        },
        filter: {
            keywords: null,
            sortBy: 'created_at',
            sortOrder: -1,
            rows: 10,
            page: 0
        },
        processing: false,
        error: [],
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
        fn_area(res, id) {
            this.area_list = [];
            this.area_list = res.filter((i) => {
                return i.group_section_id.includes(id);
            });
            console.log(this.area_list);
        },
        async fnShow() {
            if (this.game_list_id == null) {
                setTimeout(() => router.push('/admin/game-moderator/live-games'), 100);
            }
            // if (this.processing) return;
            // this.processing = true;
            this.error = null;
            this.list = [];
            console.log(this.game_list_id);
            await api
                .get(this.game_list_id)
                .then(({ data }) => {
                    console.log(data);
                    console.log({ reply: api.decrypt(data?.data) });
                    this.live_game = api.decrypt(data?.data)?.live_game;
                    // this.player = api.decrypt(data?.data)?.player;
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
            var update_data = { update_data: res };
            await api_update
                .update(id, {
                    enm: api.encrypt({ data: update_data })
                })
                .then(async ({ data }) => {
                    console.log(api.decrypt(data?.data));
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
    },

    persist: true
});
