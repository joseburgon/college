<template>
  <div class="mt-8" v-if="student.attributes">
    <div class="mt-4">
      <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">
          Editar Estudiante
        </h2>

        <form @submit.prevent="updateStudent">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
              <label class="text-gray-700" for="name">Nombres</label>
              <input
                v-model="student.attributes.name"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="last_name">Apellidos</label>
              <input
                v-model="student.attributes.last_name"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="email">Email</label>
              <input
                v-model="student.attributes.email"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="email"
                disabled
              />
            </div>

            <div>
              <label class="text-gray-700" for="city"
                >Identificaci&oacute;n</label
              >
              <input
                v-model="student.attributes.identification"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="phone"
                >Celular</label
              >
              <input
                v-model="student.attributes.phone"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="city">Ciudad</label>
              <input
                v-model="student.attributes.city"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="city">Estado / Dpto.</label>
              <input
                v-model="student.attributes.state"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="city">Pa&iacute;s</label>
              <input
                v-model="student.attributes.country"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="status">Status</label>
              <input
                v-model="student.attributes.status"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="status"
                >Usuario Thinkific</label
              >
              <input
                v-model="student.attributes.thinkific_user_id"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>
          </div>

          <div class="flex justify-between mt-4">
            <div class="flex flex-col mt-4" v-if="errors">
              <span
                v-for="(error, index) in errors"
                :key="index"
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                >{{ error.detail }}
              </span>
            </div>
            <button
              class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Students from '@/apis/Students'
import DashboardLayout from '@/layouts/DashboardLayout'

export default {
  data() {
    return {
      student: {},
      errors: [],
    }
  },
  created() {
    this.$emit(`update:layout`, DashboardLayout)
    this.getStudent()
  },
  methods: {
    getStudent() {
      const { id } = this.$route.params
      Students.getStudent(id)
        .then((res) => {
          this.student = res.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },

    updateStudent() {
      const { ['email']: remove, ...attributes } = this.student.attributes
      console.log(attributes)
      Students.update(this.student.id, attributes)
        .then((res) => {
          this.errors = []

          this.$notify({
            group: 'alerts',
            type: 'success',
            title: 'Mensaje',
            text: '¡Estudiante actualizado exitosamente!',
          })
        })
        .catch((error) => {
          this.errors = error.response.data.errors

          this.$notify({
            group: 'alerts',
            type: 'error',
            title: 'Error',
            text: 'Ocurrió un error',
          })
        })
    },
  },
}
</script>
