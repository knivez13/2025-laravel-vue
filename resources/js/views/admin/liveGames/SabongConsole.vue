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
    form.value.game_list_id = games.value['id'];
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

const formatNumber = (num) => {
    if (num >= 1_000_000) {
        return (num / 1_000_000).toFixed(num % 1_000_000 === 0 ? 0 : 2) + 'M';
    } else if (num >= 1_000) {
        return (num / 1_000).toFixed(num % 1_000 === 0 ? 0 : 2) + 'K';
    }
    return num.toString();
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
            <!-- {{ form }} -->

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
                            <tr>
                                <td>
                                    Status:
                                    <span v-if="games?.current_round?.status == 0">Live</span>
                                    <span v-if="games?.current_round?.status == 1">Live</span>
                                    <span v-if="games?.current_round?.status == 2">Open</span>
                                    <span v-if="games?.current_round?.status == 3">Close</span>
                                    <span v-if="games?.current_round?.status == 4">Declared</span>
                                    <span v-if="games?.current_round?.status == 5">Cancelled</span>
                                    <span v-if="games?.current_round?.status == 6">Locked</span>
                                    <span v-if="games?.current_round?.status == 7">Reset</span>
                                </td>
                                <td>
                                    <span v-if="games?.current_round?.round_no">Round #: {{ games?.current_round?.round_no }}</span>
                                </td>
                            </tr>
                            <tr v-if="games?.current_round?.status == 1">
                                <td style="width: 70%"><Button size="small" :disabled="games?.current_round?.status != 1" label="OPEN" severity="info" @click="openRound()" /></td>
                                <td style="width: 30%"><Button size="small" :disabled="games?.current_round?.status != 1" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="games?.current_round?.status == 2">
                                <td style="width: 70%"><Button size="small" :disabled="games?.current_round?.status != 2" label="CLOSE" severity="info" @click="closeRound()" /></td>
                                <td style="width: 30%"><Button size="small" :disabled="games?.current_round?.status != 2" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="games?.current_round?.status == 3 || games?.current_round?.status == 7">
                                <td colspan="2" style="width: 100%">
                                    <div class="mb-3">Select Main Bet Winners :{{ winner.code }}</div>
                                    <ButtonGroup class="w-full gap-2" :disabled="games?.current_round?.status != 3">
                                        <Button v-slot="slotProps" asChild v-for="item in api.decrypt(option)" :key="item.id">
                                            <button v-bind="slotProps.a11yAttrs" class="w-full rounded-lg px-5 py-3 text-white dark:text-black" :class="'bg-' + item.color + '-500'" @click="selectWinner(item)">{{ item.code }}</button>
                                        </Button>
                                    </ButtonGroup>
                                    <div class="mt-2">Select Side Bet Winners (If any)</div>
                                </td>
                            </tr>
                            <tr v-if="games?.current_round?.status == 3 || games?.current_round?.status == 7">
                                <td style="width: 70%"><Button size="small" label="Declare" severity="info" @click="declareRound()" /></td>
                                <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" @click="cancelRound()" /></td>
                            </tr>
                            <tr v-if="games?.current_round?.status == 4">
                                <td colspan="2" style="width: 100%">
                                    <Button size="small" :disabled="games?.current_round?.status != 4" label="Next Round" severity="info" @click="nextRound()" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-3 md:col-span-1 gap-2">
                    <div class="grid grid-cols-2">
                        <div class="col-span-1 text-start">2 Bettors</div>
                        <div class="col-span-1 text-end">{{ (games?.current_round?.total_draw ?? 0) + (games?.current_round?.total_wala ?? 0) + (games?.current_round?.total_meron ?? 0) }}</div>
                    </div>
                    <table class="w-full mb-2 text-white dark:text-black">
                        <tbody>
                            <tr>
                                <td class="bg-red-500 justify-items-center">
                                    <p class="text-2xl">MERON</p>
                                    <p>{{ formatNumber((games?.current_round?.total_meron ?? 0) * games?.multiplier) }}</p>
                                    <p class="text-lg">({{ formatNumber(games?.current_round?.total_meron ?? 0) }})</p>
                                    <p class="text-sm">x{{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(games?.current_round?.ods_meron) }}</p>
                                </td>
                                <td class="bg-blue-500 justify-items-center">
                                    <p class="text-2xl">WALA</p>
                                    <p>{{ formatNumber((games?.current_round?.total_wala ?? 0) * games?.multiplier) }}</p>
                                    <p class="text-lg">({{ formatNumber(games?.current_round?.total_wala ?? 0) }})</p>
                                    <p class="text-sm">x{{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(games?.current_round?.ods_wala) }}</p>
                                </td>
                                <td class="bg-green-500 justify-items-center">
                                    <p class="text-2xl">DRAW</p>
                                    <p>{{ formatNumber((games?.current_round?.total_draw ?? 0) * games?.multiplier) }}</p>
                                    <p class="text-lg">({{ formatNumber(games?.current_round?.total_draw ?? 0) }})</p>
                                    <p class="text-sm">x0</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-full mb-2" v-if="games?.current_round?.status == 2">
                        <tbody>
                            <tr>
                                <th>
                                    <div class="flex gap-2">
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="5k" severity="danger" @click="betRound(meron_id, 5000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="10k" severity="danger" @click="betRound(meron_id, 10000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="50k" severity="danger" @click="betRound(meron_id, 50000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="100k" severity="danger" @click="betRound(meron_id, 100000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="500k" severity="danger" @click="betRound(meron_id, 500000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="1M" severity="danger" @click="betRound(meron_id, 1000000)" />
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="flex gap-2">
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="5k" severity="info" @click="betRound(wala_id, 5000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="10k" severity="info" @click="betRound(wala_id, 10000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="50k" severity="info" @click="betRound(wala_id, 50000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="100k" severity="info" @click="betRound(wala_id, 100000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="500k" severity="info" @click="betRound(wala_id, 500000)" />
                                        <Button :disabled="games?.current_round?.status !== 2" size="small" label="1M" severity="info" @click="betRound(wala_id, 1000000)" />
                                    </div>
                                </th>
                            </tr>
                        </tbody>
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
                        <Column header="Action" class="grid-table-line">
                            <template #body="data">
                                <div>
                                    <Button variant="outlined" disabled v-if="![0, 4, 6, 7].includes(data.data.status)" label="Current" icon="pi pi-download" severity="secondary" size="small"></Button>

                                    <Button variant="outlined" v-if="data.data.status == 0" label="Select" v-tooltip.top="'Select'" @click="selectRound(data)" icon="pi pi-download" severity="help" size="small"></Button>
                                    <Button variant="outlined" v-if="data.data.status == 4" label="Lock" v-tooltip.top="'Lock'" @click="console.log(data)" icon="pi pi-lock" severity="warn" size="small"></Button>
                                </div>
                            </template>
                        </Column>
                        <Column field="status" header="Status" class="grid-table-line">
                            <template #body="data">
                                <span v-if="data.data.status == 0" class="text-purple-500">Idle</span>
                                <span v-if="data.data.status == 1" class="text-blue-500">Live</span>
                                <span v-if="data.data.status == 2" class="text-yellow-500">Open</span>
                                <span v-if="data.data.status == 3" class="text-green-500">Close</span>
                                <span v-if="data.data.status == 4" class="text-gray-500">Declared</span>
                                <span v-if="data.data.status == 5" class="text-purple-500">Cancelled</span>
                                <span v-if="data.data.status == 6" class="text-orange-500">Locked</span>
                                <span v-if="data.data.status == 7" class="text-pink-500">Reset</span>
                            </template>
                        </Column>
                        <Column field="win_option_id" header="Winner" class="grid-table-line">
                            <template #body="data">
                                {{ data.data?.game_option?.code ?? '' }}
                            </template>
                        </Column>
                        <Column header="More" class="grid-table-line">
                            <template #body="data">
                                <Button text type="button" v-if="data.data.status == 4" v-tooltip.top="'Reset'" @click="console.log(data)" icon="pi pi-undo" severity="info" size="small"></Button>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </Fluid>
    </div>
</template>
