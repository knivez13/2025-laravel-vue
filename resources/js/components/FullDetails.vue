<script setup>
import { computed, ref } from 'vue';

const earnings = ref({
    mainBet: 640421.65,
    sideBet: 80.0,
    rake: 9.7,
    gross: 640501.65,
    agent: 639808.04,
    netProfit: 693.61
});

// Define game information fields structure
const gameInfo = ref({
    gameName: 'SGMC FEB 6',
    event: 'Online Cockfighting',
    rounds: '300',
    creationDate: '2025-02-06 08:25:34',
    status: 'ACTIVE',
    category: 'COCKFIGHT',
    type: 'TOTE',
    dateEnded: '2025-02-07 01:41:33'
});
// Define earnings cards structure
const earningsCards = computed(() => [
    {
        title: 'Main Bet Earnings',
        value: earnings.value.mainBet,
        icon: 'pi-dollar',
        color: 'text-orange-500',
        description: 'Earnings from Main Bets'
    },
    {
        title: 'Side Bet Earnings',
        value: earnings.value.sideBet,
        icon: 'pi-percentage',
        color: 'text-purple-500',
        description: 'Earnings from Side Bets'
    },
    {
        title: 'Rake',
        value: earnings.value.rake,
        icon: 'pi-percentage',
        color: 'text-yellow-500',
        description: 'House Rake Percentage',
        isPercentage: true
    },
    {
        title: 'Gross Earnings',
        value: earnings.value.gross,
        icon: 'pi-chart-line',
        color: 'text-blue-500',
        description: 'Total Gross Earnings from this Game'
    },
    {
        title: 'Agent Earnings',
        value: earnings.value.agent,
        icon: 'pi-user',
        color: 'text-pink-500',
        description: 'Agent Commission Earned'
    },
    {
        title: 'Net Profit',
        value: earnings.value.netProfit,
        icon: 'pi-chart-bar',
        color: 'text-green-500',
        description: 'Total Net Profit from this Game'
    }
]);
const transactions = ref([
    {
        id: 27854,
        number: '254',
        gross: '2,177.85',
        agent: '2,175.52',
        net: '2.33',
        view: 'VIEW',
        action: '2025-02-07 01:41:56'
    },
    {
        id: 27849,
        number: '249',
        gross: '',
        agent: '',
        net: '',
        view: 'VIEW',
        action: '2025-02-07 01:41:56'
    }
]);
const formatNumber = (value, isPercentage = false) => {
    if (isPercentage) return `${value}%`;
    return value.toLocaleString('en-US', { minimumFractionDigits: 2 });
};

const visible = ref(false);
</script>

