import { defineStore } from 'pinia';

export const useDefaultStore = defineStore('default_data', {
    state: () => ({
        isDark: true,
        language: [
            { name: 'Australia', code: 'AU' },
            { name: 'Brazil', code: 'BR' },
            { name: 'China', code: 'CN' },
            { name: 'Egypt', code: 'EG' },
            { name: 'France', code: 'FR' },
            { name: 'Germany', code: 'DE' },
            { name: 'India', code: 'IN' },
            { name: 'Japan', code: 'JP' },
            { name: 'Spain', code: 'ES' },
            { name: 'United States', code: 'US' }
        ]
    }),
    getters: {
        //
    },
    actions: {
        // Check if the user has a specific permission
        isDarkToggle() {
            this.isDark = !this.isDark;
            this.isDarkCheck();
        },
        isDarkCheck() {
            if (this.isDark) {
                document.documentElement.classList.add('app-dark');
            } else {
                document.documentElement.classList.remove('app-dark');
            }
        }
    },
    persist: true
});
