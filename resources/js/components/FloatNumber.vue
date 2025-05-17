<template>
    <div>
        <FloatLabel class="w-full" :variant="variant">
            <InputNumber size="small" v-model="model" :autofocus="autofocus" class="w-full" :invalid="isInvalid" :min="1" :maxFractionDigits="8" :minFractionDigits="2" />
            <label class="block font-semibold">{{ label }}</label>
        </FloatLabel>
        <small class="text-rose-500" v-if="isInvalid">{{ error.validation?.[name] }}</small>
    </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue';

// Props
const props = defineProps({
    modelValue: [String, Number],
    label: { type: String, required: true },
    name: { type: String, required: true },
    autofocus: { type: Boolean, default: false },
    variant: { type: String, default: 'on' },
    error: { type: Object, default: () => ({}) }
});

// Emit function
const emit = defineEmits(['update:modelValue']);

// Computed to handle invalid state
const isInvalid = computed(() => {
    return props.error?.status === 422 && props.error?.validation?.[props.name];
});

// Create a reactive ref to handle the value inside the component
const model = ref(props.modelValue);

// Watch for changes in the modelValue and update the internal model
watch(
    () => props.modelValue,
    (newValue) => {
        model.value = newValue;
    }
);

// When the input changes, emit the updated value to the parent component
watch(model, (newVal) => {
    emit('update:modelValue', newVal);
});
</script>
