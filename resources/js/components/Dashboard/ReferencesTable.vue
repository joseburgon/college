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
                ID / Code
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Student / Course
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Created / Updated
              </th>
            </tr>
          </thead>

          <tbody class="bg-white">
            <tr v-for="(reference, index) in references" :key="index">
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <div>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                      {{ reference.id }}
                    </div>
                    <div class="text-sm leading-5 text-gray-500">
                      {{ reference.attributes.code }}
                    </div>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div v-if="reference.attributes.student">
                  <router-link
                    :to="{
                      name: 'students-edit',
                      params: { id: reference.attributes.student.id },
                    }"
                    class="text-indigo-600 hover:text-indigo-900"
                    >{{
                      reference.attributes.student.name +
                      ' ' +
                      reference.attributes.student.last_name
                    }}
                  </router-link>
                  <div class="text-sm leading-5 text-gray-500">
                    {{ reference.attributes.course.name }}
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <div>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                      {{ reference.attributes.created_at }}
                    </div>
                    <div class="text-sm leading-5 text-gray-500">
                      {{ reference.attributes.updated_at }}
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div
          class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between"
        >
          <span class="text-xs xs:text-sm text-gray-900">{{
            `Mostrando ${meta.from} a ${meta.to} de ${meta.total} referencias`
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
  name: 'referencesTable',
  components: {},
  props: {
    references: {
      type: Array,
      default: () => [],
    },
    meta: {
      type: Object,
      default: () => {},
    },
    search: {
      type: String,
      default: '',
    },
  },
  methods: {
    nextPage() {
      if (this.meta['current-page'] === this.meta['last-page']) {
        return alert(`Te encuentras en la última pagina de resultados.`)
      }

      let page = this.meta['current-page'] + 1
      this.$parent.searchReferences(page)
    },
    prevPage() {
      if (this.meta['current-page'] === 1) {
        return alert(`Te encuentras en la primera pagina de resultados.`)
      }

      let page = this.meta['current-page'] - 1

      this.$parent.searchReferences(page)
    },
  },
}
</script>
