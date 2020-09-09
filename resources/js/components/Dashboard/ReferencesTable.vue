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
              </td>
            </tr>
          </tbody>
        </table>
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
  },
  data() {
    return {}
  },
}
</script>
