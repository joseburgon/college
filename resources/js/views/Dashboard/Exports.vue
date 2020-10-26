<template>
  <div>
    <h3 class="text-gray-700 text-3xl font-semibold">Exportar</h3>

    <div class="mt-4">
      <h4 class="text-gray-600">Exportar Estudiantes Matriculados</h4>

      <div class="mt-4">
        <div
          class="max-w-sm w-full bg-white shadow-md rounded-md overflow-hidden border"
        >
          <form>
            <div
              class="flex justify-between items-center px-5 py-3 text-gray-700 border-b"
            >
              <h3 class="text-sm">Exportar Estudiantes Matriculados</h3>
              <button>
                <svg
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>

            <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
              <label class="text-xs mr-8">Curso:</label>

              <div class="inline-block relative w-64">
                <select
                  name="course_id"
                  v-model="course_id"
                  required
                  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                >
                  <option
                    v-for="(course, index) in courses"
                    :key="index"
                    :value="course.id"
                  >
                    {{ course.name }}
                  </option>
                </select>
                <div
                  class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                >
                  <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <div class="flex justify-between items-center px-5 py-3">
              <button
                class="px-3 py-1 text-gray-700 text-sm rounded-md bg-gray-200 hover:bg-gray-300 focus:outline-none"
              >
                Cancel
              </button>
              <a
                v-if="course_id"
                :href="exportLink"
                target="_blank"
                class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none"
              >
                Exportar
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DashboardLayout from '../../layouts/DashboardLayout'

export default {
  name: 'Dashboard',
  components: {},

  data() {
    return {
      course_id: '',
      courses: {},
      openSidebar: '',
      closeSidebar: '',
      sidebarOpen: '',
      loading: false,
    }
  },
  computed: {
    exportLink() {
      return `/api/enrollments/${this.course_id}`
    },
  },
  created() {
    this.$emit(`update:layout`, DashboardLayout)
  },
  mounted() {
    this.loading = true

    axios
      .get(`/api/courses`)
      .then((res) => {
        console.log(res.data)
        this.courses = res.data
      })
      .catch((e) => {
        this.$router.push({ name: 'error' })
      })
  },
}
</script>
