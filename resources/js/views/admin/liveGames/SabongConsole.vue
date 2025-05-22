<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useSabongConsoleStore } from '@/stores/admin/useSabongConsoleStore.js';
const { fnShow, fnSelectRound, fnOpenRound, fnCloseRound, fnDeclareRound, fnCancelRound, fnNextRound, fnBetRound } = useSabongConsoleStore();
const { game, bet, round, option, sum } = storeToRefs(useSabongConsoleStore());

onBeforeMount(async () => {
    await fnShow();
});
const winner = ref([]);

const bets = computed(() => {
    try {
        return bet.value ? (api.decrypt(bet.value) ?? []) : [];
    } catch {
        return [];
    }
});
const rounds = computed(() => {
    try {
        return round.value ? (api.decrypt(round.value) ?? []) : [];
    } catch {
        return [];
    }
});
const games = computed(() => {
    try {
        return game.value ? (api.decrypt(game.value) ?? []) : [];
    } catch {
        return [];
    }
});
const sums = computed(() => {
    try {
        return sum.value ? (api.decrypt(sum.value) ?? []) : [];
    } catch {
        return [];
    }
});

const meron_id = computed(() => {
    try {
        return option.value ? (api.decrypt(option.value).filter((item) => item.code === 'MERON')[0]['id'] ?? null) : null;
    } catch {
        return null;
    }
});

const wala_id = computed(() => {
    try {
        return option.value ? (api.decrypt(option.value).filter((item) => item.code === 'WALA')[0]['id'] ?? null) : null;
    } catch {
        return null;
    }
});

const form = ref({
    game_list_id: null,
    game_round_id: null,
    current_round_id: null
});

const selectRound = async (data) => {
    form.value.game_list_id = data.data.game_list_id;
    form.value.game_round_id = data.data.id;
    await fnSelectRound(form.value);
};
const nextRound = async () => {
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    await fnNextRound(form.value);
};

