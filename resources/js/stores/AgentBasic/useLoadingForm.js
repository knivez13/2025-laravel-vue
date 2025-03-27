import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('agent/basic-mode/loading-station');

export const useLoadingForm = defineStore('agent-basic-loading-station', {
    state: () => ({
        list: [],
        sender: null,
        load_modal_close: false,
        toast: useToast()
    }),
    getters: {
        // get_token: (state) => state.token
    },
    actions: {
         set_sender_id(data) {
            this.sender = data;
        },
        async set_load_modal_close(data) {
            this.load_modal_close = data;
        },
        async fnFetch() {
            // console.log('asdasd');
            // this.error = null;
            this.list = [];
            await api
                .list()
                .then(({ data }) => {
                    console.log(api.decrypt(data?.data));
                    this.list = api.decrypt(data?.data)?.list;
                    // this.total = api.decrypt(data?.data)?.list.total;
                })
                .catch((e) => {
                    this.error = e;
                    console.log(this.error);
                })
                .finally(() => {
                    this.processing = false;
                });
        },
        async fnStore(res) {
            // if (this.processing) return;
            // this.processing = true;
            this.error = null;
            this.list = [];
            // await api.csrf().then(async ({ e }) => {

            await api
                .store({
                    enm: api.encrypt({ data: res })
                })
                .then(async ({ data }) => {
                    console.log(api.decrypt(data?.data));
                    if (data.message == 'Transaction Failed') {
                        this.toast.add({ severity: 'error', summary: 'Notification', detail: data.message, life: 3000 });
                    } else {
                        this.toast.add({ severity: 'success', summary: 'Notification', detail: data.message, life: 3000 });
                    }
                    await this.set_load_modal_close(false);
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
            // });
        }
    },
    persist: true
});
