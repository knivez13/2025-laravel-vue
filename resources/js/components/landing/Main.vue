<script setup>
import Footer from '@/components/landing/Footer.vue';
import { ref } from 'vue';

const loginForm = ref(false);
const registerForm = ref(false);
</script>
<template>
    <main class="main-content">
        <div class="headx">
            <div class="flex justify-content-center button-top">
                <div class="switches-container">
                    <button class="top-button-selected w-1/2 font-bold" @click="loginForm = true">Login</button>
                    <button class="top-button w-1/2 font-bold" @click="registerForm = true">Register</button>
                </div>
            </div>
            <header class="hero">
                <h2 class="hero-title text-white"><span style="color: #eb154a">Bonza</span> Casino</h2>
                <p class="hero-description">In the midst of the bustling streets filled with honking cars, chattering pedestrians, and blaring music, the young poet stood still, lost in his thoughts.</p>
                <button class="play-game-button"><i class="pi pi-play text-xs"></i> Play Game</button>
            </header>
            <div class="cardX">
                <div class="flex justify-evenly gap-4 text-sm overflow-auto">
                    <div>
                        <img src="@/assets/images/games/1.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Golden... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/2.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Ice St... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/3.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">iRich... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/4.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Chinese... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/5.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Crazy... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/6.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Onmyoji <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/7.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Funny... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/8.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Hallowe... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/9.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Africa... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/10.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Black... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/2.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Ice St... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/11.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Long... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/12.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Master... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/2.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Ice St... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                    <div>
                        <img src="@/assets/images/games/10.png" alt="" width="60px" style="border-radius: 10px" />
                        <p class="text-default text-center mt-2">Black... <br /><span class="text-warning">+25.00</span></p>
                    </div>
                </div>
                <div class="card-handle">
                    <div class="card-foot"></div>
                </div>
                <div class="foot-content overflow-auto">
                    <span class="category-list"><i class="bx bxs-disc"></i> Cock Fighting</span>
                    <span class="category-list"><i class="bx bxs-disc"></i> Roulette</span>
                    <span class="category-list"><i class="bx bxs-dashboard"></i> Slots</span>
                    <span class="category-list"><i class="bx bxs-card"></i> Card</span>
                    <span class="category-list"><i class="bx bxs-bar-chart-alt-2"></i> Live Dealer</span>
                    <span class="category-list"><i class="bx bxs-dice-3"></i> Dices</span>
                    <span class="category-list"><i class="bx bxs-rocket"></i> Crash</span>
                    <span class="category-list"><i class="bx bxs-ball"></i> Sport</span>
                </div>
            </div>
        </div>
        <section class="games-section">
            <div class="input-container">
                <input type="text" class="input-search" placeholder="Search for games..." />
                <i class="bx bx-search"></i>
                <!-- Add the search icon here -->
            </div>
            <div class="live-games">
                <span class="text-white font-bold text-2xl">Live Games</span>
                <div class="flex flex-wrap game-list mt-3 gap-5 items-center justify-start">
                    <div class="game-info">
                        <img src="@/assets/images/live/1.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/2.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/3.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/4.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/5.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/6.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/5.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/6.png" alt="" class="game-banner" />
                    </div>
                </div>
            </div>
            <div class="live-games">
                <span class="text-white font-bold text-2xl">Slots</span>
                <div class="flex flex-wrap game-list mt-3 gap-5 items-center justify-start">
                    <div class="game-info">
                        <img src="@/assets/images/live/1.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/2.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/3.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/4.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/5.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/6.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/5.png" alt="" class="game-banner" />
                    </div>
                    <div class="game-info">
                        <img src="@/assets/images/live/6.png" alt="" class="game-banner" />
                    </div>
                </div>
            </div>
            <div class="recommend"></div>
        </section>
        <Footer />
        <div class="md:hidden flex justify-around p-2 b-0 bg-[#111717] fixed bottom-0 w-full text-white font-bold">
            <div class="flex flex-col items-center"><i class="mdi mdi-view-dashboard-edit text-3xl"></i><span>Menu</span></div>
            <div class="flex flex-col items-center"><i class="mdi mdi-slot-machine text-3xl"></i><span>Casino</span></div>
            <div class="flex flex-col items-center"><i class="mdi mdi-gamepad text-3xl"></i><span>Cock Fighting</span></div>
            <div class="flex flex-col items-center"><i class="mdi-wechat mdi text-3xl"></i><span>Chat</span></div>
        </div>
    </main>

    <Dialog v-model:visible="loginForm" modal header="Login" :style="{ width: '35rem', margin: '10px' }">
        <span class="text-surface-500 dark:text-surface-400 block mb-8">Update your information.</span>
        <div class="flex items-center gap-4 mb-4">
            <label for="username" class="font-semibold w-24">Username</label>
            <InputText v-model="email" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex items-center gap-4 mb-8">
            <label for="email" class="font-semibold w-24">Password</label>
            <InputText v-model="password" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="loginForm = false"></Button>
            <Button type="button" label="Login" @click="login"></Button>
        </div>
    </Dialog>

    <Dialog v-model:visible="registerForm" modal header="Register" :style="{ width: '35rem', margin: '10px' }">
        <span class="text-surface-500 dark:text-surface-400 block mb-8">Update your information.</span>
        <div class="flex items-center gap-4 mb-4">
            <label for="username" class="font-semibold w-24">Username</label>
            <InputText v-model="email" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="email" class="font-semibold w-24">Password</label>
            <InputText v-model="password" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex items-center gap-4 mb-8">
            <label for="email" class="font-semibold w-24">Confirm Password</label>
            <InputText v-model="cpassword" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="registerForm = false"></Button>
            <Button type="button" label="Register" @click="submitRegister"></Button>
        </div>
    </Dialog>