const openRound = async () => {
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    await fnOpenRound(form.value);
};
const closeRound = async () => {
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    await fnCloseRound(form.value);
};
const selectWinner = async (data) => {
    console.log(data);
    winner.value = data;
};
const declareRound = async () => {
    console.log('declare');
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    form.value.win_option_id = winner.value.id;
    await fnDeclareRound(form.value);
    winner.value = [];
};
const cancelRound = async () => {
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    await fnCancelRound(form.value);
};
const betRound = async (option, amount) => {
    form.value.game_list_id = games.value['id'];
    form.value.current_round_id = games.value['current_round_id'];
    form.value.bet_option_id = option;
    form.value.bet_amount = amount;
    await fnBetRound(form.value);
};
</script>
<template>
    <div>
        <Fluid>
            <!-- {{ game ? api.decrypt(game) : [] }}
            <br />
            <br />
            {{ form }}
            <br />
            <br />
            {{ sums }} -->

            <div class="grid grid-cols-3 gap-1">
                <div class="col-span-3 md:col-span-1 gap-2">
                    <video class="w-full" controls>
                        <source src="movie.mp4" type="video/mp4" />
                        <source src="movie.ogg" type="video/ogg" />
                        Your browser does not support the video tag.
                    </video>
                    <!-- <div class="relative w-full aspect-video">
                        <iframe src="https://player.castr.com/ss_d4b5a93033f311f09128e9b6bc90400c" allowfullscreen frameborder="0" class="w-full h-full"></iframe>
                    </div> -->
                    <table class="table-fixed w-full mb-2 mt-2 card p-0 m-0">
                        <tbody>
                            <tr v-if="1 == 1">
                                <td style="width: 70%"><Button size="small" label="OPEN" severity="info" @click="openRound()" /></td>
                                <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="1 == 1">
                                <td style="width: 70%"><Button size="small" label="CLOSE" severity="info" @click="closeRound()" /></td>
                                <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="1 == 1">
                                <td colspan="2" style="width: 100%">
                                    <div class="mb-3">Select Main Bet Winners :{{ winner.code }}</div>
                                    <ButtonGroup class="w-full gap-2">
                                        <Button v-slot="slotProps" asChild v-for="item in api.decrypt(option)" :key="item.id">
                                            <button v-bind="slotProps.a11yAttrs" class="w-full rounded-lg px-5 py-3 text-white dark:text-black" :class="'bg-' + item.color + '-500'" @click="selectWinner(item)">{{ item.code }}</button>
                                        </Button>
                                    </ButtonGroup>
                                    <div class="mt-2">Select Side Bet Winners (If any)</div>
                                </td>
                            </tr>
                            <tr v-if="1 == 1">
                                <td style="width: 70%"><Button size="small" label="Declare" severity="info" @click="declareRound()" /></td>
                                <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="1 == 1">
                                <td colspan="2" style="width: 100%">
                                    <Button size="small" label="Next Round" severity="info" @click="nextRound()" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-3 md:col-span-1 gap-2">
                    <div class="grid grid-cols-2">
                        <div class="col-span-1 text-start">2 Bettors</div>
                        <div class="col-span-1 text-end">250,000</div>
                    </div>
                    <table class="w-full mb-2 text-white dark:text-black">
                        <td class="bg-red-500 justify-items-center">
                            <p class="text-2xl">MERON</p>
                            <p>150,000</p>
                            <p class="text-lg">(150,000)</p>
                            <p class="text-sm">x 1.62</p>
                        </td>
                        <td class="bg-blue-500 justify-items-center">
                            <p class="text-2xl">WALA</p>
                            <p>150,000</p>
                            <p class="text-lg">(150,000)</p>
                            <p class="text-sm">x 1.62</p>
                        </td>
                        <td class="bg-green-500 justify-items-center">
                            <p class="text-2xl">DRAW</p>
                            <p>150,000</p>
                            <p class="text-lg">(150,000)</p>
                            <p class="text-sm">x 1.62</p>
                        </td>
                    </table>
                    <table class="w-full mb-2">
                        <tr>
                            <th>
                                <div class="flex gap-2">
                                    <Button size="small" label="5k" severity="danger" @click="betRound(meron_id, 5000)" />
                                    <Button size="small" label="10k" severity="danger" @click="betRound(meron_id, 10000)" />
                                    <Button size="small" label="50k" severity="danger" @click="betRound(meron_id, 50000)" />
                                    <Button size="small" label="100k" severity="danger" @click="betRound(meron_id, 100000)" />
                                    <Button size="small" label="500k" severity="danger" @click="betRound(meron_id, 500000)" />
                                    <Button size="small" label="1M" severity="danger" @click="betRound(meron_id, 1000000)" />
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="flex gap-2">
                                    <Button size="small" label="5k" severity="info" @click="betRound(wala_id, 5000)" />
                                    <Button size="small" label="10k" severity="info" @click="betRound(wala_id, 10000)" />
                                    <Button size="small" label="50k" severity="info" @click="betRound(wala_id, 50000)" />
                                    <Button size="small" label="100k" severity="info" @click="betRound(wala_id, 100000)" />
                                    <Button size="small" label="500k" severity="info" @click="betRound(wala_id, 500000)" />
                                    <Button size="small" label="1M" severity="info" @click="betRound(wala_id, 1000000)" />
                                </div>
                            </th>
                        </tr>
                    </table>
                    <DataTable :value="bets" class="w-full mb-2" size="small">
                        <Column field="code" header="Name" class="grid-table-line"></Column>
                        <Column field="code" header="Login ID" class="grid-table-line"></Column>
                        <Column field="name" header="Bet Amount" class="grid-table-line"></Column>
                        <Column field="category" header="Option" class="grid-table-line"></Column>
                        <Column field="quantity" header="Balance" class="grid-table-line"></Column>
                    </DataTable>
                </div>
                <div class="col-span-3 md:col-span-1 gap-2">
                    <DataTable :value="rounds" class="w-full" size="small" scrollable scrollHeight="500px">
                        <Column field="round_no" header="#" class="grid-table-line"></Column>
                        <Column field="id" header="Action" class="grid-table-line">
                            <template #body="data">
                                <div>
                                    <Button text type="button" v-tooltip.top="'Select'" @click="selectRound(data)" icon="pi pi-download" severity="info" size="small"></Button>
                                    <!-- <Button text type="button" v-tooltip.top="'Lock'" @click="console.log(data)" icon="pi pi-lock" severity="info" size="small"></Button>
                                    <Button text type="button" v-tooltip.top="'Reset'" @click="console.log(data)" icon="pi pi-undo" severity="info" size="small"></Button> -->
                                </div>
                            </template>
                        </Column>
                        <Column field="status" header="Status" class="grid-table-line"></Column>
                        <Column field="win_option_id" header="Winner" class="grid-table-line"></Column>
                    </DataTable>
                </div>
            </div>
        </Fluid>
    </div>
</template>
