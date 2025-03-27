<script setup>
import { ref } from 'vue';

// Example data for PrimeVue DataTable
const bettors = ref([
    { user: 'User1', bet: 50, team: 'TeamA', balance: 150 },
    { user: 'User2', bet: 100, team: 'TeamB', balance: 200 }
    // Add more data as needed
]);

// Example template for PrimeVue DataTable column
const teamTemplate = ({ data }) => {
    return `<span class="text-${data.team === 'TeamA' ? 'blue' : 'green'}">${data.team}</span>`;
};
</script>

<template>
    <div class="grid grid-cols gap-4">
        <div class="border-none rounded-none text-white">
            <div class="card-header flex justify-between items-center">
                <div class="flex items-center">
                    <i class="pi pi-users text-blue-500 mr-2"></i>
                    <span>1 Bettors</span>
                </div>
                <div>Total Bets: <span class="text-yellow-500">200.00</span></div>
            </div>
            <div class="grid grid-cols-2">
                <div class="bg-red-600 text-center py-2">
                    <div class="text-lg">MERON</div>
                    <div class="text-xl font-bold">100.00</div>
                    <div class="font-semibold">(100.00)</div>
                    <div class="text-sm">x1.84</div>
                </div>
                <div class="bg-blue-600 text-center py-2">
                    <div class="text-lg">WALA</div>
                    <div class="text-xl font-bold">100.00</div>
                    <div class="font-semibold">(100.00)</div>
                    <div class="text-sm">x1.84</div>
                </div>
            </div>
            <DataTable :value="bettors" :paginator="true" :rows="10">
                <Column field="user" header="Users"></Column>
                <Column field="bet" header="Bet" class="text-yellow-500"></Column>
                <Column field="team" header="Team" :body="teamTemplate"></Column>
                <Column field="balance" header="Balance"></Column>
            </DataTable>
        </div>
    </div>
</template>

<style scoped>
/* Scoped styles */
</style>
