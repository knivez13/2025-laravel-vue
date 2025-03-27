import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
const api = new Resource('qrph');
const api2 = new Resource('cashout');
const api4 = new Resource('bank-request');
import { useToast } from 'primevue/usetoast';

export const useCashinCashOut = defineStore('cash-in-cash-out', {
    state: () => ({
        area_list: [],
        bank_list: [],
        cashin_responce: [],
        loading: false,
        cashout: false,
        error: [],
        toast: useToast()
    }),
    getters: {
        // get_token: (state) => state.token
    },
    actions: {
        set_cashin_responce(res) {
            this.cashin_responce = res;
        },
        set_loading(res) {
            this.loading = res;
        },
        set_cashout(res) {
            this.cashout = res;
        },
        async fnBankRequest() {
            this.bank_list = [];
            // await api4
            //     .list()
            //     .then(({ data }) => {
            //         // console.log(data);
            //         this.bank_list = data;
            //     })
            //     .catch((e) => {
            //         this.error = e;
            //         console.log(e);
            //     })
            //     .finally(() => {
            //         this.processing = false;
            //     });
        },
        async fnStore(res) {
            this.loading = true;
            this.error = null;
            this.list = [];
            await api
                .store({ enm: api.encrypt(res) })
                .then(async ({ data }) => {
                    console.log(api.decrypt(data?.data));
                    this.cashin_responce = api.decrypt(data?.data);
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {});
        },
        async fnStoreCashout(res) {
            // await api2
            //     .store({ enm: api.encrypt(res) })
            //     .then(async ({ data }) => {
            //         console.log(data);
            //         // console.log(api.decrypt(data));
            //         this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Cash Out Success', life: 1000 });
            //     })
            //     .catch((e) => {
            //         this.error = e;
            //     })
            //     .finally(() => {});
        }
    },
    persist: true
});
