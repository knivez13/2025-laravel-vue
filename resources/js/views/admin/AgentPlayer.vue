<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useAgentPlayerStore } from '@/stores/admin/useAgentPlayerStore.js';
const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, tigger_modal } = useAgentPlayerStore();
const { error, processing, token, option } = storeToRefs(useAgentPlayerStore());
const keyword = ref(null);
onBeforeMount(async () => {
    re_fetch();
    await fnFetch();
});
const title = ref('Agent & Player');
const func = ref(null);
const select_id = ref(null);
const form = ref({
    game_present_id: null,
    game_name: null,
    event_name: null,
    total_round: null,
    multiplier: null,
    game_name: null
});
const assign_value = async (e) => {
    form.value.game_present_id = e?.game_present_id ?? null;
    form.value.game_name = e?.game_name ?? null;
    form.value.event_name = e?.event_name ?? null;
    form.value.total_round = e?.total_round ?? null;
    form.value.multiplier = e?.multiplier ?? null;
    form.value.rate = e?.rate ?? null;
};

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
            <h6 class="text-xl mb-5">{{ title }}</h6>

            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-6 md:col-span-6">
                    <IconField>
                        <InputIcon>
                            <i class="fa fa-duotone fa-search" />
                        </InputIcon>
                        <InputText size="small" placeholder="Keyword Search" class="w-full" v-model="keyword" @keypress.enter="search()" />
                    </IconField>
                </div>
                <div class="col-span-6 md:col-span-6 text-end">
                    <Button size="small" outlined severity="secondary" icon="pi pi-plus" v-tooltip.top="'Add New'" label="Add New" @click="open_modal(true)" />
                </div>
            </div>
            <div class="field">
                <DataTable
                    v-model:sortField="option.sortBy"
                    v-model:rows="option.rows"
                    v-model:sortOrder="option.sortOrder"
                    v-model:totalRecords="api.decrypt(token)['list']['total']"
                    @page="fetch"
                    @sort="sort"
                    update:sortOrder
                    :loading="processing"
                    :value="api.decrypt(token)['list']['data']"
                    :scrollable="true"
                    :rowsPerPageOptions="[10, 20, 50, 100]"
                    :lazy="true"
                    :paginator="true"
                    paginatorTemplate=" FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink RowsPerPageDropdown"
                    currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                    showGridlines
                    tableStyle="min-width: 20rem"
                    scrollDirection="both"
                    size="small"
                >
                    <Column field="game_present.code" header="Game Present" class="grid-table-line" />
                    <Column field="event_name" sortable header="Event Name" class="grid-table-line" />
                    <Column field="game_name" sortable header="Game Name" class="grid-table-line" />
                    <Column field="total_round" sortable header="No. Round" class="grid-table-line" />
                    <Column field="multiplier" sortable header="Multiplier" class="grid-table-line">
                        <template #body="data"> x{{ data.data.multiplier }} </template>
                    </Column>
                    <Column field="rate" sortable header="Rake" class="grid-table-line">
                        <template #body="data"> {{ data.data.rate }}% </template>
                    </Column>
                    <Column field="created_at" sortable header="Created Date" class="grid-table-line" />
                    <Column field="updated_at" sortable header="Updated Date" class="grid-table-line" />
                    <Column field="actions" frozen alignFrozen="right" class="grid-table-line" style="width: 1%" headerStyle=" text-align: center" bodyStyle="text-align: center; overflow: visible">
                        <template #body="data">
                            <div class="text-end">
                                <Button size="small" text type="button" v-tooltip.top="'Edit'" @click="show_edit(data)" icon="pi pi-pencil" severity="info" class="h-8 w-8 mr-2"></Button>
                                <!-- <Button text type="button" v-tooltip.top="'Delete'" @click="destroy(data)" icon="pi pi-trash" class="h-8 w-8" severity="danger"></Button> -->
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
            position="center"
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
                    <FloatSelect v-model="form.game_present_id" label="Game Present" name="game_present_id" :options="api.decrypt(token)['game_present']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.game_name" label="game_name" name="game_name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.event_name" label="event_name" name="event_name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.total_round" label="total_round" name="total_round" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.multiplier" label="multiplier" name="multiplier" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.rate" label="rate" name="rate" :error="error" autofocus />
                </div>
            </div>
            <div class="flex items-center gap-2">
                <Button size="small" outlined :disabled="processing" :loading="processing" type="button" label="Cancel" severity="warn" @click="open_modal(false)"></Button>
                <Button size="small" outlined :disabled="processing" :loading="processing" type="button" label="Save" severity="success" @click="save()"></Button>
            </div>
        </Dialog>
    </div>
</template>
