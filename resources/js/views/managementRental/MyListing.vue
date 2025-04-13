<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useAmenityStore } from '@/stores/admin/maintenance/useAmenityStore.js';
const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, tigger_modal } = useAmenityStore();
const { error, processing, token, option } = storeToRefs(useAmenityStore());
const keyword = ref(null);
onBeforeMount(async () => {
    re_fetch();
    await fnFetch();
});
const title = ref('Property Listing');
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
                    <Button outlined severity="secondary" icon="pi pi-plus" v-tooltip.top="'Add New'" label="Add New" @click="$router.push('/manage-rental/create-property')" />
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
                    <Column field="code" sortable header="Code">
                        <template #body="data">
                            <Image src="https://www.livehome3d.com/assets/img/articles/design-house/how-to-design-a-house.jpg" alt="Image" class="h-full object-cover" width="64" preview cl />
                        </template>
                    </Column>
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
    </div>
</template>
