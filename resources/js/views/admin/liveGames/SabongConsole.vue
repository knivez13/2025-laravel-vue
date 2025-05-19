<script setup>
import Resource from '@/api/resource.js';
const api = new Resource('sample');
import { useLiveGamesStore } from '@/stores/admin/useLiveGamesStore.js';
const { fnFetch } = useLiveGamesStore();
const { error, processing, gameConsole } = storeToRefs(useLiveGamesStore());

const form = ref();
</script>

<template>
    <div>
        <Fluid>
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
                        <tr v-if="1 == 2">
                            <td style="width: 70%"><Button size="small" label="OPEN" severity="info" /></td>
                            <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" /></td>
                        </tr>
                        <tr v-if="1 == 2">
                            <td style="width: 70%"><Button size="small" label="CLOSE" severity="info" /></td>
                            <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" /></td>
                        </tr>
                        <tr v-if="1 == 1">
                            <td colspan="2" style="width: 100%">
                                <div class="mb-3">Select Main Bet Winners</div>
                                <ButtonGroup class="w-full gap-2">
                                    <Button v-slot="slotProps" asChild>
                                        <button v-bind="slotProps.a11yAttrs" class="w-full rounded-lg px-5 py-3 text-white dark:text-black bg-red-500">MERON</button>
                                    </Button>
                                    <Button v-slot="slotProps" asChild>
                                        <button v-bind="slotProps.a11yAttrs" class="w-full rounded-lg px-5 py-3 text-white dark:text-black bg-blue-500">WALA</button>
                                    </Button>
                                    <Button v-slot="slotProps" asChild>
                                        <button v-bind="slotProps.a11yAttrs" class="w-full rounded-lg px-5 py-3 text-white dark:text-black bg-green-500">DRAW</button>
                                    </Button>
                                </ButtonGroup>
                                <div class="mt-2">Select Side Bet Winners (If any)</div>
                            </td>
                        </tr>
                        <tr v-if="1 == 1">
                            <td style="width: 70%"><Button size="small" label="Declare" severity="info" /></td>
                            <td style="width: 30%"><Button size="small" label="Cancel" severity="danger" /></td>
                        </tr>
                        <tr v-if="1 == 2">
                            <td colspan="2" style="width: 100%">
                                <Button size="small" label="Next Round" severity="info" />
                            </td>
                        </tr>
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
                                    <Button size="small" label="5k" severity="danger" />
                                    <Button size="small" label="10k" severity="danger" />
                                    <Button size="small" label="50k" severity="danger" />
                                    <Button size="small" label="100k" severity="danger" />
                                    <Button size="small" label="500k" severity="danger" />
                                    <Button size="small" label="1M" severity="danger" />
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="flex gap-2">
                                    <Button size="small" label="5k" severity="info" />
                                    <Button size="small" label="10k" severity="info" />
                                    <Button size="small" label="50k" severity="info" />
                                    <Button size="small" label="100k" severity="info" />
                                    <Button size="small" label="500k" severity="info" />
                                    <Button size="small" label="1M" severity="info" />
                                </div>
                            </th>
                        </tr>
                    </table>
                    <DataTable :value="[]" class="w-full mb-2" size="small">
                        <Column field="code" header="Name"></Column>
                        <Column field="code" header="Login ID"></Column>
                        <Column field="name" header="Bet Amount"></Column>
                        <Column field="category" header="Option"></Column>
                        <Column field="quantity" header="Balance"></Column>
                    </DataTable>
                </div>
                <div class="col-span-3 md:col-span-1 gap-2">
                    <DataTable :value="[]" class="w-full" size="small">
                        <Column field="code" header="#"></Column>
                        <Column field="name" header="Action"></Column>
                        <Column field="category" header="Status"></Column>
                        <Column field="quantity" header="Winner"></Column>
                        <Column field="quantity" header="Other"></Column>
                    </DataTable>
                </div>
            </div>
        </Fluid>
    </div>
</template>
