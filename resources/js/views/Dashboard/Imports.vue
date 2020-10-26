<template>
  <div>
    <h3 class="text-gray-700 text-3xl font-semibold">Importar</h3>

    <div class="mt-4">
      <h4 class="text-gray-600">Importar Estudiantes</h4>

      <div class="mt-4">
        <div
          class="w-full bg-white shadow-md rounded-md overflow-hidden border"
        >
          <form
            @submit="formSubmit"
            enctype="multipart/form-data"
            id="importForm"
          >
            <div
              class="flex w-full h-64 items-center justify-center bg-grey-lighter"
            >
              <label
                class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-indigo overflow-hidden"
              >
                <svg
                  class="w-8 h-8"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                  />
                </svg>
                <span class="mt-2 text-sm leading-normal">{{ fileName }}</span>
                <input type="file" class="hidden" @change="onFileChange" />
              </label>
            </div>
            <div class="flex mb-16 justify-center">
              <button
                class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3"
              >
                Importar
              </button>
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
      openSidebar: '',
      closeSidebar: '',
      sidebarOpen: '',
      file: '',
      loading: false,
    }
  },
  computed: {
    fileName() {
      return this.file.name ?? 'Seleccionar Archivo'
    },
  },
  methods: {
    onFileChange(e) {
      console.log(e.target.files[0])
      this.file = e.target.files[0]
    },

    formSubmit(e) {
      e.preventDefault()

      let currentObj = this

      const config = {
        headers: { 'content-type': 'multipart/form-data' },
      }

      let formData = new FormData()
      formData.append('file', this.file)

      axios
        .post('/api/students/imports', formData, config)
        .then(function (response) {
          currentObj.flashMessage = response.data.message

          document.getElementById('importForm').reset()

          currentObj.file = ''

          currentObj.$notify({
            group: 'alerts',
            type: 'success',
            title: 'Mensaje',
            text: response.data.message,
          })
        })
        .catch(function (error) {

          let message = ''

          if (error.response.status === 500) {
            message =
              'Ocurrió un problema. Puede que la información del archivo no este bien formateada'
          } else {
            message = error.response.data.errors.file[0]
          }

          currentObj.$notify({
            group: 'alerts',
            type: 'error',
            title: 'Error',
            text: message,
          })
        })
    },
  },
  created() {
    this.$emit(`update:layout`, DashboardLayout)
  },
  mounted() {
    this.loading = true
  },
}
</script>
