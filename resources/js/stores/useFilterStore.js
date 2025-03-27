import { defineStore } from 'pinia';
export const useFilterStore = defineStore('filter', {
    state: () => ({
        area_list: [],
        location_list: [],
        sub_location_list: [],
        department_list: [],
        report_type_list: [],
        incident_title_list: []
    }),
    getters: {
        // get_token: (state) => state.token
    },
    actions: {
        fn_area(res, id) {
            this.area_list = [];
            this.area_list = res.filter((i) => {
                return i.group_section_id.includes(id);
            });
            console.log(this.area_list);
        },
        fn_location(res, id) {
            this.location_list = [];
            this.location_list = res.filter((i) => {
                return i.area_id.includes(id);
            });
        },
        fn_sublocation(res, id) {
            this.sub_location_list = [];
            this.sub_location_list = res.filter((i) => {
                return i.location_id.includes(id);
            });
        },
        fn_department(res, id) {
            this.department_list = [];
            this.department_list = res.filter((i) => {
                return i.group_section_id.includes(id);
            });
        },
        fn_report_type(res, id) {
            this.report_type_list = [];
            this.report_type_list = res.filter((i) => {
                return i.department_id.includes(id);
            });
        },
        fn_incident_title(res, id) {
            this.incident_title_list = [];
            this.incident_title_list = res.filter((i) => {
                return i.report_type_id.includes(id);
            });
        }
    }
    // persist: true
});
