import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
const api = new Resource('maintenance/amenities');
import { useToast } from 'primevue/usetoast';

export const useAmenityStore = defineStore('admin-maintenance-amenity', {
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
            total: 0,
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
    },
    actions: {
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
                const { data } = await api.list();
                console.log(data); // Replace with actual data handling logic
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
                console.log(data); // Replace with actual success handling logic
                this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Insert Success', life: 3000 });
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
                console.log(data); // Replace with actual success handling logic
                this.toast.add({ severity: 'success', summary: 'Notification', detail: 'Updated Success', life: 3000 });
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
                console.log(data); // Replace with actual success handling logic
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
