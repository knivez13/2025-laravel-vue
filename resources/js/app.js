import './bootstrap';
import { useAuthStore } from '@/stores/useAuthStore.js';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import Aura from '@primevue/themes/aura';
import PrimeVue from 'primevue/config';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';

import '@/assets/styles.scss';
import '@/assets/tailwind.css';

import GoogleTranslateSelect from '@google-translate-select/vue3';

import { createPinia } from 'pinia';
import piniaPluginPersistedState from 'pinia-plugin-persistedstate';
import i18n from './i18n';

const pinia = createPinia();
pinia.use(piniaPluginPersistedState);

const app = createApp(App);

app.use(router);
app.use(pinia);
app.use(i18n);

app.use(GoogleTranslateSelect);

app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            darkModeSelector: '.app-dark'
        }
    }
});
app.use(ToastService);
app.use(ConfirmationService);

app.mount('#app');

const AuthStore = useAuthStore();