<template>
    <div class="w-full p-2 text-white">
        <div class="flex flex-col lg:flex-row gap-2">
            <!-- Header with Back Button -->
            <div class="card p-2 w-full lg:w-2/4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-white text-lg mr-4">Game Information</h2>
                    <Button label="BACK" severity="info" class="p-button-sm" />
                </div>

                <div class="text-sm">
                    <!-- Information Grid -->
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                        <!-- Left Column -->
                        <div class="space-y-2">
                            <div class="flex justify-between w-full">
                                <span class="w-1/2 text-gray-400">Game Name:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.gameName }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="w-1/2 text-gray-400">Event:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.event }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="w-1/2 text-gray-400">Rounds:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.rounds }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="w-1/2 text-gray-400">Creation Date:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.creationDate }}</span>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-2">
                            <div class="flex justify-between w-full">
                                <span class="w-1/2 text-gray-400">Status:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.status }}</span>
                            </div>
                            <div class="flex justify-between w-full">
                                <span class="w-1/2 text-gray-400">Category:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.category }}</span>
                            </div>
                            <div class="flex justify-between w-full">
                                <span class="w-1/2 text-gray-400">Type:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.type }}</span>
                            </div>
                            <div class="flex justify-between w-full">
                                <span class="w-1/2 text-gray-400">Date Ended:</span>
                                <span class="w-1/2 text-white">{{ gameInfo.dateEnded }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full lg:w-3/4">
                <div v-for="card in earningsCards" :key="card.title" class="">
                    <div class="card p-2 w-full">
                        <div class="flex items-center text-gray-400 mb-2">
                            <i :class="['pi', card.icon, 'mr-2']"></i>
                            <span class="text-lg text-white">{{ card.title }}</span>
                        </div>
                        <div class="text-lg text-gray-400">{{ card.description }}</div>
                        <div :class="['text-3xl', card.color]">
                            {{ formatNumber(card.value, card.isPercentage) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mt-2">
            <DataTable :value="transactions" class="card p-2 text-gray-200 rounded-lg" responsiveLayout="scroll" :rows="10" :paginator="true">
                <Column field="id" header="ID" />
                <Column field="number" header="#">
                    <template #body="slotProps">
                        <span class="font-bold">{{ slotProps.data.number }}</span>
                    </template>
                </Column>
                <Column field="gross" header="Gross Earnings">
                    <template #body="slotProps">
                        <span :class="slotProps.data.gross ? 'text-blue-500 font-bold' : 'text-white font-bold'">
                            {{ slotProps.data.gross || '0.00' }}
                        </span>
                    </template>
                </Column>
                <Column field="agent" header="Agent Earnings">
                    <template #body="slotProps">
                        <span :class="slotProps.data.agent ? 'text-pink-700 font-bold' : 'text-white font-bold'">
                            {{ slotProps.data.agent || '0.00' }}
                        </span>
                    </template>
                </Column>
                <Column field="net" header="Net Earnings">
                    <template #body="slotProps">
                        <div class="flex items-center">
                            <span :class="slotProps.data.net ? 'text-green-500 font-bold' : 'text-white font-bold'">
                                {{ slotProps.data.net || '0.00' }}
                            </span>
                        </div>
                    </template>
                </Column>
                <Column field="view" header="View">
                    <template #body="slotProps">
                        <button class="bg-blue-500 p-2 rounded-lg" @click="visible = true">
                            {{ slotProps.data.view }}
                        </button>
                    </template>
                </Column>
                <Column field="action" header="Last Action">
                    <template #body="slotProps">
                        <span>
                            {{ slotProps.data.action }}
                        </span>
                    </template></Column
                >
            </DataTable>
        </div>
    </div>
    <Dialog v-model:visible="visible" maximizable modal header="Round Details" headerClass="!bg-red-600 !text-white" :style="{ width: '85rem', height: '85rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
        <div>
            <div class="flex items-center gap-2">
                <div class="bg-zinc-800 p-3 h-28 w-full text-white font-bold text-lg">
                    <h2>Round ID</h2>
                    <span>38181</span>
                    <p>#81</p>
                </div>
                <div class="bg-zinc-800 p-3 h-28 w-full">
                    <h2 class="text-white font-bold text-lg">Round Status</h2>
                    <div class="flex items-center gap-2">
                        <h2>LOCKED</h2>
                        <p>HISTORY</p>
                    </div>
                    <p>AT 2025-02-24 20:47:13</p>
                </div>
            </div>
            <div class="bg-[#2D2A15] flex flex-col justify-center items-center my-2 p-2">
                <h2 class="text-[#FFEA3B] font-bold text-lg">Winning Result</h2>
                <span class="text-[#FFEA3B] text-5xl">MERON</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="bg-zinc-800 p-2 w-full">
                    <h2 class="text-white font-bold text-lg">Gross Earnings</h2>
                    <span class="font-bold text-2xl text-sky-600">2,214.92</span>
                </div>
                <div class="bg-zinc-800 p-2 w-full">
                    <h2 class="text-white font-bold text-lg">Agent Earnings</h2>
                    <span class="font-bold text-2xl text-pink-600">2,214.92</span>
                </div>
                <div class="bg-zinc-800 p-2 w-full">
                    <h2 class="text-white font-bold text-lg">Net Profit</h2>
                    <span class="font-bold text-2xl text-green-600">2,214.92</span>
                </div>
            </div>

            <div class="card p-2 bg-zinc-800 my-2">
                <div class="flex items-center justify-between">
                    <h2>Bets and Agent Earnings</h2>
                    <span>3 Winner(s)</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-between w-1/2">
                        <h2>User Bets</h2>
                        <span>Total Bets: P22,834.00</span>
                    </div>

                    <div class="flex items-center justify-between w-1/2">
                        <h2>Agent Earnings</h2>
                        <span>Total Bets: P2,214.00</span>
                    </div>
                </div>
            </div>
        </div>
    </Dialog>
</template>

<style scoped>
:deep(.p-dialog-header) {
    background-color: red !important;
    color: white !important;
}
</style>
