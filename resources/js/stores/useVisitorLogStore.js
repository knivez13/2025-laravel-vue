import { defineStore } from 'pinia';

import Resource from '@/api/resource.js';
import { useToast } from 'primevue/usetoast';

const api = new Resource('user-list');
const api_depo_with = new Resource('deposit-withdraw');

export const useVisitorLogStore = defineStore('user-list', {
    state: () => ({
        ///data
        list: [],
        casino_commission: [],
        general_commission: [],
        lottery_commission: [],
        roles: [],
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
        async set_modal_close(data) {
            this.modal_close = data;
        },
        async set_load_modal_close(data) {
            this.load_modal_close = data;
        },
        async fnFetch() {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            // await api.csrf().then(async ({ e }) => {
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
                    this.roles = api.decrypt(data?.data)?.role;
                    this.casino_commission = api.decrypt(data?.data)?.casino_commission;
                    this.general_commission = api.decrypt(data?.data)?.general_commission;
                    this.lottery_commission = api.decrypt(data?.data)?.lottery_commission;
                    this.total = api.decrypt(data?.data)?.list.total;
                    this.perm = api.decrypt(data?.data)?.perm;
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
        },
        async fnStore(res) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            await api.csrf().then(async ({ e }) => {
                this.list = [];
                const filters = {
                    keyword: this.filter.keywords,
                    sortBy: this.filter.sortBy,
                    sortOrder: this.filter.sortOrder,
                    rows: this.filter.rows,
                    page: this.filter.page ? this.filter.page : 1
                };
                await api
                    .store({ head: filters, data: res })
                    .then(async ({ data }) => {
                        console.log(api.decrypt(data?.data));
                        this.list = api.decrypt(data?.data)?.list.data;
                        this.roles = api.decrypt(data?.data)?.role;
                        this.casino_commission = api.decrypt(data?.data)?.casino_commission;
                        this.general_commission = api.decrypt(data?.data)?.general_commission;
                        this.lottery_commission = api.decrypt(data?.data)?.lottery_commission;
                        this.total = api.decrypt(data?.data)?.list.total;
                        this.perm = api.decrypt(data?.data)?.perm;
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
            });
        },
        async fnUpdate(id, res) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            await api.csrf().then(async ({ e }) => {
                this.list = [];
                const filters = {
                    keyword: this.filter.keywords,
                    sortBy: this.filter.sortBy,
                    sortOrder: this.filter.sortOrder,
                    rows: this.filter.rows,
                    page: this.filter.page ? this.filter.page : 1
                };
                await api
                    .update(id, { head: filters, data: res })
                    .then(async ({ data }) => {
                        console.log(data);
                        this.list = data?.data.list.data;
                        this.total = data?.data.list.total;
                        this.group_section = data?.data?.group_section;
                        this.department = data?.data?.department;
                        this.perm = data?.data?.perm;
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
            });
        },
        async fnDelete(id) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            await api.csrf().then(async ({ e }) => {
                this.list = [];
                const filters = {
                    keyword: this.filter.keywords,
                    sortBy: this.filter.sortBy,
                    sortOrder: this.filter.sortOrder,
                    rows: this.filter.rows,
                    page: this.filter.page ? this.filter.page : 1
                };
                await api
                    .destroy2({ head: filters, id: id })
                    .then(({ data }) => {
                        console.log(data);
                        this.list = data?.data.list.data;
                        this.total = data?.data.list.total;
                        this.group_section = data?.data?.group_section;
                        this.department = data?.data?.department;
                        this.perm = data?.data?.perm;
                        this.toast.add({ severity: 'success', summary: 'Notification', detail: data.message, life: 3000 });
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
            });
        },

        async fnDepositWithdraw(res) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            this.list = [];
            // await api.csrf().then(async ({ e }) => {
            const filters = {
                keyword: this.filter.keywords,
                sortBy: this.filter.sortBy,
                sortOrder: this.filter.sortOrder,
                rows: this.filter.rows,
                page: this.filter.page ? this.filter.page : 1
            };
            await api_depo_with
                .store({ head: filters, data: res })
                .then(async ({ data }) => {
                    console.log(data);
                    console.log(api.decrypt(data?.data));
                    this.list = api.decrypt(data?.data)?.list.data;
                    this.roles = api.decrypt(data?.data)?.role;
                    this.casino_commission = api.decrypt(data?.data)?.casino_commission;
                    this.general_commission = api.decrypt(data?.data)?.general_commission;
                    this.lottery_commission = api.decrypt(data?.data)?.lottery_commission;
                    this.total = api.decrypt(data?.data)?.list.total;
                    this.perm = api.decrypt(data?.data)?.perm;
                    this.toast.add({ severity: 'success', summary: 'Notification', detail: data.message, life: 3000 });
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
    }
    // persist: true
});
