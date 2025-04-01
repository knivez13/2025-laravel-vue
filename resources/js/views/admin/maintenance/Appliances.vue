<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useAppliancesStore } from '@/stores/admin/maintenance/useAppliancesStore.js';
const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, tigger_modal } = useAppliancesStore();
const { error, processing, token, option } = storeToRefs(useAppliancesStore());
const keyword = ref(null);
onBeforeMount(async () => {
    re_fetch();
    await fnFetch();
});
const title = ref('Appliances');
const func = ref(null);
const select_id = ref(null);
const form = ref({
    code: null,
    description: null
});

const search = async () => {
    set_keywords(keyword.value);
    await set_page(0);
    await fnFetch();
};

const re_fetch = async (event) => {
    await set_keywords(null);
    await set_rows(10);
    await set_page(1);
    await set_sort({
        sortBy: 'created_at',
        sortOrder: -1
    });
    await set_processing(false);
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
const open_modal = async (data) => {
    func.value = 'Add New';
    assign_value();
    await tigger_modal(data);
};

const save = async (data) => {
    if (func.value == 'Add New') {
        await fnStore(form.value);
    }
    if (func.value == 'Edit') {
        await fnUpdate(select_id.value, form.value);
    }
};
const assign_value = async (e) => {
    form.value.code = e?.code ?? null;
    form.value.description = e?.description ?? null;
};

const show_edit = async (data) => {
    func.value = 'Edit';
    select_id.value = data.data.id;
    assign_value(data.data);
    await tigger_modal(true);
};
</script>

<template>
    <div>
        <div className="card">
            <h6 class="text-xl mb-1">{{ title }}</h6>

            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-6 md:col-span-6">
                    <IconField>
                        <InputIcon>
                            <i class="fa fa-duotone fa-search" />
                        </InputIcon>
                        <InputText placeholder="Keyword Search" class="w-full" v-model="keyword" @keypress.enter="search()" />
                    </IconField>
                </div>
                <div class="col-span-6 md:col-span-6 text-end">
                    <Button outlined severity="secondary" icon="pi pi-plus" v-tooltip.top="'Add New'" label="Add New" @click="open_modal(true)" />
                </div>
            </div>
            <div class="field">
                <DataTable
                    v-model:sortField="option.sortBy"
                    v-model:rows="option.rows"
                    v-model:sortOrder="option.sortOrder"
                    v-model:totalRecords="api.decrypt(token)['total']"
                    @page="fetch"
                    @sort="sort"
                    update:sortOrder
                    :loading="processing"
                    :value="api.decrypt(token)['data']"
                    :scrollable="true"
                    :rowsPerPageOptions="[10, 20, 50, 100]"
                    :lazy="true"
                    :paginator="true"
                    paginatorTemplate=" FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink RowsPerPageDropdown"
                    currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                    showGridlines
                    tableStyle="min-width: 20rem"
                    scrollDirection="both"
                >
                    <Column field="code" sortable header="Code"></Column>
                    <Column field="description" sortable header="Description"></Column>
                    <Column field="created_at" sortable header="Created Date"></Column>
                    <Column field="updated_at" sortable header="Updated Date"></Column>
                    <Column field="actions" frozen alignFrozen="right" class="grid-table-line" style="width: 100px" headerStyle="width: 5rem; text-align: center" bodyStyle="text-align: center; overflow: visible">
                        <template #body="data">
                            <div class="text-end">
                                <Button text type="button" v-tooltip.top="'Edit'" @click="show_edit(data)" icon="pi pi-pencil" severity="info" class="h-8 w-8 mr-2"></Button>
                                <Button text type="button" v-tooltip.top="'Delete'" @click="destroy(data)" icon="pi pi-trash" class="h-8 w-8" severity="danger"></Button>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
        <Dialog
            v-model:visible="option.show_modal"
            modal
            :closable="false"
            position="top"
            :draggable="false"
            :style="{ width: '30rem' }"
            :pt="{
                root: 'border-none',
                mask: {
                    style: 'backdrop-filter: blur(10px)'
                }
            }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <div v-focustrap class="flex flex-col gap-4 w-full mb-2">
                <div class="font-semibold text-xl">{{ func }} {{ title }}</div>

                <div class="flex flex-col gap-2 w-full">
                    <label class="block font-semibold">Code</label>
                    <InputText v-model="form.code" type="text" autofocus :invalid="error?.status == 422 && error?.validation['code']" />
                    <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['code']">{{ error.validation['code'] }}</small>
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <label class="block font-semibold">Description</label>
                    <Textarea v-model="form.description" rows="5" :invalid="error?.status == 422 && error?.validation['description']" />
                    <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <Button outlined :disabled="processing" :loading="processing" type="button" label="Cancel" severity="warn" @click="open_modal(false)"></Button>
                <Button outlined :disabled="processing" :loading="processing" type="button" label="Save" severity="success" @click="save()"></Button>
            </div>
        </Dialog>
    </div>
</template>
