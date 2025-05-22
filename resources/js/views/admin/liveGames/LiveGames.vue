<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useLiveGamesStore } from '@/stores/admin/useLiveGamesStore.js';
const { fnFetch, fnStore, fnUpdate, fnDelete, tigger_modal } = useLiveGamesStore();
const { error, processing, token, option } = storeToRefs(useLiveGamesStore());

import { useSabongConsoleStore } from '@/stores/admin/useSabongConsoleStore.js';
const { set_game } = useSabongConsoleStore();

onBeforeMount(async () => {
    await fnFetch();
});
const title = ref('Live Game');
const func = ref(null);
const select_id = ref(null);
const form = ref({
    game_present_id: null,
    game_name: null,
    event_name: null,
    total_round: 0,
    multiplier: 0,
    rate: 0,
    padding: 0
});
const assign_value = async (e) => {
    form.value.game_present_id = e?.game_present_id ?? null;
    form.value.game_name = e?.game_name ?? 'Sabong';
    form.value.event_name = e?.event_name ?? 'Derbi';
    form.value.total_round = e?.total_round ?? 300;
    form.value.multiplier = e?.multiplier ?? 1;
    form.value.rate = e?.rate ?? 5;
    form.value.padding = e?.padding ?? 1000000;
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

const show_control = (data) => {
    set_game(data.data);
};
</script>

<template>
    <div>
        <div className="card">
            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-6 md:col-span-6">
                    <h6 class="text-xl mb-5">{{ title }}</h6>
                </div>
                <div class="col-span-6 md:col-span-6 text-end">
                    <Button outlined severity="secondary" icon="pi pi-plus" v-tooltip.top="'Add New'" label="Add New" @click="open_modal(true)" />
                </div>
            </div>
            <div class="field">
                <DataTable :loading="processing" :value="token ? api.decrypt(token)['list']['data'] : []" :scrollable="true" :lazy="true" showGridlines tableStyle="min-width: 20rem" scrollDirection="both">
                    <Column field="game_present.code" header="Game Present" class="grid-table-line" />
                    <Column field="event_name" header="Event Name" class="grid-table-line" />
                    <Column field="game_name" header="Game Name" class="grid-table-line" />
                    <Column field="total_round" header="No. Round" class="grid-table-line" />
                    <Column field="multiplier" header="Multiplier" class="grid-table-line">
                        <template #body="data"> x{{ data.data.multiplier }} </template>
                    </Column>
                    <Column field="rate" header="Rake" class="grid-table-line">
                        <template #body="data"> {{ data.data.rate }}% </template>
                    </Column>
                    <Column field="padding" header="Padding Amount" class="grid-table-line" />
                    <Column field="created_at" header="Created Date" class="grid-table-line" />
                    <Column field="updated_at" header="Updated Date" class="grid-table-line" />
                    <Column field="actions" frozen alignFrozen="right" class="grid-table-line" style="width: 1%" headerStyle=" text-align: center" bodyStyle="text-align: center; overflow: visible">
                        <template #body="data">
                            <div class="text-end">
                                <Button text type="button" v-tooltip.top="'Edit'" @click="show_edit(data)" icon="pi pi-pencil" severity="info" size="small"></Button>
                                <Button text type="button" v-tooltip.top="'Control'" @click="show_control(data)" icon="pi pi-cog" severity="success" size="small"></Button>
                                <Button text type="button" v-tooltip.top="'End'" @click="show_edit(data)" icon="pi pi-trash" severity="danger" size="small"></Button>
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
                    <FloatText v-model="form.game_name" label="Game Name" name="game_name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.event_name" label="Event Name" name="event_name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.total_round" label="Total Round" name="total_round" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.multiplier" label="Multiplier" name="multiplier" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.rate" label="Rate" name="rate" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatNumber v-model="form.padding" label="Padding Amount" name="padding" :error="error" autofocus />
                </div>
            </div>
            <div class="flex items-center gap-2">
                <Button outlined :disabled="processing" :loading="processing" type="button" label="Cancel" severity="warn" @click="open_modal(false)"></Button>
                <Button outlined :disabled="processing" :loading="processing" type="button" label="Save" severity="success" @click="save()"></Button>
            </div>
        </Dialog>
    </div>
</template>
