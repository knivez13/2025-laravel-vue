// import { useBankTypeStore } from '@/stores/admin/maintenance/useBankTypeStore';
import useDynamicStore from '@/composables/stores/useDynamicStore';
const useStore = useDynamicStore('admin-maintenance-live-video', 'admin/maintenance/liveVideo');
import useCrudComposable from '@/composables/scripts/useCrudComposable';

const formDefinition = {
    game_type_id: null,
    video_type_id: null,
    name: null,
    code: null,
    app_name: null,
    stream_key: null,
    url: null,
    server_ip: null
};

const formFieldDefinition = [
    { type: 'text', name: 'code', label: 'Code' },
    { type: 'textarea', name: 'description', label: 'Description' }
];

const columnDefinition = [
    { field: 'game_type.code', header: 'Game Type', sortable: false, class: 'grid-table-line' },
    { field: 'video_type.code', header: 'Video Type', sortable: false, class: 'grid-table-line' },
    { field: 'name', header: 'Name', sortable: true, class: 'grid-table-line' },
    { field: 'code', header: 'Code', sortable: true, class: 'grid-table-line' },
    { field: 'app_name', header: 'App Name', sortable: true, class: 'grid-table-line' },
    { field: 'stream_key', header: 'Stream Keys', sortable: true, class: 'grid-table-line' },
    { field: 'url', header: 'Url', sortable: true, class: 'grid-table-line' },
    { field: 'server_ip', header: 'Server Ip', sortable: true, class: 'grid-table-line' },
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
export default function useLiveVideo() {
    const crud = useCrudComposable('sample', useStore, columnDefinition, formDefinition, 'Game Video', formFieldDefinition);
    const customFunction = () => {
        console.log('This is a custom function specific to Bank Type');
    };
    console.log(crud);
    return {
        ...crud,
        customFunction
    };
}
