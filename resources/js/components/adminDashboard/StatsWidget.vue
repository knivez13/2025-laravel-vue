<script setup>
import { useDashboard } from '@/stores/Admin/useDashboard.js';
const { cockfighting_earning } = storeToRefs(useDashboard());
const { fnFetch } = useDashboard();

onMounted(async () => {
    await fnFetch();
});
</script>
<template>
    <div class="col-span-12 lg:col-span-6 xl:col-span-3">
        <div class="h-full card mb-0 p-4 bg-[#0288D1]">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-white dark:text-surface-0 font-medium text-xl"><i class="mdi-home-floor-g mdi !text-2xl pr-2"></i>House Gross Earnings</div>
                    <span class="block text-[#A7D6EF] font-medium mb-4">House Gross Earnings for the Current Month </span>
                    <div class="text-white dark:text-surface-0 font-medium text-3xl mb-4">
                        {{
                            new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(cockfighting_earning?.this_month?.gross ?? 0.0)
                        }}
                    </div>
                    <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0">Last Month: 0.00 </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6 xl:col-span-3">
        <div class="h-full card mb-0 p-4 bg-[#0097A7]">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-white dark:text-surface-0 font-medium text-xl"><i class="mdi-account-tie-hat mdi !text-2xl pr-2"></i>Agent Earnings</div>
                    <span class="block text-[#A7D6EF] font-medium mb-4">Withdrawable Earnings: 0.00 </span>
                    <div class="text-white dark:text-surface-0 font-medium text-3xl mb-4">
                        {{
                            new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(cockfighting_earning?.this_month?.agent ?? 0.0)
                        }}
                    </div>
                    <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0">Last Month: 0.00 </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6 xl:col-span-3">
        <div class="h-full card mb-0 p-4 bg-[#00796B]">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-white dark:text-surface-0 font-medium text-xl"><i class="mdi-seal mdi !text-2xl pr-2"></i>Surplus Given</div>
                    <span class="block text-[#A7D6EF] font-medium mb-4">Promotions Given for the Current Month </span>
                    <div class="text-white dark:text-surface-0 font-medium text-3xl mb-4">0.00</div>
                    <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0">Last Month: 0.00 </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6 xl:col-span-3">
        <div class="h-full card mb-0 p-4 bg-[#43A047]">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-white dark:text-surface-0 font-medium text-xl"><i class="mdi-home-import-outline mdi !text-2xl pr-2"></i>House Net Profit</div>
                    <span class="block text-[#A7D6EF] font-medium mb-4">House Net Earnings for the Current Month </span>
                    <div class="text-white dark:text-surface-0 font-medium text-3xl mb-4">
                        {{
                            new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(parseFloat(cockfighting_earning?.this_month?.gross) - parseFloat(cockfighting_earning?.this_month?.agent) ?? 0.0)
                        }}
                    </div>
                    <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0">Last Month: 0.00 </span>
                </div>
            </div>
        </div>
    </div>
</template>
