// import { useBankTypeStore } from '@/stores/admin/maintenance/useBankTypeStore';
import useDynamicStore from '@/composables/stores/useDynamicStore';
const useStore = useDynamicStore('admin-user-user-list', 'admin/user/userList');
import useCrudComposable from '@/composables/scripts/useCrudComposable';

const formDefinition = {
    code: null,
    description: null
};

const formFieldDefinition = [
    { type: 'text', name: 'code', label: 'Code' },
    { type: 'textarea', name: 'description', label: 'Description' }
];

const columnDefinition = [
    { field: 'code', header: '#', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Name', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Login ID', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Deposit', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Withdraw', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Remarks', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'IP Address', sortable: true, class: 'grid-table-line' },
    { field: 'created_at', header: 'Created Date', sortable: true, class: 'grid-table-line' },
    { field: 'description', header: 'Created By', sortable: true, class: 'grid-table-line' },

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

const roles = ['SystemAdmin'];

export default function useTransaction() {
    const crud = useCrudComposable('sample', useStore, columnDefinition, formDefinition, 'Transaction', formFieldDefinition, roles);
    const customFunction = () => {
        console.log('This is a custom function specific to Bank Type');
    };
    return {
        ...crud,
        customFunction
    };
}
