<script setup>
import { onMounted, ref } from 'vue';

const isSidebarCollapsed = ref(false);

const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value;
};

onMounted(() => {});
</script>
<template>
    <aside :class="['sidebar md:block hidden', { collapsed: isSidebarCollapsed }]">
        <div class="logo">
            <button class="burger-button" @click="toggleSidebar">
                <div class="burger">
                    <div class="burger-line"></div>
                    <div class="burger-line short"></div>
                    <div class="burger-line shorter"></div>
                </div>
            </button>
            <!-- <i class="icon">🏠</i>
            <span v-if="!isSidebarCollapsed">Bonza</span> -->
        </div>
        <img src="@/assets/images/web/btn.png" v-if="!isSidebarCollapsed" class="mb-5 mt-3" alt="" />
        <ul class="menu">
            <li>
                <a href="#">
                    <i class="bx bxs-dashboard"></i>
                    <span v-if="!isSidebarCollapsed">Slots</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-bar-chart-alt-2"></i>
                    <span v-if="!isSidebarCollapsed">Live Casino</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-gift"></i>
                    <span v-if="!isSidebarCollapsed">Bonuses</span>
                </a>
            </li>
            <li>
                <a href="/user">
                    <i class="bx bxs-trophy"></i>
                    <span v-if="!isSidebarCollapsed">Cock Fighting</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-message-alt-check"></i>
                    <span v-if="!isSidebarCollapsed">Loyalty Program</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-info-square"></i>
                    <span v-if="!isSidebarCollapsed">Info Center</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-info-square"></i>
                    <span v-if="!isSidebarCollapsed">Settings</span>
                </a>
            </li>
        </ul>
        <div class="hr"></div>
        <ul class="menu mt-4">
            <li>
                <a href="#">
                    <i class=""><img src="@/assets/images/web/us-sq.png" height="20px" width="20px" alt="" /></i>
                    <span v-if="!isSidebarCollapsed" class="text-white font-bold">English</span>
                </a>
            </li>
        </ul>
        <div class="hr"></div>
        <div v-if="!isSidebarCollapsed" class="flex justify-content-start">
            <i class="pi pi-apple mt-4 mr-5 text-2xl text-white"></i>
            <i class="pi pi-android mt-4 mr-5 text-2xl text-white"></i>
            <i class="pi pi-microsoft mt-4 mr-3 text-2xl text-white"></i>
        </div>
    </aside>
</template>
<style scoped>
li a:hover {
    color: #fff !important;
    font-weight: 500;
    text-shadow:
        0 0 3px #ffffff4d,
        0 0 5px #ffffff4d,
        0 0 8px #ffffff4d;
    transition: all 0.3s ease;
}

li a:hover i {
    color: #fc196b;
    text-shadow:
        0 0 8px #fc196b,
        0 0 15px #fc196b,
        0 0 20px #fc196b;
    transition: all 0.3s ease;
}

.sidebar.collapsed {
    width: 60px;
}

.sidebar .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    position: relative;
}

.sidebar .burger-button {
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 30px;
    padding: 0;
    position: relative;
}

.burger {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    cursor: pointer;
}

.burger-line {
    height: 2px;
    background: #fff;
    margin: 2px 0;
    width: 20px;
    transition: all 0.3s ease;
}

.burger-line.short {
    width: 15px;
}

.burger-line.shorter {
    width: 10px;
}

.burger:hover .burger-line {
    box-shadow:
        0 0 8px #fff,
        0 0 15px #fff,
        0 0 20px #fff;
    transform: scale(1.1);
}

.burger-button.clicked .burger-line:nth-child(1) {
    transform: translateY(6px) rotate(45deg);
}

.burger-button.clicked .burger-line:nth-child(2) {
    opacity: 0;
}

.burger-button.clicked .burger-line:nth-child(3) {
    transform: translateY(-6px) rotate(-45deg);
}

.sidebar .menu {
    list-style: none;
    padding: 0;
}

.sidebar .menu li {
    margin-bottom: 25px;
    font-size: 13px;
}

.sidebar .menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #7c7d7f;
    text-decoration: none;
}

.sidebar .menu a .icon {
    font-size: 20px;
}

.hr-2 {
    border-top: #fff 1px solid !important;
    border-width: 1px 0 0 0;
}

.hr {
    border-top: #74747427 1px solid;
    border-width: 1px 0 0 0;
}
.sidebar {
    width: 210px;
    background-color: #1a1d1e;
    padding-top: 10px;
    padding-left: 20px;
    padding-right: 20px;
    transition: width 0.3s ease;
    overflow: hidden;
}
</style>
