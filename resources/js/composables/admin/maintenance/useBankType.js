import { ref, computed, onBeforeMount } from 'vue';
import Resource from '@/api/resource.js';
import { useBankTypeStore } from '@/stores/admin/maintenance/useBankTypeStore.js';
import { storeToRefs } from 'pinia';

const api = new Resource('sample');

export default function useBankType() {
    const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, trigger_modal } = useBankTypeStore();
    const { error, processing, token, option } = storeToRefs(useBankTypeStore());
    const keyword = ref(null);
    const title = ref('Bank Type');
    const func = ref(null);
    const select_id = ref(null);
    const form = ref({
        code: null,
        description: null
    });

    const tableData = computed(() => {
        try {
            return token.value ? (api.decrypt(token.value)?.list?.data ?? []) : [];
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

    const assignValue = (e = {}) => {
        form.value.code = e.code ?? null;
        form.value.description = e.description ?? null;
    };

    const search = async () => {
        set_keywords(keyword.value);
        await set_page(0);
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
        await set_rows(event.rows);
        await set_page(event.page + 1);
        await fnFetch();
    };

    const sort = async (event) => {
        await set_sort({
            sortBy: event.sortField,
            sortOrder: event.sortOrder
        });
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
        await trigger_modal(true);
    };

    const columns = [
        { field: 'code', header: 'Code', sortable: true, class: 'grid-table-line' },
        { field: 'description', header: 'Description', sortable: true, class: 'grid-table-line' },
        { field: 'created_at', header: 'Created Date', sortable: true, class: 'grid-table-line' },
        { field: 'updated_at', header: 'Updated Date', sortable: true, class: 'grid-table-line' },
        {
            field: 'actions',
            header: '',
            frozen: true,
            alignFrozen: 'right',
            class: 'grid-table-line',
            style: 'width: 1%',
            headerStyle: 'text-align: center',
            bodyStyle: 'text-align: center; overflow: visible'
        }
    ];

    onBeforeMount(async () => {
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
        columns,
        search,
        resetTable,
        fetch,
        sort,
        save,
        openModal,
        showEdit
    };
}
