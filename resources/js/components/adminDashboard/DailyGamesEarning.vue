<script setup>
import { useLayout } from '@/layout/composables/layout';
import { onMounted, ref, watch } from 'vue';


const { getPrimary, getSurface, isDarkTheme } = useLayout();
const barData = ref(null);
const barOptions = ref(null);

onMounted(() => {
    setColorOptions();
});

function setColorOptions() {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    barData.value = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'Gross',
                backgroundColor: documentStyle.getPropertyValue('--p-blue-500'),
                borderColor: documentStyle.getPropertyValue('--p-primary-500'),
                // data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: 'Agent',
                backgroundColor: documentStyle.getPropertyValue('--p-red-500'),
                borderColor: documentStyle.getPropertyValue('--p-primary-500'),
                // data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Net',
                backgroundColor: documentStyle.getPropertyValue('--p-green-500'),
                borderColor: documentStyle.getPropertyValue('--p-primary-500'),
                // data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
    barOptions.value = {
        plugins: {
            legend: {
                labels: {
                    fontColor: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: '#57595B',
                    font: {
                        weight: 500
                    }
                },
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                ticks: {
                    color: '#57595B'
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false
                }
            }
        }
    };
}

watch(
    [getPrimary, getSurface, isDarkTheme],
    () => {
        setColorOptions();
    },
    { immediate: true }
);
</script>

<template>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-1 rounded-md">
        <div class="col-span-12 xl:col-span-6">
            <div class="font-semibold text-xl mb-4"><i class="mdi-finance mdi font-bold mr-2"></i>Daily Live Games Earnings</div>
            <Chart type="bar" :data="barData" :options="barOptions"></Chart>
        </div>
    </div>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-1 rounded-md">
        <div class="col-span-12 xl:col-span-6">
            <div class="font-semibold text-xl mb-4"><i class="mdi-finance mdi font-bold mr-2"></i> Daily Mini Games Earnings</div>
            <Chart type="bar" :data="barData" :options="barOptions"></Chart>
        </div>
    </div>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-1 rounded-md">
        <div class="col-span-12 xl:col-span-6">
            <div class="font-semibold text-xl mb-4"><i class="mdi-finance mdi font-bold mr-2"></i> Daily Casino Games Earnings</div>
            <Chart type="bar" :data="barData" :options="barOptions"></Chart>
        </div>
    </div>
</template>
