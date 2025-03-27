<script setup>
import { computed, onMounted, ref } from 'vue';

const currentDate = ref(new Date());

const formattedDate = computed(() => {
    const date = currentDate.value;
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const month = months[date.getMonth()];
    const day = date.getDate();
    let hour = date.getHours();
    const minute = date.getMinutes();
    const second = date.getSeconds();
    const period = hour >= 12 ? 'PM' : 'AM';

    // Convert 24-hour format to 12-hour format
    if (hour > 12) {
        hour -= 12;
    } else if (hour === 0) {
        hour = 12;
    }

    return `${month} ${day}, ${date.getFullYear()} ${hour}:${minute}:${second} ${period}`;
});

onMounted(() => {
    setInterval(() => {
        currentDate.value = new Date();
    }, 1000);
});
</script>

<template>
    <div class="">
        <div class="flex items-center justify-between">
            <span class="text-[#F11641] font-bold">5 STAG BIG EVENT DERBY FINALS -DEC 22,2024 </span>
            <p class="text-[#E2E27E]">{{ formattedDate }}</p>
        </div>
        <iframe src="https://www.youtube.com/embed/GLLlxzhLgFc?si=8ez8LQYl-Oti55Cs" frameborder="0" width="100%" height="460px"></iframe>
        <div class="flex items-center justify-around">
            <div class="cursor-pointer hover:bg-[#141414] w-[33%] p-2"><p class="text-center">MAIN</p></div>
            <div class="cursor-pointer hover:bg-[#141414] w-[33%] p-2"><p class="text-center">VIDEO 2</p></div>
            <div class="cursor-pointer hover:bg-[#141414] w-[33%] p-2"><p class="text-center">VIDEO 3</p></div>
        </div>
    </div>
</template>
