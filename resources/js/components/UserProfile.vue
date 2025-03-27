<script setup>
import { reactive, ref } from 'vue';

// Component state
const generalCommission = ref('1.00');
const lotteryCommission = ref('0.10');
const casinoCommission = ref('0.10');
const fullName = ref('Sample');
const mobileNo = ref('09854555677');
const mainWallet = ref('0.00');
const miniWallet = ref('0.00');
const uuid = ref('964-JZXIGYBU5H91');
const checked = ref(false);
const userDetails = [
    { label: 'Rakeback', value: '0.00', spanClass: 'text-green-500' },
    { label: 'Email', value: 'acedoperatoragent@email.com' },
    { label: 'Phone', value: '09854555677' },
    {
        label: 'Role',
        value: 'AGENT',
        spanClass: 'text-[#00E676] bg-[#1D392B] py-1 px-2 text-sm rounded-md',
        icon: 'mdi-label'
    },
    {
        label: 'Level',
        value: 'INCORPORATOR',
        spanClass: 'text-[#FF9000] bg-[#3C2E1D] py-1 px-2 text-sm rounded-md',
        icon: 'mdi-label'
    },
    {
        label: 'Agent',
        value: 'acedoperator',
        spanClass: 'text-[#0898AA] bg-[#1D3436] py-1 px-2 text-sm rounded-md',
        icon: 'mdi-account-tie'
    },
    { label: 'General Commission', value: '1.00%' },
    { label: 'Lottery Commission', value: '0.10%' },
    { label: 'Casino Commission', value: '0.10%' },
    { label: 'Registration Date', value: '' }
];

// Rollover Progress
const rolloverProgress = reactive({
    current: 1.0,
    total: 1.0,
    percentage: 1
});

// Commission Rates
const rates = reactive({
    general: '1.00',
    lottery: '0.10',
    casino: '0.10'
});

// Commission Earnings
const earningStats = {
    remaining: { label: 'Remaining Earnings', value: '1,000.00' },
    total: { label: 'Total Earnings', value: '5,000.00' },
    approved: { label: 'Approved Earnings', value: '3,000.00' },
    network: {
        label: 'Total Network Earnings',
        value: '10,000.00',
        subValue: '2,000.00'
    }
};

// Earnings Breakdown
const breakdownItems = {
    liveGame: {
        label: 'Live Game Earnings',
        value: '1,000.00'
    },
    miniGame: {
        label: 'Mini Game Earnings',
        value: '500.00'
    },
    lottery: {
        label: 'Lottery Earnings',
        value: '750.00'
    },
    casino: {
        label: 'Casino Earnings',
        value: '1,250.00'
    }
};

// Transactions
const transactions = reactive({
    deposits: '0.00',
    withdrawals: '0.00',
    received: '0.00',
    sent: '0.00'
});
// Comm Rates
const rateItems = {
    general: { label: 'General Rate', value: rates.general },
    lottery: { label: 'Lottery Rate', value: rates.lottery },
    casino: { label: 'Casino Rate', value: rates.casino }
};
// Activities Data
const activities = ref([
    {
        id: 27544,
        username: 'ACEDOPERATORAGENT',
        category: 'USER',
        event: 'PROFILE-UPDATED',
        message: "User [acedoperatoragent]'s profile has been set to private by [acedoperator]",
        date: '2025-01-20 13:57:53'
    },
    {
        id: 27543,
        username: 'ACEDOPERATORAGENT',
        category: 'USER',
        event: 'PROFILE-UPDATED',
        message: "User [acedoperatoragent]'s profile has been set to public by [acedoperator]",
        date: '2025-01-20 13:57:50'
    },
    {
        id: 27542,
        username: 'ACEDOPERATORAGENT',
        category: 'USER',
        event: 'PROFILE-UPDATED',
        message: 'User [acedoperatoragent] has been verified by [acedoperator]',
        date: '2025-01-20 13:57:50'
    },
    {
        id: 27541,
        username: 'ACEDOPERATORAGENT',
        category: 'USER',
        event: 'PROFILE-UPDATED',
        message: 'User [acedoperatoragent] has been unverified by [acedoperator]',
        date: '2025-01-20 13:57:47'
    }
]);

// Active Tab
const activeTab = ref('ACTIVITIES');
</script>