</template>
<style scoped>
.switches-container {
    background-color: #0f1418;
    width: 186px;
    border-radius: 30px;
    margin-top: 10px;
}

.top-button-selected {
    background-color: #fc196b;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 13px;
}

.top-button {
    background-color: #0f1418;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 13px;
}

.play-game-button {
    background-color: #fc196b;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 500;
}
::-webkit-scrollbar {
    width: 1px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
    background: transparent; /* Background of the track (empty part of the scrollbar) */
}

::-webkit-scrollbar-thumb {
    background: rgba(249, 100, 50, 0); /* Scrollbar color, matching the cursor */
    border-radius: 50px; /* Rounded edges for the scrollbar */
    border: 1px solid rgba(249, 100, 50, 0); /* Border color matching the cursor */
    box-shadow: 0 0 8px rgba(249, 100, 50, 0.041); /* Matching shadow effect */
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(249, 100, 50, 0.651); /* Darken the scrollbar on hover */
}
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #1a1d1e;
    overflow-y: auto; /* Allow vertical scroll */
    height: 100vh; /* Ensures content fills the screen */
}
.hero {
    background-image: url('/src/assets/images/web/hero.png');
    background-size: cover;
    background-position: center;
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: start;
    justify-content: center;
    color: #fff;
    text-align: start;
    padding: 20px;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: bold;
    text-align: left;
}

.hero-description {
    font-size: 12px;
    margin: 10px 0;
    max-width: 350px;
    font-weight: 550;
    color: #8f8c8c;
}

.input-container {
    position: relative;
    width: 100%;
    top: -10%;
}

.input-container i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 16px;
    pointer-events: none;
}
.input-search {
    padding: 6px 30px;
    width: 100%;
    border-radius: 30px;
    border: none;
    background-color: #111717;
    color: #fff;
    font-size: 14px;
    box-sizing: border-box;
}

.input-search:focus-visible {
    border: rgba(255, 255, 255, 0.068) solid 1px;
    outline: none;
}
.live-games {
    position: relative;
    top: -5%;
    padding: 10px;
}

.game-info {
    display: flex;
    justify-content: center;
}

.game-banner {
    border-radius: 20px;
    width: 120px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.button-top {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
    margin-left: 50%;
    transform: translate(-50%, -50%);
}
.card-handle {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.category-list {
    position: relative;
    padding-right: 20px;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
}

.category-list::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #fc196b;
    transition: width 0.3s ease;
}

.category-list:hover {
    padding-bottom: 10px;
}

.category-list:hover::after {
    width: 100%;
}
.card-foot {
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    width: 103%;
}

.foot-content {
    display: flex;
    flex-direction: row;
    align-items: start;
    justify-content: start;
    text-align: left;
    gap: 20px;
    margin-top: 20px;
    margin-left: 5px;
    color: #7c7d7f;
    font-size: 13px;
}

.foot-content span,
.foot-content i {
    cursor: pointer;
}

.foot-content span:hover {
    color: #fff;
    font-weight: 500;
    transition:
        color 0.3s ease,
        font-weight 0.3s ease,
        text-shadow 0.3s ease;
}

.foot-content i:hover {
    color: #fc196b;
    font-weight: 500;
    transition:
        color 0.3s ease,
        font-weight 0.3s ease,
        text-shadow 0.3s ease;
}
.cardX {
    backdrop-filter: blur(2px);
    padding-right: 20px;
    padding-left: 20px;
    padding-top: 20px;
    padding-bottom: 20px;
    margin-right: 10px;
    margin-left: 10px;
    box-sizing: border-box;
    box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.4) !important;
    position: relative;
    border-radius: 20px;
    color: white;
    border: rgba(255, 255, 255, 0.068) solid 1px;
    top: -10%;
}

.cardX::before {
    position: absolute;
    background: rgba(255, 255, 255, 0.03);
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
    border-radius: 1em;
    filter: blur(0.5px);
}

/* @media (max-width: 430px) {
    .mobile-footer {
        display: block;
    }
} */
</style>
