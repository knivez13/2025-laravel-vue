<script setup>
import { useLayout } from '@/layout/composables/layout';
import { computed, onMounted, ref, watch } from 'vue';
const { getPrimary, getSurface, isDarkTheme } = useLayout();
const pieData = ref(null);
const pieOptions = ref(null);

onMounted(() => {
    setColorOptions();
});

function setColorOptions() {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');

    pieData.value = {
        labels: ['Cashin', 'Cashout', 'Promotions'],
        datasets: [
            {
                data: [540, 325, 702],
                backgroundColor: [documentStyle.getPropertyValue('--p-blue-700'), documentStyle.getPropertyValue('--p-green-400'), documentStyle.getPropertyValue('--p-pink-500')],
                hoverBackgroundColor: [documentStyle.getPropertyValue('--p-blue-500'), documentStyle.getPropertyValue('--p-green-500'), documentStyle.getPropertyValue('--p-pink-400')]
            }
        ]
    };

    pieOptions.value = {
        plugins: {
            legend: {
                labels: {
                    usePointStyle: false,
                    color: textColor
                }
            }
        }
    };
}

const points = [
    {
        label: 'Player Main Points',
        value: 0.00,
        barColor: 'custom-cyan-progress',
        valueColor: 'text-[#00ffff]'
    },
    {
        label: 'Player Mini Points',
        value: 0.0,
        barColor: 'custom-orange-progress',
        valueColor: 'text-[#ffa500]'
    },
    {
        label: 'Agent Points',
        value: 0.00,
        barColor: 'custom-red-progress',
        valueColor: 'text-[#ff0000]'
    },
    {
        label: 'Admin Points',
        value: 0.0,
        barColor: 'custom-yellow-progress',
        valueColor: 'text-[#ffff00]'
    }
];

const totalPoints = computed(() => points.reduce((sum, item) => sum + item.value, 0));

const maxPoints = computed(() => Math.max(...points.map((item) => item.value)));

const formatNumber = (num) => num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

watch(
    [getPrimary, getSurface, isDarkTheme],
    () => {
        setColorOptions();
    },
    { immediate: true }
);

const statistics = ref([
    { label: 'Player Registration Today', value: '0 Players', change: 0 },
    { label: 'Agent Registration Today', value: '0 Agents', change: 0 },
    { label: 'Players', isHeader: true, color: 'text-yellow-400', icon: 'pi-users' },
    { label: 'Registered Players', value: '2' },
    { label: 'Active Players', value: '2' },
    { label: 'Blocked Players', value: '0' },
    { label: 'Agents', isHeader: true, color: 'text-pink-500', icon: 'pi-user' },
    { label: 'Registered Agents', value: '5' },
    { label: 'Active Agents', value: '5' },
    { label: 'Blocked Agents', value: '0' }
]);
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- Doughnut Chart -->
        <div class="md:col-span-2 xl:col-span-1 card rounded-lg p-6">
            <div class="card flex flex-col items-center">
                <div class="font-semibold text-xl mb-4"><i class="mdi-chart-pie mdi mr-2"></i>This Month's Transactions</div>
                <Chart type="doughnut" :data="pieData" :options="pieOptions"></Chart>
            </div>
        </div>

        <!-- Points Distribution -->
        <div class="card p-6 rounded-lg">
            <div class="flex items-center gap-2 mb-6">
                <h2 class="text-lg font-semibold"><i class="mdi-circle-multiple mdi mr-2"></i>Points Distribution</h2>
            </div>

            <div class="space-y-4">
                <div v-for="(item, index) in points" :key="index" class="space-y-2">
                    <div class="flex justify-between text-gray-400">
                        <span>{{ item.label }}:</span>
                        <span :class="item.valueColor" class="font-mono">{{ formatNumber(item.value) }}</span>
                    </div>
                    <ProgressBar :value="(item.value / maxPoints) * 100" :class="item.barColor" class="h-2" />
                </div>

                <div class="pt-4 mt-4 border-t border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-xl">Total Points:</span>
                        <span class="text-[#00ff00] font-mono text-xl">{{ formatNumber(totalPoints) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="card bg-opacity-75 rounded-lg shadow-lg p-4">
            <div class="flex items-center mb-4 text-sm font-bold">
                <i class="pi pi-chart-bar mr-2"></i>
                More Statistics
            </div>

            <DataTable :value="statistics" class="[&_.p-datatable-wrapper]:!bg-transparent" :showGridlines="false">
                <Column>
                    <template #body="{ data }">
                        <div v-if="data.isHeader" :class="[data.color, 'font-bold flex items-center text-md ']">
                            <i :class="['pi', data.icon, 'mr-1']"></i>
                            {{ data.label }}
                        </div>
                        <span v-else class="text-md text-gray-300">{{ data.label }}</span>
                    </template>
                </Column>
                <Column>
                    <template #body="{ data }">
                        <div class="text-right text-md">
                            {{ data.value }}
                            <template v-if="data.change !== undefined">
                                <span class="text-red-500 ml-1 inline-flex items-center">
                                    <i class="pi pi-arrow-down text-md mr-1"></i>
                                    {{ data.change }}%
                                </span>
                            </template>
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>
</template>
<style scoped>
:deep(.p-datatable-wrapper) {
    background-color: transparent !important;
}

:deep(.p-datatable) {
    background-color: transparent;
}

:deep(.p-datatable .p-datatable-thead) {
    display: none;
}

:deep(.p-datatable .p-datatable-tbody > tr) {
    background: transparent !important;
    border-bottom: 1px solid rgb(55, 65, 81);
}

:deep(.p-datatable .p-datatable-tbody > tr:last-child) {
    border-bottom: none;
}

:deep(.p-datatable .p-datatable-tbody > tr > td) {
    border: none;
    padding: 0.5rem 0;
    background: transparent !important;
}

:deep(.p-progressbar) {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 0;
}

:deep(.p-progressbar-value) {
    border-radius: 0;
}

:deep(.custom-cyan-progress .p-progressbar-value) {
    background: #00ffff;
}

:deep(.custom-orange-progress .p-progressbar-value) {
    background: #ffa500;
}

:deep(.custom-red-progress .p-progressbar-value) {
    background: #ff0000;
}

:deep(.custom-yellow-progress .p-progressbar-value) {
    background: #ffff00;
}
</style>
