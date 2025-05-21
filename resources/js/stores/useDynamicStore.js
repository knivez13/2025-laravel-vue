// stores/helpers/createCrudStore.js
import { defineStore } from 'pinia';
import { useToast } from 'primevue/usetoast';
import Resource from '@/api/resource';

export default function createCrudStore(name, endpoint) {
    const api = new Resource(endpoint);

    return defineStore(name, {
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
            trigger_modal(data) {
                this.option.show_modal = data;
            },
            set_sort(data) {
                this.option.sortBy = data.sortBy;
                this.option.sortOrder = data.sortOrder;
                this.option.page = 0;
            },
            getFilters() {
                return {
                    keyword: this.option.keywords,
                    sortBy: this.option.sortBy,
                    sortOrder: this.option.sortOrder,
                    rows: this.option.rows,
                    page: this.option.page || 1
                };
            },
            async ensureCsrf() {
                try {
                    await api.csrf();
                } catch (e) {
                    this.error = e;
                    this.toast.error('CSRF token error', { position: 'top-right' });
                    throw e;
                }
            },
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
}
