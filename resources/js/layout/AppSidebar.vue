<script setup>
import AppMenu from './AppMenu.vue';
import { useDefaultStore } from '@/stores/useDefaultStore.js';
const { language } = storeToRefs(useDefaultStore());
const { t, locale } = useI18n();
const selectedCountry = ref();

function changeLanguage(lang) {
    locale.value = lang;
}
</script>

<template>
    <div class="layout-sidebar">
        <div class="mt-5 grid justify-items-center">
            <Select v-model="selectedCountry" :options="language" optionLabel="name" placeholder="Select a Country" class="w-full mb-5">
                <template #value="slotProps">
                    <div v-if="slotProps.value" class="flex items-center">
                        <img :alt="slotProps.value.label" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`mr-2 flag flag-${slotProps.value.code.toLowerCase()}`" style="width: 18px" />
                        <div>{{ slotProps.value.name }}</div>
                    </div>
                    <span v-else>
                        {{ slotProps.placeholder }}
                    </span>
                </template>
                <template #option="slotProps">
                    <div class="flex items-center">
                        <img :alt="slotProps.option.label" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`mr-2 flag flag-${slotProps.option.code.toLowerCase()}`" style="width: 18px" />
                        <div>{{ slotProps.option.name }}</div>
                    </div>
                </template>
                <template #dropdownicon>
                    <i class="pi pi-language" />
                </template>
                <template #header>
                    <div class="font-medium p-3">Available Language</div>
                </template>
            </Select>
            <Avatar label="P" class="mb-1" size="xlarge" />
            <div>Role</div>
            <div class="mb-5">Agent Level</div>
            <ButtonGroup class="w-full">
                <Button variant="outlined" label="Save" class="w-full" />
                <!-- <InputText v-model="data[field]" autofocus fluid /> -->
                <Button icon="pi pi-refresh" style="width: 25%" />
            </ButtonGroup>
        </div>

        <app-menu></app-menu>
    </div>
</template>

<style lang="scss" scoped></style>
