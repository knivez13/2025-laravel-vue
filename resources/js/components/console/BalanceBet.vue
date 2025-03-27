<script setup>
import Wallet from '@/components/console/Wallet.vue';
import { ref } from 'vue';

// Static logic for bet amount
const betAmount = ref(100);

const placeAmount = (amount) => {
    // Add the clicked chip amount to the current bet amount
    betAmount.value += amount;
};

const clearBet = () => {
    // Reset the bet amount to 0
    betAmount.value = 0;
};
</script>

<template>
    <div class="">
        <div class="bg-[#1e1a1a]">
            <span class="text-xl font-bold flex items-center justify-end p-3 text-white"
                >Balance:<span class="text-[yellow] font-bold ml-1">
                    <Wallet />
                </span>
            </span>
            <div class="p-1 flex items-center">
                <input type="number" placeholder="Enter Amount" class="rounded-md w-full mr-[1px] bg-[#0D0D0D5B] text-[yellow] font-bold h-16 border border-solid border-gray-200 border-opacity-20 p-2 text-[12pt]" v-model="betAmount" />
                <div class="rounded-md bg-[#0D0D0D5B] text-[grey] font-bold h-16 border border-solid border-gray-200 border-opacity-20 p-2 text-[12pt] cursor-pointer flex items-center justify-center" @click="clearBet">
                    <span>Clear</span>
                </div>
            </div>

            <div class="chips-amount">
                <div class="chip-item chip1" @click="placeAmount(20)">
                    <span>20</span>
                </div>
                <div class="chip-item chip7" @click="placeAmount(50)">
                    <span>50</span>
                </div>
                <div class="chip-item chip8" @click="placeAmount(100)">
                    <span>100</span>
                </div>
                <div class="chip-item chip2" @click="placeAmount(200)">
                    <span>200</span>
                </div>
                <div class="chip-item chip3" @click="placeAmount(500)">
                    <span>500</span>
                </div>
                <div class="chip-item chip4" @click="placeAmount(1000)">
                    <span>1000</span>
                </div>
                <div class="chip-item chip5" @click="placeAmount(2000)">
                    <span>2000</span>
                </div>
                <div class="chip-item chip6" @click="placeAmount(5000)">
                    <span>5000</span>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-evenly p-1 bg-[#121212]">
            <button class="bg-[#24af2f] w-full h-16 flex items-center justify-center m-0.5 font-bold text-xl rounded-sm p-2"><i class="mdi mdi-plus-circle-outline mr-1 px-1 py-[1px] text-3xl"></i>Bet Draw</button>

            <div class="w-full h-16 flex items-center justify-center m-0.5 font-bold text-md rounded-sm">
                <span class="text-[#96FF96]">₱ 0.00</span>
            </div>
        </div>
        <p class="drawtext my-3 text-[#d7d7d763] font-bold">Draw Wins x 8.</p>
    </div>
</template>
<style scoped>
.chips-amount {
    display: flex;
    flex-wrap: wrap;
}

.chip-item {
    margin: 10px;
    cursor: pointer;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: grid;
    place-items: center;
}

.chip-item span {
    background-color: #fff;
    color: #000;
    width: 60px;
    text-align: center;
    margin-left: -2px;
    font-weight: 600;
    position: relative;
    bottom: 2px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chip1 {
    background: url('@/assets/images/chip1.png') !important;
    background-size: contain !important;
}

.chip2 {
    background: url('@/assets/images/chip2.png') !important;
    background-size: contain !important;
}

.chip3 {
    background: url('@/assets/images/chip3.png') !important;
    background-size: contain !important;
}

.chip4 {
    background: url('@/assets/images/chip4.png') !important;
    background-size: contain !important;
}

.chip5 {
    background: url('@/assets/images/chip5.png') !important;
    background-size: contain !important;
}

.chip6 {
    background: url('@/assets/images/chip6.png') !important;
    background-size: contain !important;
}

.chip7 {
    background: url('@/assets/images/chip7.png') !important;
    background-size: contain !important;
}

.chip8 {
    background: url('@/assets/images/chip8.png') !important;
    background-size: contain !important;
}
</style>
