<script setup>
import { onMounted, ref } from 'vue';
import Resource from '@/api/resource.js';
const api = new Resource('sample');

import { useChatRoom } from '@/stores/game/useChatRoom.js';
const { list, listarray, room_id } = storeToRefs(useChatRoom());
const { fnChatList, fnChatSend, fnChatAdd } = useChatRoom();

onMounted(async () => {
    await window.Echo.channel('chatroom-message.' + room_id.value).listen('.ChatroomMessage', (e) => {
        fnChatAdd(api.decrypt(e?.data));
    });
    await fnChatList();
});
onBeforeUnmount(() => {
    const yourStore = useChatRoom();
    yourStore.$reset(); // Reset store when component is unmounted
});
const isChatVisible = ref(false);

const form = ref({
    message: null
});

const placeMessage = async () => {
    await fnChatSend(form.value);
    form.value.message = null;
};

const toggleChat = () => {
    isChatVisible.value = !isChatVisible.value;
};
</script>
<template>
    <Drawer v-model:visible="isChatVisible" header="Online Chat" position="right">
        <div class="flex flex-col h-screen">
            <!-- Messages container with scrolling -->
            <div class="flex-grow overflow-y-auto px-4 py-4 pb-16">
                <div class="flex items-start mb-4" v-for="i in listarray" :key="i.id">
                    <img class="w-10 h-10 rounded-full mr-3" src="/images/avatar/avatar-1.jpg" alt="Alex Avatar" />
                    <div>
                        <div class="flex items-center">
                            <span class="text-md text-white">{{ i?.user?.username }}</span>
                            <span class="text-xs text-gray-400 ml-2">{{ i?.created_at }}</span>
                        </div>
                        <p class="text-sm text-white mt-1">{{ i?.description }}</p>
                    </div>
                </div>
            </div>

            <!-- Fixed input bar at bottom -->
            <div class="fixed bottom-0 left-0 right-0 bg-gray-700 p-2 shadow-lg z-10 flex items-center">
                <textarea v-model="form.message" class="flex-grow h-16 bg-gray-800 text-white rounded-xl p-2 mr-2 resize-none focus:outline-none" placeholder="Send a message ..."></textarea>
                <button @click="placeMessage()" class="bg-blue-600 rounded-full p-2 flex items-center justify-center min-w-11 min-h-11">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px">
                        <path d="M2 21l21-9L2 3v7l15 2-15 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </Drawer>
    <button v-if="!isChatVisible" @click="toggleChat" class="toggle-btn z-50">
        <img class="live-chat" src="/images/avatar/chat.png" alt="Taylor Avatar" />
    </button>
</template>
<style scoped>
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
.toggle-btn {
    position: fixed;
    bottom: 10px;
    right: 10px;
    padding: 5px 10px;
    background-color: #fc196c00;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}
.chat-input-container {
    display: flex;
    align-items: center;
    background: #1a1e26;
    border-radius: 25px;
    padding: 5px 15px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    margin-left: 15px;
    margin-right: 10px;
    margin-bottom: 10px;
}

.custom-textarea {
    flex: 1;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 14px;
    resize: none;
    outline: none;
    padding: 10px;
    font-family: 'Arial', sans-serif;
}

.custom-textarea::placeholder {
    color: #777;
}

.send-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    margin-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.send-button svg {
    fill: #fff;
    transition: transform 0.2s ease-in-out;
}

.send-button:hover svg {
    transform: scale(1.2);
}

.csr-message {
    color: #fc196b !important;
    font-weight: 500;
}

.csr-name {
    color: greenyellow !important;
}

.csr-avatar {
    border: 2px solid greenyellow;
}

.live-chat {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-right: 10px;
    background-color: #f77f00;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
    animation: pulse 2s infinite;
}

.live-chat:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
    background-color: #e07000;
}
.chat {
    width: 335px;
    background: #0f1217;
    display: flex;
    flex-direction: column;
    padding-right: 10px;
    transition:
        transform 0.3s ease,
        opacity 0.3s ease;
}

.chat.visible {
    transform: translateY(0);
    opacity: 1;
    pointer-events: auto;
}

.chat-header {
    background: #0f1217;
    padding: 10px;
    font-size: 18px;
    border-bottom: 1px solid rgba(56, 56, 56, 0.267);
}

.chat-input {
    display: flex;
    padding: 10px;
    background: #0f1217;
}

.chat-input input {
    flex: 1;
    padding: 5px;
    border: none;
    border-radius: 3px;
}

.chat-input button {
    background: #f77f00;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    margin-left: 5px;
    cursor: pointer;
}

@media (max-width: 767px) {
    .mobile-hidden {
        display: none;
    }
}
</style>
