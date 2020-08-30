<template>
    <div>
        <h3 class="text-gray-700 text-3xl font-medium">Transacciones</h3>

        <div class="mt-8"></div>

        <transactions-table :transactions="transactions"></transactions-table>
    </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout';
import TransactionsTable from '@/components/Dashboard/TransactionsTable';
import User from '@/apis/User';
import Transactions from '@/apis/Transactions';

export default {
    name: 'Dashboard',
    components: { TransactionsTable },
    data() {
        return {
            user: {},
            transactions: [],
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
        Transactions.getAll()
            .then((res) => {
                this.transactions = res.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
