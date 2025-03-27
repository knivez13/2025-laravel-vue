<script setup>
import { useDashboard } from '@/stores/Admin/useDashboard.js';
const { cockfighting_earning } = storeToRefs(useDashboard());
</script>

<template>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-2 rounded-md">
        <div class="font-bold text-lg flex items-center"><i class="mdi-gamepad mdi text-xl mr-2"></i>Cockfighting Earnings</div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152935]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-piggy-bank mdi mr-2 text-xl"></i>Gross Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">
                            {{
                                new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(cockfighting_earning?.this_month?.gross ?? 0.0)
                            }}
                        </div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#162D33]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-account-tie mdi mr-2 text-xl"></i>Agent Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">
                            {{
                                new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(cockfighting_earning?.this_month?.agent ?? 0.0)
                            }}
                        </div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152A2D]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-brightness-percent mdi mr-2 text-xl"></i>Net Profit </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">
                            {{
                                new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(parseFloat(cockfighting_earning?.this_month?.gross) - parseFloat(cockfighting_earning?.this_month?.agent) ?? 0.0)
                            }}
                        </div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-2 rounded-md">
        <div class="font-bold text-lg flex items-center"><i class="mdi-gamepad-variant-outline mdi text-xl mr-2"></i>Lotto Earnings</div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152935]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-piggy-bank mdi mr-2 text-xl"></i>Gross Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#162D33]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-account-tie mdi mr-2 text-xl"></i>Agent Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152A2D]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-brightness-percent mdi mr-2 text-xl"></i>Net Profit </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2 grid col-span-12 lg:col-span-12 xl:col-span-4 gap-2 rounded-md">
        <div class="font-bold text-lg flex items-center"><i class="mdi-cards-spade mdi text-xl mr-2"></i>Casino Game Earnings</div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152935]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-piggy-bank mdi mr-2 text-xl"></i>Gross Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#162D33]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-account-tie mdi mr-2 text-xl"></i>Agent Earnings </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="card mb-0 p-3 bg-[#152A2D]">
                <div class="flex justify-between mb-1">
                    <div>
                        <span class="block text-[#A7D6EF] font-bold mb-2"><i class="mdi-brightness-percent mdi mr-2 text-xl"></i>Net Profit </span>
                        <div class="text-white dark:text-surface-0 font-bold text-xl mb-1">0.00</div>
                        <span class="text-white dark:text-surface-0 font-medium mr-2 md:mb-0 text-xs">Last Month: 0.00 </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
