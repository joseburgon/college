<template>
  <div>
    <div class="flex justify-between">
      <h3 class="text-gray-700 text-3xl font-medium">Transacciones</h3>
      <!-- Search Box -->
      <div class="relative mx-4 lg:mx-0">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
            <path
              d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </span>

        <input
          class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
          type="text"
          placeholder="Search"
          v-model="searchTerms"
          v-on:keyup.enter="searchTransactions(1)"
        />
      </div>
    </div>

    <div
      v-if="loading"
      class="flex justify-center items-center w-full h-screen"
    >
      <atom-spinner :animation-duration="1000" :size="60" :color="'#000000'" />
    </div>

    <transactions-table
      v-else
      :transactions="transactions"
      :meta="transactionsMeta"
      :search="searchTerms"
    ></transactions-table>
  </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout'
import TransactionsTable from '@/components/Dashboard/TransactionsTable'
import User from '@/apis/User'
import { AtomSpinner } from 'epic-spinners'

export default {
  name: 'Dashboard',

  components: { TransactionsTable, AtomSpinner },

  data() {
    return {
      user: {},
      openSidebar: '',
      closeSidebar: '',
      sidebarOpen: '',
      searchTerms: '',
      loading: false,
    }
  },

  computed: {
    transactions() {
      return this.$store.state.transactions
    },

    transactionsMeta() {
      return this.$store.state.transactionsMeta
    },
  },

  methods: {
    searchTransactions(page) {
      let search = this.searchTerms

      this.$store
        .dispatch('searchTransactions', { searchTerms: search, page: page })
        .then(() => (this.loading = false))
    },
  },

  created() {
    this.$emit(`update:layout`, DashboardLayout)

    User.auth().then((response) => {
      this.user = response.data
    })
  },

  mounted() {
    this.loading = true

    this.$store.dispatch('fetchTransactions').then(() => (this.loading = false))
  },
}
</script>
