import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
const api = new Resource('gameList');
import { useToast } from 'primevue/usetoast';

export const useAgentPlayerStore = defineStore('admin-agent-player', {
    state: () => ({
        token: null,
        toast: useToast(),
        processing: false,
        error: [],
        option: {
            keywords: '',
            sortBy: 'created_at',
            sortOrder: 'desc',
            rows: 10,
            page: 1,
            show_modal: false,
            perm: {
                can_add: false,
                can_delete: false,
                can_edit: false,
                can_restore: false,
                can_show_date: false
            }
        }
    }),
    getters: {
        get_token: (state) => state.token
        // decode_token: (state) => api.decrypt(state.token)
    },
    actions: {
        set_processing(data) {
            this.processing = data;
        },
        set_keywords(data) {
            this.option.keywords = data;
        },
        set_rows(data) {
            this.option.rows = data;
        },
        set_page(data) {
            this.option.page = data;
        },
        tigger_modal(data) {
            this.option.show_modal = data;
        },
        set_sort(data) {
            this.option.sortBy = data.sortBy;
            this.option.sortOrder = data.sortOrder;
            this.option.page = 0;
        },
        // Helper to generate filters
        getFilters() {
            return {
                keyword: this.option.keywords,
                sortBy: this.option.sortBy,
                sortOrder: this.option.sortOrder,
                rows: this.option.rows,
                page: this.option.page || 1
            };
        },

        // Helper to handle CSRF
        async ensureCsrf() {
            try {
                await api.csrf();
            } catch (e) {
                this.error = e;
                this.toast.error('CSRF token error', { position: 'top-right' });
                throw e;
            }
        },

        // Centralized error handler
        handleError(e) {
            this.error = e;
            this.toast.add({ severity: 'error', summary: 'Notification', detail: e?.message, life: 3000 });
        },

        async fnFetch() {
            if (this.processing) return;
            this.processing = true;
            this.error = null;

            try {
                await this.ensureCsrf();
                const filters = this.getFilters();
                const { data } = await api.list(filters);
                this.token = data?.response_data;
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        },

        async fnStore(res) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;
            try {
                await this.ensureCsrf();
                const filters = this.getFilters();
                const { data } = await api.store({ head: filters, data: res });
                console.log('data', data);
                this.token = data?.response_data;
                this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Insert Success', life: 3000 });
                this.option.show_modal = false;
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        },

        async fnUpdate(id, res) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;

            try {
                await this.ensureCsrf();
                const filters = this.getFilters();
                const { data } = await api.update(id, { head: filters, data: res });
                this.token = data?.response_data;
                this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Updated Success', life: 3000 });
                this.option.show_modal = false;
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        },

        async fnDelete(id) {
            if (this.processing) return;
            this.processing = true;
            this.error = null;

            try {
                await this.ensureCsrf();
                const filters = this.getFilters();
                const { data } = await api.destroy2({ head: filters, id });
                this.token = data?.response_data;
                this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Deleted Success', life: 3000 });
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        }
    },
    persist: true
});
