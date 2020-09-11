<template>
  <div>
    <div class="flex justify-between">
      <h3 class="text-gray-700 text-3xl font-medium">Estudiantes</h3>

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
          v-on:keyup.enter="searchStudents(1)"
        />
      </div>
    </div>

    <div class="mt-8"></div>

    <students-table
      :students="students"
      :meta="meta"
      :search="searchTerms"
    ></students-table>
  </div>
</template>

<script>
import DashboardLayout from '@/layouts/DashboardLayout'
import StudentsTable from '@/components/Dashboard/StudentsTable'
import User from '@/apis/User'
import Students from '@/apis/Students'

export default {
  name: 'Dashboard',
  components: { StudentsTable },
  data() {
    return {
      user: {},
      students: [],
      meta: {},
      searchTerms: '',
      openSidebar: '',
      closeSidebar: '',
      sidebarOpen: '',
    }
  },
  methods: {
    getStudents(page = 1) {
      Students.get(page)
        .then((res) => {
          console.log(res.data)
          this.students = res.data.data
          this.meta = res.data.meta.page
        })
        .catch((error) => {
          console.log(error)
        })
    },
    searchStudents(page) {
      Students.search(this.searchTerms, page)
        .then((res) => {
          this.students = res.data.data
          this.meta = res.data.meta.page
          console.log(res.data.meta);
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
  created() {
    this.$emit(`update:layout`, DashboardLayout)

    User.auth().then((response) => {
      this.user = response.data
    })
  },
  mounted() { this.getStudents() },
}
</script>

<style scoped>
.form-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: #fff;
  border-color: #e2e8f0;
  border-width: 1px;
  border-radius: 0.25rem;
  font-size: 1rem;
  line-height: 1.5;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
</style>
