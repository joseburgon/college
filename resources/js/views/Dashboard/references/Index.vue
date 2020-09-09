<template>
    <div>
        <h3 class="text-gray-700 text-3xl font-medium">Referencias</h3>

        <div class="mt-8"></div>

        <references-table :references="references"></references-table>
    </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout';
import ReferencesTable from '@/components/Dashboard/ReferencesTable';
import User from '@/apis/User';
import References from '@/apis/References';

export default {
    name: 'Dashboard',
    components: { ReferencesTable },
    data() {
        return {
            user: {},
            references: [],
            openSidebar: '',
            closeSidebar: '',
            sidebarOpen: '',
        };
    },
    created() {
        this.$emit(`update:layout`, DashboardLayout);

        User.auth().then((response) => {
            this.user = response.data;
        });
    },
    mounted() {
        References.getAll()
            .then((res) => {
                this.references = res.data.data;
                console.log(this.references[0]);
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
