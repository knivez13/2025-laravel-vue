<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useGamePresentStore } from '@/stores/admin/maintenance/useGamePresentStore.js';
const { fnFetch, fnStore, fnUpdate, fnDelete, set_keywords, set_processing, set_rows, set_page, set_sort, tigger_modal } = useGamePresentStore();
const { error, processing, token, option } = storeToRefs(useGamePresentStore());
const keyword = ref(null);
onBeforeMount(async () => {
    re_fetch();
    await fnFetch();
});
const title = ref('Game Present');
const func = ref(null);
const select_id = ref(null);
const form = ref({
    code: null,
    description: null,
    min_bet: 0,
    max_bet: 0,
    max_total_bet: 0,
    bet_opt_winner: 0,
    game_type_id: null,
    game_provider_id: null,
    live_one_id: null,
    live_two_id: null,
    live_three_id: null
});
const assign_value = async (e) => {
    form.value.code = e?.code ?? null;
    form.value.description = e?.description ?? null;
    form.value.min_bet = e?.min_bet ?? 0;
    form.value.max_bet = e?.max_bet ?? 0;
    form.value.max_total_bet = e?.max_total_bet ?? 0;
    form.value.bet_opt_winner = e?.bet_opt_winner ?? 0;
    form.value.game_type_id = e?.game_type_id ?? null;
    form.value.game_provider_id = e?.game_provider_id ?? null;
    form.value.live_one_id = e?.live_one_id ?? null;
    form.value.live_two_id = e?.live_two_id ?? null;
    form.value.live_three_id = e?.live_three_id ?? null;
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
                    :value="token ? api.decrypt(token)['list']['data'] : []"
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
                    <Column field="code" sortable header="Code" class="grid-table-line" />
                    <Column field="description" sortable header="Description" class="grid-table-line" />
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
                    <FloatSelect v-model="form.game_type_id" label="Game Type" name="game_type_id" :options="api.decrypt(token)['game_type']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.game_provider_id" label="Game Provider" name="game_provider_id" :options="api.decrypt(token)['game_provider']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.code" label="Code" name="code" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatTextArea v-model="form.description" label="Description" rows="5" name="description" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.min_bet" label="min_bet" name="min_bet" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.max_bet" label="max_bet" name="max_bet" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.max_total_bet" label="max_total_bet" name="max_total_bet" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.bet_opt_winner" label="bet_opt_winner" name="bet_opt_winner" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.live_one_id" label="live_one_id" name="live_one_id" :options="api.decrypt(token)['live_video']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.live_two_id" label="live_two_id" name="live_two_id" :options="api.decrypt(token)['live_video']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.live_three_id" label="live_three_id" name="live_three_id" :options="api.decrypt(token)['live_video']" optionLabel="code" optionValue="id" :error="error" />
                </div>
            </div>
            <div class="flex items-center gap-2">
                <Button size="small" outlined :disabled="processing" :loading="processing" type="button" label="Cancel" severity="warn" @click="open_modal(false)"></Button>
                <Button size="small" outlined :disabled="processing" :loading="processing" type="button" label="Save" severity="success" @click="save()"></Button>
            </div>
        </Dialog>
    </div>
</template>
