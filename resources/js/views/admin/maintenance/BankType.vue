<script setup>
import Resource from '@/api/resource.js';
import { useBankTypeStore } from '@/stores/admin/maintenance/useBankTypeStore.js';
import { storeToRefs } from 'pinia';
import { ref, computed, onBeforeMount } from 'vue';

// API Resource
const api = new Resource('sample');

// Store Setup
const bankTypeStore = useBankTypeStore();
const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, trigger_modal } = bankTypeStore;
const { error, processing, token, option } = storeToRefs(bankTypeStore);

// UI State
const title = ref('Bank Type');
const keyword = ref(null);
const func = ref(null);
const selectId = ref(null);
const form = ref({ code: null, description: null });

// Computed
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

// Lifecycle
onBeforeMount(async () => {
    await resetTable();
    await fnFetch();
});

// Methods
const assignValue = (data = {}) => {
    form.value.code = data.code ?? null;
    form.value.description = data.description ?? null;
};

const resetTable = async () => {
    await set_keywords(null);
    await set_rows(10);
    await set_page(1);
    await set_sort({ sortBy: 'created_at', sortOrder: -1 });
    await set_processing(false);
};

const search = async () => {
    set_keywords(keyword.value);
    await set_page(0);
    await fnFetch();
};

const fetch = async ({ rows, page }) => {
    await set_rows(rows);
    await set_page(page + 1);
    await fnFetch();
};

const sort = async ({ sortField, sortOrder }) => {
    await set_sort({ sortBy: sortField, sortOrder });
    await fnFetch();
};

const openModal = async (show) => {
    func.value = 'Add New';
    assignValue();
    await trigger_modal(show);
};

const save = async () => {
    if (func.value === 'Add New') {
        await fnStore(form.value);
    } else if (func.value === 'Edit') {
        await fnUpdate(selectId.value, form.value);
    }
};

const showEdit = async (row) => {
    func.value = 'Edit';
    selectId.value = row.id;
    assignValue(row);
    await trigger_modal(true);
};

// Column config for reusable table
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
</script>

<template>
    <div>
        <div class="card">
            <h6 class="text-xl mb-5">{{ title }}</h6>

            <!-- Search & Add -->
            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-6">
                    <IconField>
                        <InputIcon><i class="fa fa-search" /></InputIcon>
                        <InputText size="small" class="w-full" placeholder="Keyword Search" v-model="keyword" @keypress.enter="search" />
                    </IconField>
                </div>
                <div class="col-span-6 text-end">
                    <Button size="small" outlined severity="secondary" icon="pi pi-plus" label="Add New" v-tooltip.top="'Add New'" @click="openModal(true)" />
                </div>
            </div>

            <!-- Table -->
            <div class="field">
                <VueDataTable :value="tableData" :loading="processing" :option="option" :totalRecords="totalRecords" :columns="columns" @page="fetch" @sort="sort">
                    <!-- Action Buttons -->
                    <template #actions="{ data }">
                        <div class="text-end">
                            <Button text size="small" icon="pi pi-pencil" severity="info" class="h-8 w-8 mr-2" v-tooltip.top="'Edit'" @click="showEdit(data)" />
                        </div>
                    </template>
                </VueDataTable>
            </div>
        </div>

        <!-- Dialog Modal -->
        <Dialog
            v-model:visible="option.show_modal"
            modal
            :closable="false"
            position="center"
            :draggable="false"
            :style="{ width: '30rem' }"
            :pt="{
                root: 'border-none',
                mask: { style: 'backdrop-filter: blur(10px)' }
            }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <div v-focustrap class="flex flex-col gap-4 w-full mb-2">
                <div class="font-semibold text-xl">{{ func }} {{ title }}</div>

                <FloatText v-model="form.code" label="Code" name="code" :error="error" autofocus />
                <FloatTextArea v-model="form.description" label="Description" name="description" rows="5" :error="error" />
            </div>

            <div class="flex items-center gap-2">
                <Button size="small" outlined type="button" label="Cancel" severity="warn" :disabled="processing" :loading="processing" @click="openModal(false)" />
                <Button size="small" outlined type="button" label="Save" severity="success" :disabled="processing" :loading="processing" @click="save" />
            </div>
        </Dialog>
    </div>
</template>
