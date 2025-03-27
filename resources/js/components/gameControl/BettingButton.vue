<script setup>
import { ref } from 'vue';

const announcements = [
    { text: 'BETTING IS NOW OPEN. PLACE YOUR BETS.' },
    { text: 'PAYOUT BELOW 120 WILL BE CANCELLED.' },
    { text: 'LAST CALL TO PLACE YOUR BETS.' },
    { text: 'DRAW WINS x 8. MAX DRAW BET PER PLAYER IS 5000 per FIGHT' },
    { text: 'STAND BY FOR OUR VIDEO' },
    { text: 'PLEASE REFRESH.' },
    { text: 'THIS IS OUR LAST FIGHT.' },
    { text: 'EMERGENCY MAINTENANCE. PLEASE STAND BY.' },
    { text: 'GOODLUCK PLAYERS!' }
];

const refreshData = () => {
    // Implement refresh logic
};

const closeBetting = () => {
    // Implement close betting logic
};

const cancelAction = () => {
    // Implement cancel action logic
};

const selected = ref(null); // Track the selected section

function select(section) {
    selected.value = section; // Set the selected section
}
</script>

<template>
    <div class="grid grid-cols">
        <!-- Video Player Section -->
        <div class="bg-gray-900 text-white shadow-md p-0 overflow-hidden">
            <iframe class="w-full" height="410" src="https://zorocast.com/v1/stream/play?player=hls&amp;origin=f7620a8377d7f63d005012c3729784c8" allowfullscreen="false" frameborder="0" scrolling="no"></iframe>
        </div>

        <!-- Refresh Button Section -->
        <div class="bg-gray-800 p-2 text-right">
            <button @click="refreshData" class="bg-orange-400 hover:bg-orange-600 text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi mdi-refresh mdi-24px mr-1"></i> Refresh</button>
        </div>
    </div>

    <!-- Round and ID Section -->
    <div class="bg-gray-800 text-white shadow-md p-2">
        <div class="text-subtitle-1 font-bold">Round # <span class="text-amber-500">2</span></div>
        <div class="text-caption">ID: <span class="text-amber-400">2</span></div>

        <!-- Status Betting Section -->
        <div class="w-full text-center">
            <button @click="cancelAction" class="w-full bg-[#009688] text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi-arrow-right mdi mdi-18px mr-1"></i> SET NEXT FIGHT</button>
        </div>

        <div class="flex justify-between mt-2 gap-1">
            <div class="w-3/4 text-center">
                <button @click="closeBetting" class="w-full bg-green-600 text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi-lock-open mdi mdi-18px mr-1"></i> OPEN BETTING</button>
            </div>
            <div class="w-1/3 text-center">
                <button class="w-full bg-[#2D1816] text-red-600 font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi mdi-close mdi-18px mr-1"></i> CANCEL</button>
            </div>
        </div>

        <div class="flex justify-between mt-2 gap-1">
            <div class="w-3/4 text-center">
                <button class="w-full bg-orange-600 text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi mdi-stop-circle-outline mdi-18px mr-1"></i> CLOSE BETTING</button>
            </div>
            <div class="w-1/3 text-center">
                <button class="w-full bg-red-600 text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi mdi-close mdi-18px mr-1"></i> CANCEL</button>
            </div>
        </div>

        <div class="my-2">
            <div><i class="mdi-checkbox-marked-circle-plus-outline mdi mr-2"></i>Select Main Bet Winners</div>
            <div class="flex justify-evenly relative flex-wrap gap-4">
                <div class="flex flex-wrap gap-4">
                    <!-- MERON section -->
                    <div :class="{ 'bg-yellow-500 text-black': selected === 'meron', 'bg-[#424242]': selected !== 'meron' }" class="p-5 text-center rounded-md max-w-full w-[130px] flex flex-col items-center cursor-pointer" @click="select('meron')">
                        MERON
                        <div class="mt-2 w-[64px] h-[64px] bg-[#f44336]"></div>
                    </div>

                    <!-- WALA section -->
                    <div :class="{ 'bg-yellow-500 text-black': selected === 'wala', 'bg-[#424242]': selected !== 'wala' }" class="p-5 text-center rounded-md max-w-full w-[130px] flex flex-col items-center cursor-pointer" @click="select('wala')">
                        WALA
                        <div class="mt-2 w-[64px] h-[64px] bg-[#2196f3]"></div>
                    </div>

                    <!-- DRAW section -->
                    <div :class="{ 'bg-yellow-500 text-black': selected === 'draw', 'bg-[#424242]': selected !== 'draw' }" class="p-5 text-center rounded-md max-w-full w-[130px] flex flex-col items-center cursor-pointer" @click="select('draw')">
                        DRAW
                        <div class="mt-2 w-[64px] h-[64px] bg-[#4caf50]"></div>
                    </div>
                </div>
            </div>

            <div><i class="mdi-checkbox-marked-circle-plus-outline mdi mr-2"></i>Select Side Bet Winners (If any)</div>
            <div class="flex justify-between mt-2 gap-1">
                <div class="w-3/4 text-center">
                    <button @click="closeBetting" class="w-full bg-green-600 text-white font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi-check mdi v-icon mdi-18px mr-1"></i>DECLARE</button>
                </div>
                <div class="w-1/3 text-center">
                    <button class="w-full bg-[#2D1816] text-red-600 font-bold py-1 px-2 rounded inline-flex items-center"><i class="mdi-close mdi mdi-18px mr-1"></i> CANCEL</button>
                </div>
            </div>
        </div>

        <!-- Betting Information Section -->
        <div class="v-card-text">
            <DataTable :value="announcements">
                <Column field="text" header="Announcement Text"> <Button>Display</Button></Column>
            </DataTable>
        </div>
    </div>
</template>

<style scoped>
/* Scoped styles */
</style>
