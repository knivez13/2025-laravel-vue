import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
const api = new Resource('currency');

export const useRejectStore = defineStore('admin-property-management-reject', {
    state: () => ({
        token: null,
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
                $toast.error('CSRF token error', { position: 'top-right' });
                throw e;
            }
        },

        // Centralized error handler
        handleError(e) {
            this.error = e;
            $toast.error(e?.message || 'An error occurred', { position: 'top-right' });
        },

        async fnFetch() {
            if (this.processing) return;
            this.processing = true;
            this.error = null;

            try {
                await this.ensureCsrf();
                const filters = this.getFilters();
                const { data } = await api.list(filters);
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
                $toast.success(data.message, { position: 'top-right' });
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
                $toast.success(data.message, { position: 'top-right' });
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
                $toast.success(data.message, { position: 'top-right' });
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        }
    },
    persist: true
});
