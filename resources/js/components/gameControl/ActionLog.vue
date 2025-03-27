<script setup>
import { ref } from 'vue';

const tableData = ref([
    {
        id: 1,
        action: 'CANCELLED',
        status: 'CANCELLED',
        winner: '',
        more: 'RESET'
    },
    {
        id: 2,
        action: 'LOCKED',
        status: 'LOCKED',
        winner: 'MERON',
        more: 'RESET'
    },
    {
        id: 3,
        action: 'CANCELLED',
        status: 'CANCELLED',
        winner: '',
        more: 'REOPEN'
    },
    {
        id: 4,
        action: 'LOCK',
        status: 'DECLARED',
        winner: 'WALA',
        more: 'REOPEN'
    },
    {
        id: 5,
        action: 'CURRENT',
        status: 'CLOSED',
        winner: '',
        more: ''
    },
    {
        id: 6,
        action: 'SELECT',
        status: '',
        winner: 'DRAW',
        more: ''
    },
    {
        id: 7,
        action: 'SELECT',
        status: 'IDLE',
        winner: 'DRAW',
        more: ''
    }
]);
</script>

<template>
    <div class="">
        <DataTable :value="tableData" class="p-datatable-sm">
            <Column field="id" header="NO." class="text-xs"></Column>

            <!-- Action Column -->
            <Column field="action" header="ACTION" class="text-xs">
                <template #body="{ data }">
                    <div
                        v-if="data.action"
                        :class="{
                            'bg-[#317EFF] font-bold w-fit flex items-center': data.action === 'SELECT', // Add icons for SELECT action
                            'bg-[#1C1C1C] text-[#626262] font-bold w-fit flex items-center': data.action === 'CANCELLED' || data.action === 'LOCKED', // Add icons for LOCKED action
                            'bg-[#455a64] font-bold w-fit': data.action === 'LOCK', // Add icons for LOCK action
                            'bg-[#0E2618] text-[#00C853] font-bold w-fit flex items-center': data.action === 'CURRENT', // Add icons for CURRENT action
                            'bg-red-600 text-[#626262] font-bold w-fit': !(data.action === 'CANCELLED' || data.action === 'LOCKED' || data.action === 'LOCK' || data.action === 'SELECT')
                        }"
                        class="p-2 rounded-md"
                    >
                        <!-- Conditional icons for SELECT, CURRENT, LOCK, and LOCKED actions -->
                        <i v-if="data.action === 'SELECT'" class="mdi-eye mdi mr-2"></i>
                        <i v-if="data.action === 'CURRENT'" class="mdi-check mdi mr-2"></i>
                        <i v-if="data.action === 'LOCK' || data.action === 'LOCKED'" class="mdi-lock mdi mr-2"></i>

                        {{ data.action }}
                    </div>
                </template>
            </Column>

            <!-- Status Column -->
            <Column field="status" header="STATUS" class="text-xs">
                <template #body="{ data }">
                    <div
                        v-if="data.status"
                        :class="{
                            'bg-[#0E292D] text-[#00e5ff] font-bold w-fit': data.status === 'DECLARED',
                            'bg-[#2D260E] text-[#DEAC03] font-bold w-fit': data.status === 'CLOSED',
                            'bg-[#280E2C] text-[#AD04C8] font-bold w-fit': data.status === 'IDLE',
                            'bg-[#2D1116] text-[#FF1744] font-bold w-fit': data.status === 'CANCELLED',
                            'bg-[#1C1C1C] text-[#626262] font-bold w-fit': data.status === 'LOCKED'
                        }"
                        class="p-2 rounded-md"
                    >
                        {{ data.status }}
                    </div>
                </template>
            </Column>

            <!-- Winner Column -->
            <Column header="WINNER" class="text-center text-xs">
                <template #body="{ data }">
                    <div
                        v-if="data.winner"
                        :class="{
                            'bg-[#12202B] text-[#2196F2] w-fit font-bold': data.winner === 'WALA',
                            'bg-[#2B1614] text-[#B0342A] w-fit font-bold': data.winner === 'MERON',
                            'bg-[#172318] text-[#419345] w-fit font-bold': data.winner === 'DRAW',
                            'bg-[#424242] text-white w-fit font-bold': !(data.winner === 'WALA' || data.winner === 'MERON' || data.winner === 'DRAW')
                        }"
                        class="p-2 rounded-md"
                    >
                        {{ data.winner }}
                    </div>
                </template>
            </Column>

            <!-- More Column -->
            <Column header="MORE" class="text-right text-xs">
                <template #body="{ data }">
                    <button
                        v-if="data.more"
                        :class="{
                            'bg-[#00e676] text-black w-fit': data.more === 'RESET',
                            'bg-[#76ff03] text-black w-fit': data.more === 'REOPEN',
                            'bg-[#424242] text-white w-fit': data.more !== 'RESET' && data.more !== 'REOPEN'
                        }"
                        class="p-1.5 rounded-md text-sm font-bold w-fit flex items-center"
                    >
                        <!-- Icon and Text -->
                        <i v-if="data.more === 'RESET'" class="mdi-restart mdi mr-2"></i>
                        <i v-if="data.more === 'REOPEN'" class="mdi-restart mdi mr-2"></i>
                        {{ data.more }}
                    </button>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped>
/* Additional styling if needed */
</style>
