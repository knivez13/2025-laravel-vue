import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';

const api = new Resource('game/chats');

export const useChatRoom = defineStore('use-game-chatroom', {
    state: () => ({
        list: [],
        listarray: [],
        room_id: null
    }),
    getters: {
        // get_con_balance: (state) => state.con_balance
    },
    actions: {
        fnChatAdd(res) {
            this.listarray.push(res);
        },
        async fnChatList() {
            this.error = null;
            this.list = [];
            await api
                .list()
                .then(({ data }) => {
                    console.log(api.decrypt(data?.data));
                    this.list = api.decrypt(data?.data).list;
                    this.listarray = api.decrypt(data?.data).list;
                    this.room_id = api.decrypt(data?.data).room_id;
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {
                    this.processing = false;
                });
        },
        async fnChatSend(res) {
            this.error = null;
            this.list = [];
            await api
                .store({
                    enm: api.encrypt({ data: res })
                })
                .then(({ data }) => {
                    console.log(api.decrypt(data?.data));
                    // this.list = api.decrypt(data?.data);
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {
                    this.processing = false;
                });
        }
    },
    persist: true
});
