<script setup>
import useScript from '@/composables/admin/useTransaction.js';
const { keyword, form, func, title, error, processing, option, tableData, formFieldDefinition, totalRecords, columns, search, fetch, sort, save, openModal, showEdit } = useScript();
</script>

<template>
    <div>
        <div class="card">
            <h6 class="text-xl mb-5">{{ title }}</h6>
            <div class="grid grid-cols-12 gap-2 mb-4">
                <div class="col-span-6 lg:col-span-3 xl:col-span-2">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-search" /></InputIcon>
                        <InputText size="small" placeholder="Keyword Search" class="w-full" v-model="keyword" @keypress.enter="search" />
                    </IconField>
                </div>
                <div class="col-span-6 lg:col-span-3 xl:col-span-2">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-list" /></InputIcon>
                        <InputText size="small" placeholder="Type" class="w-full" v-model="keyword" @keypress.enter="search" />
                    </IconField>
                </div>
                <div class="col-span-6 lg:col-span-3 xl:col-span-2">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-calendar" /></InputIcon>
                        <DatePicker v-model="date" size="small" class="w-full" />
                    </IconField>
                </div>
                <div class="col-span-6 lg:col-span-3 xl:col-span-2">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-calendar" /></InputIcon>
                        <DatePicker v-model="date" size="small" class="w-full" />
                    </IconField>
                </div>

                <div class="col-span-12 lg:col-span-3 xl:col-span-2">
                    <IconField>
                        <InputIcon><i class="fa fa-duotone fa-calendar" /></InputIcon>
                        <DatePicker v-model="date" size="small" class="w-full" />
                    </IconField>
                </div>
                <div class="col-span-12 lg:col-span-3 xl:col-span-1 text-end">
                    <Button size="small" label="Search" class="w-full" icon="pi pi-pencil" severity="info" @click="showEdit(data)" />
                </div>
                <div class="col-span-12 lg:col-span-3 xl:col-span-1 text-end">
                    <Button size="small" label="Reset" class="w-full" icon="pi pi-pencil" severity="info" @click="showEdit(data)" />
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
        <AutoFormDialog v-model="option.show_modal" :title="title" :func="func" :form="form" :error="error" :processing="processing" :formDefinition="formFieldDefinition" :dropdownData="dropdownData" @save="save" />
    </div>
</template>
