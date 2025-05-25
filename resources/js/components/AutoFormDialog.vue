<script setup>
import { computed } from 'vue';

import FloatText from '@/components/FloatText.vue';
import FloatTextArea from '@/components/FloatTextArea.vue';
import FloatSelect from '@/components/FloatSelect.vue';
import FloatNumber from '@/components/FloatNumber.vue';
import FloatCurrency from '@/components/FloatCurrency.vue';

const props = defineProps({
    modelValue: Boolean,
    title: String,
    func: String,
    form: Object,
    error: Object,
    processing: Boolean,
    formDefinition: Array,
    dropdownData: Object
});

const emit = defineEmits(['update:modelValue', 'save']);

const componentMap = {
    text: FloatText,
    textarea: FloatTextArea,
    select: FloatSelect,
    number: FloatNumber,
    currency: FloatCurrency
};

function getComponent(type) {
    return componentMap[type] || FloatText;
}

function getFieldProps(field) {
    const props = {
        label: field.label,
        name: field.name
    };

    if (field.type === 'select') {
        props.options = field.optionsKey ? props_.dropdownData?.[field.optionsKey] || [] : field.options;
        props.optionLabel = field.optionLabel || 'label';
        props.optionValue = field.optionValue || 'value';
    }

    if (field.rows) {
        props.rows = field.rows;
    }

    return props;
}

// workaround to access props inside getFieldProps
const props_ = props;
</script>

<template>
    <Dialog
        :visible="modelValue"
        @update:visible="$emit('update:modelValue', $event)"
        modal
        :closable="false"
        position="center"
        :draggable="false"
        :style="{ width: '30rem' }"
        :pt="{ root: 'border-none', mask: { style: 'backdrop-filter: blur(10px)' } }"
        :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
    >
        <div v-focustrap class="flex flex-col gap-4 w-full mb-2">
            <div class="font-semibold text-xl">{{ func }} {{ title }}</div>
            <div class="flex flex-col gap-2 w-full" v-for="(field, index) in formDefinition" :key="index">
                <component :is="getComponent(field.type)" v-model="form[field.name]" v-bind="getFieldProps(field)" :error="error" />
            </div>
        </div>

        <div class="flex items-center gap-2">
            <Button size="small" outlined type="button" label="Cancel" severity="warn" :disabled="processing" :loading="processing" @click="$emit('update:modelValue', false)" />
            <Button size="small" outlined type="button" label="Save" severity="success" :disabled="processing" :loading="processing" @click="$emit('save')" />
        </div>
    </Dialog>
</template>
