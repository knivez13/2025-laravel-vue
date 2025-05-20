<script setup>
import { computed } from 'vue';

const props = defineProps({
  value: Array,
  loading: Boolean,
  option: Object,
  totalRecords: Number,
  columns: {
    type: Array,
    default: () => [] // array of objects like { field: 'code', header: 'Code', sortable: true }
  },
  rowsPerPageOptions: {
    type: Array,
    default: () => [10, 20, 50, 100]
  }
});

const emit = defineEmits(['sort', 'page', 'action']);
</script>

<template>
  <DataTable
    v-model:sortField="option.sortBy"
    v-model:rows="option.rows"
    v-model:sortOrder="option.sortOrder"
    :totalRecords="totalRecords"
    :loading="loading"
    :value="value"
    :scrollable="true"
    :rowsPerPageOptions="rowsPerPageOptions"
    :lazy="true"
    :paginator="true"
    paginatorTemplate=" FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink RowsPerPageDropdown"
    currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
    showGridlines
    tableStyle="min-width: 20rem"
    scrollDirection="both"
    size="small"
    @page="emit('page', $event)"
    @sort="emit('sort', $event)"
  >
    <Column
      v-for="col in columns"
      :key="col.field"
      :field="col.field"
      :header="col.header"
      :sortable="col.sortable ?? false"
      :class="col.class"
      :style="col.style"
      :frozen="col.frozen"
      :alignFrozen="col.alignFrozen"
      :headerStyle="col.headerStyle"
      :bodyStyle="col.bodyStyle"
    >
      <!-- Allow custom slot if provided -->
      <template v-if="$slots[col.field]" #body="slotProps">
        <slot :name="col.field" v-bind="slotProps" />
      </template>
    </Column>
  </DataTable>
</template>
