<template>
    <div>
        <h3 class="text-gray-700 text-3xl font-medium">Estudiantes</h3>

        <div class="mt-8"></div>

        <students-table :students="students"></students-table>
    </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout';
import StudentsTable from '@/components/Dashboard/StudentsTable';
import User from '@/apis/User';
import Students from '@/apis/Students';

export default {
    name: 'Dashboard',
    components: { StudentsTable },
    data() {
        return {
            user: {},
            students: [],
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
        Students.getAll()
            .then((res) => {
                this.students = res.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