<template>
    <div class="flex flex-col lg:flex-row gap-2 mb-2 text-white">
        <!-- Left Panel -->
        <div class="w-full lg:w-1/3 card p-3 h-fit">
            <div class="flex justify-center items-center gap-2 mb-4">
                <span class="text-center bg-[#00695C] px-2 py-1 rounded text-sm font-bold"><i class="mdi mdi-account mr-1"></i>acedoperatoragent</span>
            </div>

            <div class="flex justify-center mb-4">
                <i class="flex items-center justify-center w-24 h-24 mdi mdi-account-circle text-[100px] text-gray-400"></i>
            </div>

            <div class="flex gap-2 justify-center mb-4">
                <span class="bg-green-900 text-green-400 px-2 py-1 rounded-full text-md"><i class="mdi mdi-check-circle mr-1"></i>Allowed</span>
                <span class="bg-blue-900 text-blue-400 px-2 py-1 rounded-full text-md"><i class="mdi mdi-shield-check mr-1"></i>Verified</span>
                <span class="bg-yellow-900 text-yellow-400 px-2 py-1 rounded-full text-md"><i class="mdi mdi-eye-lock mr-1"></i>Private</span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="text-center">
                    <div class="text-gray-400 text-md"><i class="mdi mdi-wallet mr-1 text-xl"></i>Main Wallet</div>
                    <div class="text-green-500 text-xl">{{ mainWallet }}</div>
                </div>
                <div class="text-center">
                    <div class="text-gray-400 text-md"><i class="mdi mdi-wallet-bifold mr-1 text-xl"></i>Mini Wallet</div>
                    <div class="text-yellow-500 text-xl">{{ miniWallet }}</div>
                </div>
            </div>

            <div class="text-center text-gray-400 text-md mb-4">UUID: {{ uuid }}</div>

            <button label="GO TO LOADING STATION" class="w-full bg-yellow-500 text-black font-semibold mb-4 p-2 rounded-lg">GO TO LOADING STATION</button>

            <div class="flex items-center justify-between mb-2">
                <div class="text-sm text-white">Rollover Progress:</div>
                <div class="text-sm text-gray-400">{{ rolloverProgress.current }} / {{ rolloverProgress.total }}</div>
            </div>
            <ProgressBar :value="1" class="h-2" />
        </div>

        <!-- Middle Panel -->
        <div class="card w-full lg:w-1/3 p-2">
            <h2 class="text-xl mb-4"><i class="mdi mdi-brightness-percent mr-1"></i>Set Agent Commission Rates</h2>
            <div class="bg-[#213748] text-[#2196F3] p-3 rounded mb-4 text-sm"><i class="mdi mdi-exclamation mr-1 text-md"></i>You can only adjust the rates of an agent directly below you.</div>

            <div class="space-y-4">
                <div>
                    <FloatLabel class="w-full" variant="on">
                        <TreeSelect v-model="generalCommission" :options="['1.00%']" inputId="on_label" class="w-full" />
                        <label for="on_label">General Commission Rate</label>
                    </FloatLabel>
                </div>

                <div>
                    <FloatLabel class="w-full" variant="on">
                        <TreeSelect v-model="lotteryCommission" :options="['0.10%']" inputId="on_label" class="w-full" />
                        <label for="on_label">General Commission Rate</label>
                    </FloatLabel>
                </div>

                <div>
                    <FloatLabel class="w-full" variant="on">
                        <TreeSelect v-model="casinoCommission" :options="['0.10%']" inputId="on_label" class="w-full" />
                        <label for="on_label">Casino Commission</label>
                    </FloatLabel>
                </div>
            </div>

            <h2 class="text-xl my-5"><i class="mdi mdi-account mr-1"></i>User Status</h2>
            <div class="flex gap-4">
                <div class="flex items-center gap-2">
                    <i class="pi pi-check-circle text-blue-500"></i>
                    <ToggleSwitch v-model="checked">
                        <template #handle="{ checked }">
                            <i :class="['text-xs ', { 'mdi mdi-moon-waning-crescent': checked, 'mdi mdi-moon-waning-crescent': !checked }]" />
                        </template>
                    </ToggleSwitch>
                    <span>Allowed</span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="pi pi-check-circle text-green-500"></i>
                    <ToggleSwitch v-model="checked">
                        <template #handle="{ checked }">
                            <i :class="['text-xs ', { 'mdi mdi-moon-waning-crescent': checked, 'mdi mdi-moon-waning-crescent': !checked }]" />
                        </template>
                    </ToggleSwitch>
                    <span>Verified</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="pi pi-check-circle text-amber-500"></i>
                    <ToggleSwitch v-model="checked">
                        <template #handle="{ checked }">
                            <i :class="['text-xs ', { 'mdi mdi-moon-waning-crescent': checked, 'mdi mdi-moon-waning-crescent': !checked }]" />
                        </template>
                    </ToggleSwitch>
                    <span>Private</span>
                </div>
            </div>

            <h2 class="text-xl my-5"><i class="mdi mdi-pencil mr-1"></i>Edit User Profile</h2>
            <div class="flex flex-col gap-2 mb-3">
                <div class="flex items-center flex-col md:flex-row justify-center gap-2">
                    <FloatLabel variant="on" class="w-full md:w-1/2">
                        <InputText id="on_label" v-model="fullName" class="w-full" />
                        <label for="on_label">Full Name</label>
                    </FloatLabel>
                    <FloatLabel variant="on" class="w-full md:w-1/2">
                        <InputText id="on_label" v-model="mobileNo" class="w-full" />
                        <label for="on_label">Mobile No.</label>
                    </FloatLabel>
                </div>

                <h2 class="text-xl mt-4"><i class="fa-duotone fa-solid fa-lock-keyhole mr-1"></i>Change Password</h2>
                <FloatLabel variant="on">
                    <InputText id="on_label" v-model="value3" class="w-full" />
                    <label for="on_label">Change User Password</label>
                </FloatLabel>
            </div>
            <button label="UPDATE PROFILE" class="w-full bg-[#1565C0] p-2 rounded-lg"><i class="mdi mdi-plus mr-1 text-lg"></i>UPDATE PROFILE</button>
        </div>

        <!-- Right Panel -->
        <div class="w-full lg:w-1/3 card p-0 h-fit">
            <div class="space-y-2">
                <template v-for="(item, index) in userDetails" :key="index">
                    <div class="flex justify-between px-3" :class="{ 'mt-4': index === 0 }">
                        <span class="text-white font-bold">{{ item.label }}:</span>
                        <span :class="item.spanClass">
                            <i v-if="item.icon" :class="['mdi', item.icon, 'mr-1', 'text-lg']"></i>
                            {{ item.value }}
                        </span>
                    </div>
                    <svg v-if="index !== userDetails.length - 1" height="0.5" width="100%">
                        <line x1="0" y1="0" x2="100%" y2="0" style="stroke: #cbd5e0; stroke-width: 0.4" />
                    </svg>
                </template>
            </div>
        </div>
    </div>

    <!-- Top Section -->
    <div class="card p-2 grid grid-cols lg:grid-cols-2 gap-8">
        <!-- Left Side -->
        <div class="space-y-4">
            <!-- Commission Rates -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-yellow-400 font-semibold text-xl"> <i class="mdi mdi-brightness-percent mr-1"></i>Commission Rates</span>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div v-for="(rate, key) in rateItems" :key="key">
                        <div class="text-gray-400 text-sm">{{ rate.label }}</div>
                        <div class="text-xl text-yellow-400">{{ rate.value }}%</div>
                    </div>
                </div>
            </div>
            <svg height="0.5" width="100%">
                <line x1="0" y1="0" x2="100%" y2="0" style="stroke: #cbd5e0; stroke-width: 0.4" />
            </svg>
            <!-- Commission Earnings -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="pi pi-dollar text-cyan-400"></i>
                    <span class="text-cyan-400 font-semibold">Commissions Earnings</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <div v-for="(stat, key) in earningStats" :key="key">
                        <div class="text-gray-400 text-sm">{{ stat.label }}</div>
                        <div class="text-xl text-cyan-400">{{ stat.value }}</div>
                        <div v-if="stat.subValue" class="text-sm text-gray-400">Last Month: {{ stat.subValue }}</div>
                    </div>
                </div>
            </div>
            <svg height="0.5" width="100%">
                <line x1="0" y1="0" x2="100%" y2="0" style="stroke: #cbd5e0; stroke-width: 0.4" />
            </svg>
            <!-- Earnings Breakdown -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="pi pi-chart-pie text-green-400"></i>
                    <span class="text-green-400 font-semibold">Earnings Breakdown</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <div v-for="(item, key) in breakdownItems" :key="key">
                        <div class="text-gray-400 text-sm">{{ item.label }}</div>
                        <div class="text-xl text-green-400">{{ item.value }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Transactions -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <i class="pi pi-wallet text-purple-400"></i>
                <span class="text-purple-400 font-semibold">Transactions</span>
            </div>
            <div class="space-y-4">
                <div class="relative pt-2">
                    <div class="text-gray-400 mb-1">Total Deposits : {{ transactions.deposits }}</div>
                    <div class="h-2 bg-gray-700 rounded">
                        <div class="h-full bg-green-500 rounded" style="width: 60%"></div>
                    </div>
                </div>
                <div class="relative pt-2">
                    <div class="text-gray-400 mb-1">Total Withdrawals : {{ transactions.withdrawals }}</div>
                    <div class="h-2 bg-gray-700 rounded">
                        <div class="h-full bg-blue-500 rounded" style="width: 40%"></div>
                    </div>
                </div>
                <div class="relative pt-2">
                    <div class="text-gray-400 mb-1">Total Funds Received : {{ transactions.received }}</div>
                    <div class="h-2 bg-gray-700 rounded">
                        <div class="h-full bg-yellow-500 rounded" style="width: 30%"></div>
                    </div>
                </div>
                <div class="relative pt-2">
                    <div class="text-gray-400 mb-1">Total Funds Sent : {{ transactions.sent }}</div>
                    <div class="h-2 bg-gray-700 rounded">
                        <div class="h-full bg-cyan-500 rounded" style="width: 20%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2 mt-4">
        <Tabs value="0">
            <TabList>
                <Tab value="0" as="div" class="flex items-center gap-2">
                    <i class="mdi-check-bold mdi mr-1"></i>
                    <span class="font-bold whitespace-nowrap">ACTIVITIES</span>
                </Tab>
                <Tab value="1" as="div" class="flex items-center gap-2">
                    <i class="mdi-check-bold mdi mr-1"></i>
                    <span class="font-bold whitespace-nowrap">COMMISSION LOGS</span>
                </Tab>
                <Tab v-slot="slotProps" value="2" asChild>
                    <div :class="['flex items-center gap-2', slotProps.class]" @click="slotProps.onClick" v-bind="slotProps.a11yAttrs">
                        <i class="mdi-check-bold mdi mr-1"></i>
                        <span class="font-bold whitespace-nowrap">TRANSACTIONS</span>
                    </div>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel value="0" as="p" class="m-0">
                    <!-- Activities Table -->
                    <DataTable :value="activities" class="mt-4" stripedRows>
                        <Column field="id" header="ID"></Column>
                        <Column field="username" header="Username">
                            <template #body="slotProps">
                                <span class="text-green-400"> <i class="pi pi-user mr-2"></i>{{ slotProps.data.username }} </span>
                            </template>
                        </Column>
                        <Column field="category" header="Category">
                            <template #body="slotProps">
                                <span class="text-yellow-400">{{ slotProps.data.category }}</span>
                            </template>
                        </Column>
                        <Column field="event" header="Event">
                            <template #body="slotProps">
                                <span class="text-blue-400">{{ slotProps.data.event }}</span>
                            </template>
                        </Column>
                        <Column field="message" header="Message"></Column>
                        <Column field="date" header="Date" class="text-right"></Column> </DataTable
                ></TabPanel>
                <TabPanel value="1" as="p" class="m-0">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                    ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non numquam eius modi.
                </TabPanel>
                <TabPanel v-slot="slotProps" value="2" asChild>
                    <div v-show="slotProps.active" :class="slotProps.class" v-bind="slotProps.a11yAttrs">
                        <p class="m-0">
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in
                            culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.
                        </p>
                    </div>
                </TabPanel>
            </TabPanels>
        </Tabs>
    </div>
</template>
<style scoped>
.border-thin {
    border-bottom: 0.5px solid #cbd5e0; /* Adjust color as needed */
}

.custom-input {
    background: transparent !important;
}
</style>
