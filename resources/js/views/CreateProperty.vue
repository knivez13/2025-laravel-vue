<script setup>
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n();

function changeLanguage(lang) {
    locale.value = lang;
}
</script>

<template>
    <div class="grid grid-cols-12 gap-8">
        <h1>{{ t('welcome') }}</h1>
        <p>{{ t('message') }}</p>

        <Button @click="changeLanguage('en')">English</Button>
        <Button @click="changeLanguage('fr')">Français</Button>
    </div>
</template>
