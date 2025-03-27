import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';

const api = new Resource('check-obs');

export const useObsDectection = defineStore('use-obs-detection', {
    state: () => ({
        lang_select: null
    }),
    getters: {
        // get_con_balance: (state) => state.con_balance
    },
    actions: {
        async fnObs() {
            await api
                .list()
                .then(({ data }) => {
                    if (data.obs_running) {
                        alert('OBS Studio detected! Access denied.');
                        window.location.href = 'about:blank'; // Redirect
                    }
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {
                    this.processing = false;
                });
        }
    }
    // persist: true
});
