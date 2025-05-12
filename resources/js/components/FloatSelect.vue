<template>
    <div>
        <FloatLabel class="w-full" :variant="variant">
            <Select v-model="model" :options="options" :optionLabel="optionLabel" :optionValue="optionValue" :autofocus="autofocus" class="w-full" :invalid="isInvalid" />
            <label class="block font-semibold">{{ label }}</label>
        </FloatLabel>
        <small class="text-rose-500" v-if="isInvalid">{{ error.validation?.[name] }}</small>
    </div>
</template>

<script setup>
import { computed, toRefs } from 'vue';

const props = defineProps({
    modelValue: [String, Number, Object],
    label: { type: String, required: true },
    name: { type: String, required: true },
    optionLabel: { type: String, required: true },
    optionValue: { type: String, required: true },
    options: { type: Array, default: () => [] },
    autofocus: { type: Boolean, default: false },
    variant: { type: String, default: 'on' },
    error: { type: Object, default: () => ({}) }
});

const emit = defineEmits(['update:modelValue']);

const model = computed({
    get: () => props.modelValue,
    set: (val) => emit('update:modelValue', val)
});

watch(
    () => props.modelValue,
    (newValue) => {
        model.value = newValue;
    }
);

const isInvalid = computed(() => {
    return props.error?.status === 422 && props.error?.validation?.[props.name];
});
</script>
