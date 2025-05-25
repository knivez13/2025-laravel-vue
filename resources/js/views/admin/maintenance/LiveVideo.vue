<script setup>
import useScript from '@/composables/admin/maintenance/useLiveVideo.js';
const { keyword, form, func, title, error, processing, option, tableData, totalRecords, dropdownData, columns, search, fetch, sort, save, openModal, showEdit } = useScript();
</script>

<template>
    <div>
        <div class="card">
            <h6 class="text-xl mb-5">{{ title }}</h6>
            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-6">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-search" /></InputIcon>
                        <InputText size="small" placeholder="Keyword Search" class="w-full" v-model="keyword" @keypress.enter="search" />
                    </IconField>
                </div>
                <div class="col-span-6 text-end">
                    <Button size="small" outlined severity="secondary" icon="pi pi-plus" v-tooltip.top="'Add New'" label="Add New" @click="openModal(true)" />
                </div>
            </div>
            <div class="field">
                <VueDataTable :value="tableData" :loading="processing" :option="option" :totalRecords="totalRecords" :columns="columns" @page="fetch" @sort="sort">
                    <template #actions="{ data }">
                        <div class="text-end">
                            <Button text size="small" type="button" icon="pi pi-pencil" severity="info" class="h-8 w-8 mr-2" v-tooltip.top="'Edit'" @click="showEdit(data)" />
                        </div>
                    </template>
                </VueDataTable>
            </div>
        </div>

        <Dialog
            v-model:visible="option.show_modal"
            modal
            :closable="false"
            position="center"
            :draggable="false"
            :style="{ width: '30rem' }"
            :pt="{
                root: 'border-none',
                mask: { style: 'backdrop-filter: blur(10px)' }
            }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <div v-focustrap class="flex flex-col gap-4 w-full mb-2">
                <div class="font-semibold text-xl">{{ func }} {{ title }}</div>

                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.game_type_id" label="Game Type" name="game_type_id" :options="dropdownData['game_type']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatSelect v-model="form.video_type_id" label="Video Type" name="video_type_id" :options="dropdownData['video_type']" optionLabel="code" optionValue="id" :error="error" />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.name" label="Name" name="name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.code" label="Code" name="code" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.app_name" label="App Name" name="app_name" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.stream_key" label="Stream Key" name="stream_key" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.url" label="Url" name="url" :error="error" autofocus />
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <FloatText v-model="form.server_ip" label="Server IP Address" name="server_ip" :error="error" autofocus />
                </div>
            </div>

            <div class="flex items-center gap-2">
                <Button size="small" outlined type="button" label="Cancel" severity="warn" :disabled="processing" :loading="processing" @click="openModal(false)" />
                <Button size="small" outlined type="button" label="Save" severity="success" :disabled="processing" :loading="processing" @click="save" />
            </div>
        </Dialog>
    </div>
</template>
