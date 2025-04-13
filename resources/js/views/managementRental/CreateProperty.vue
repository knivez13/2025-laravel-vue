<script setup>
const src = ref(null);

function onFileSelect(event) {
    const file = event.files[0];
    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
}

const dropdownItems = ref([
    { name: 'Option 1', code: 'Option 1' },
    { name: 'Option 2', code: 'Option 2' },
    { name: 'Option 3', code: 'Option 3' }
]);
const error = ref();
const form = ref();

const dropdownItem = ref(null);
</script>

<template>
    <div class="card">
        <Fluid>
            <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col col-span-3 md:col-span-2 gap-4 w-full">
                    <div class="font-semibold text-xl">Create Property</div>
                    <div class="font-semibold">Basic information</div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Property Category</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Property Type</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Property Condition</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Property Listing Type</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                            <label for="on_label">Property Name</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <Textarea :invalid="error?.status == 422 && error?.validation['description']" id="address" rows="2" class="w-full" />
                            <label for="on_label">Short Description</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <Textarea :invalid="error?.status == 422 && error?.validation['description']" id="address" rows="4" class="w-full" />
                            <label for="on_label">Full Description</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="font-semibold">Address Information</div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Province</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Municipality / City</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Barangay</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Zip Code</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                            <label for="on_label">Full Address</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Longitude</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Latitude</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                    </div>
                    <div class="font-semibold">Structure Information</div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Build Year</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Area Size / sq.ft </label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Room</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Comfort Room</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Car port</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Pet Friendly</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                    </div>

                    <div class="font-semibold">Price Information</div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Minimum Month to Rent</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Mode of Payment</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                                <label for="on_label">Payment By</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full">
                            <FloatLabel variant="on" class="w-full">
                                <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                                <label for="on_label">Price Amount</label>
                            </FloatLabel>
                            <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                            <label for="on_label">Property Utilities Included</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                            <label for="on_label">Amenities</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <Select :invalid="error?.status == 422 && error?.validation['description']" id="state" v-model="dropdownItem" :options="dropdownItems" optionLabel="name" class="w-full"></Select>
                            <label for="on_label">Appliances</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                </div>
                <div class="flex flex-col col-span-3 md:col-span-1 gap-4 w-full">
                    <div class="font-semibold text-xl">Image and Files</div>
                    <div class="font-semibold">Property Files</div>

                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                            <label for="on_label">Video URL</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FloatLabel variant="on" class="w-full">
                            <InputText :invalid="error?.status == 422 && error?.validation['description']" id="zip" type="text" class="w-full" />
                            <label for="on_label">Video Tour URL</label>
                        </FloatLabel>
                        <small class="text-rose-500" v-if="error?.status == 422 && error?.validation['description']">{{ error.validation['description'] }}</small>
                    </div>

                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Cover Photo" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Floor Plan" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 1" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 2" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 3" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 4" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 5" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                    <div class="flex flex-wrap gap-2 w-full">
                        <FileUpload chooseLabel="Image 6" mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        <Image v-if="src" :src="src" alt="Image" width="50" preview />
                    </div>
                </div>
            </div>
        </Fluid>
        <div class="flex items-center gap-2 mt-4">
            <Button outlined :disabled="processing" :loading="processing" type="button" label="Cancel" severity="warn" @click="open_modal(false)"></Button>
            <Button :disabled="processing" :loading="processing" type="button" label="Save" severity="primary" @click="save()"></Button>
        </div>
    </div>
</template>
