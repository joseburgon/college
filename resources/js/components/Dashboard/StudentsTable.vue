<template>
  <div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
      >
        <table class="min-w-full">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Student Name / Email
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Phone / ID
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Status
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                City
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>

          <tbody class="bg-white">
            <tr v-for="(student, index) in students" :key="index">
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img
                      class="h-10 w-10 rounded-full"
                      :src="'/img/student_default_pic.png'"
                      alt=""
                    />
                  </div>

                  <div class="ml-4">
                    <div class="text-sm leading-5 font-medium text-gray-900">
                      {{
                        `${student.attributes.name} ${student.attributes.last_name}`
                      }}
                    </div>
                    <div class="text-sm leading-5 text-gray-500">
                      {{ student.attributes.email }}
                    </div>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">
                  {{ student.attributes.phone }}
                </div>
                <div class="text-sm leading-5 text-gray-500">
                  {{ student.attributes.identification }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  >{{ student.attributes.status }}</span
                >
              </td>

              <td
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
              >
                {{ student.attributes.city }}
              </td>

              <td
                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
              >
                <router-link
                  :to="{
                    name: 'students-edit',
                    params: { id: student.id },
                  }"
                  class="text-indigo-600 hover:text-indigo-900"
                  >Edit
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
        <div
          class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between"
        >
          <span class="text-xs xs:text-sm text-gray-900">{{
            `Mostrando ${meta.from} a ${meta.to} de ${meta.total} estudiantes`
          }}</span>

          <div class="inline-flex mt-2 xs:mt-0">
            <button
              class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l"
              @click="prevPage"
            >
              Prev
            </button>
            <button
              class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r"
              @click="nextPage"
            >
              Next
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StudentsTable',
  components: {},
  props: {
    students: {
      type: Array,
      default: () => [],
    },
    meta: {
      type: Object,
      default: () => {},
    },
    search: {
        type: String,
        default: ''
    }
  },
  data() {
    return {}
  },
  methods: {
    nextPage() {
      if (this.meta['current-page'] === this.meta['last-page']) {
        return alert(`Te encuentras en la última pagina de resultados.`)
      }

      let page = this.meta['current-page'] + 1
      this.$parent.searchStudents(page)
    },
    prevPage() {
      if (this.meta['current-page'] === 1) {
        return alert(`Te encuentras en la primera pagina de resultados.`)
      }

      let page = this.meta['current-page'] - 1

      this.$parent.searchStudents(page)
    },
  },
}
</script>
