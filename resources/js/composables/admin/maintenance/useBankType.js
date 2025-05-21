// import { useBankTypeStore } from '@/stores/admin/maintenance/useBankTypeStore';
import useDynamicStore from '@/composables/stores/useDynamicStore';
const useBankTypeStore = useDynamicStore('admin-maintenance-bank-type', 'admin/maintenance/bankType');
import useCrudComposable from '@/composables/scripts/useCrudComposable';

const formDefinition = {
    code: null,
    description: null
};

const columnDefinition = [
    { field: 'code', header: 'Code', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Description', sortable: true, class: 'grid-table-line' },
    { field: 'created_at', header: 'Created Date', sortable: true, class: 'grid-table-line' },
    { field: 'updated_at', header: 'Updated Date', sortable: true, class: 'grid-table-line' },
    {
        field: 'actions',
        header: '',
        frozen: true,
        alignFrozen: 'right',
        class: 'grid-table-line',
        style: 'width: 1%',
        headerStyle: 'text-align: center',
        bodyStyle: 'text-align: center; overflow: visible'
    }
];

export default function useBankType() {
    const crud = useCrudComposable('sample', useBankTypeStore, columnDefinition, formDefinition, 'Bank Type');
    const customFunction = () => {
        console.log('This is a custom function specific to Bank Type');
    };
    return {
        ...crud,
        customFunction
    };
}
