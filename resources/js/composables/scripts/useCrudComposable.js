// composables/useCrudComposable.js
import { ref, computed, onBeforeMount } from 'vue';
import Resource from '@/api/resource';
import { storeToRefs } from 'pinia';

export default function useCrudComposable(resourceName, useStore, columnsDef, formDef, titleLabel = '', formFieldDefinition = [], roles = []) {
    const api = new Resource(resourceName);
    const store = useStore();

    const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, set_role, trigger_modal } = store;

    const { error, processing, token, option } = storeToRefs(store);

    const keyword = ref(null);
    const title = ref(titleLabel || resourceName);
    const func = ref(null);
    const select_id = ref(null);
    const form = ref({ ...formDef });

    const assignValue = (e = {}) => {
        for (const key in formDef) {
            form.value[key] = e[key] ?? null;
        }
    };

    const tableData = computed(() => {
        try {
            return token.value ? (api.decrypt(token.value)?.list?.data ?? []) : [];
        } catch {
            return [];
        }
    });

    const dropdownData = computed(() => {
        try {
            return token.value ? (api.decrypt(token.value)?.dropdown ?? []) : [];
        } catch {
            return [];
        }
    });

    const totalRecords = computed(() => {
        try {
            return token.value ? (api.decrypt(token.value)?.list?.total ?? 0) : 0;
        } catch {
            return 0;
        }
    });

    const search = async () => {
        set_keywords(keyword.value);
        set_page(0);
        await fnFetch();
    };

    const resetTable = async () => {
        set_keywords(null);
        set_rows(10);
        set_page(1);
        set_sort({ sortBy: 'created_at', sortOrder: -1 });
        set_processing(false);
    };

    const fetch = async (event) => {
        set_rows(event.rows);
        set_page(event.page + 1);
        await fnFetch();
    };

    const sort = async (event) => {
        await set_sort({ sortBy: event.sortField, sortOrder: event.sortOrder });
        await fnFetch();
    };

    const openModal = async (data) => {
        func.value = 'Add New';
        assignValue();
        await trigger_modal(data);
    };

    const save = async () => {
        if (func.value === 'Add New') {
            await fnStore(form.value);
        } else if (func.value === 'Edit') {
            await fnUpdate(select_id.value, form.value);
        }
    };

    const showEdit = async (data) => {
        func.value = 'Edit';
        select_id.value = data.id;
        assignValue(data);
        trigger_modal(true);
    };

    onBeforeMount(async () => {
        set_role(roles);
        await resetTable();
        await fnFetch();
    });

    return {
        keyword,
        form,
        func,
        title,
        error,
        processing,
        option,
        tableData,
        totalRecords,
        columns: columnsDef,
        search,
        resetTable,
        fetch,
        sort,
        save,
        openModal,
        showEdit,
        dropdownData,
        formFieldDefinition: formFieldDefinition
    };
}
