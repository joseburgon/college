<template>
  <div class="mt-8">
    <div class="mt-4">
      <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">
          Edit Student
        </h2>

        <form @submit.prevent="update">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
              <label class="text-gray-700" for="name">First Name</label>
              <input
                v-model="student.name"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="last_name">Last Name</label>
              <input
                v-model="student.last_name"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="email"
              />
            </div>

            <div>
              <label class="text-gray-700" for="email">Email</label>
              <input
                v-model="student.email"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="city">City</label>
              <input
                v-model="student.city"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>

            <div>
              <label class="text-gray-700" for="status">Status</label>
              <input
                v-model="student.status"
                class="form-input w-full mt-2 rounded-md focus:border-indigo-600"
                type="text"
              />
            </div>
          </div>

          <div class="flex justify-end mt-4">
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
          this.student = res.data.student
        })
        .catch((error) => {
          console.log(error)
        })
    },

    update() {
      console.log('Update Method!')
    },
  },
}
</script>
