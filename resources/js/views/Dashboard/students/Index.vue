<template>
  <div>
    <div class="flex flex-col md:flex-row justify-between">
      <h3 class="text-gray-700 text-3xl font-medium">Estudiantes</h3>

      <!-- Search Box -->
      <div class="relative mt-4 md:mt-0 lg:mx-0">
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
          class="search-input w-64 rounded-md pl-10 pr-4 focus:border-black"
          type="text"
          placeholder="Search"
          v-model="searchTerms"
          v-on:keyup.enter="searchStudents(1)"
        />
      </div>
    </div>

    <div class="mt-8"></div>

    <div
      v-if="loading"
      class="flex justify-center items-center w-full h-screen"
    >
      <atom-spinner :animation-duration="1000" :size="60" :color="'#000000'" />
    </div>

    <students-table
      v-else
      :students="students"
      :meta="studentsMeta"
      :search="searchTerms"
    ></students-table>
  </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout'
import StudentsTable from '@/components/Dashboard/StudentsTable'
import User from '@/apis/User'
import AtomSpinner from 'epic-spinners/src/components/lib/AtomSpinner'

export default {
  name: 'Dashboard',
  components: { StudentsTable, AtomSpinner },
  data() {
    return {
      user: {},
      searchTerms: '',
      openSidebar: '',
      closeSidebar: '',
      sidebarOpen: '',
      loading: false,
    }
  },
  computed: {
    students() {
      return this.$store.state.students
    },

    studentsMeta() {
      return this.$store.state.studentsMeta
    },
  },

  methods: {
    searchStudents(page) {
      let search = this.searchTerms

      this.$store
        .dispatch('searchStudents', { searchTerms: search, page: page })
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

    this.$store.dispatch('fetchStudents').then(() => (this.loading = false))
  },
}
</script>
