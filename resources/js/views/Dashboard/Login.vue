<template>
  <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
    <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
      <div class="flex flex justify-center items-center">
        <px-logo class="w-40" />
      </div>

      <form class="mt-4" @submit.prevent="login">
        <label class="block">
          <span class="text-gray-700 text-sm">Email</span>
          <input
            v-model="form.email"
            type="email"
            class="form-input mt-1 block w-full rounded-md focus:border-indigo-600"
          />
        </label>

        <label class="block mt-3">
          <span class="text-gray-700 text-sm">Password</span>
          <input
            v-model="form.password"
            type="password"
            class="form-input mt-1 block w-full rounded-md focus:border-indigo-600"
          />
        </label>

        <div class="flex justify-between items-center mt-4">
          <div>
            <label class="inline-flex items-center">
              <input type="checkbox" class="form-checkbox text-indigo-600" />
              <span class="mx-2 text-gray-600 text-sm">Remember me</span>
            </label>
          </div>

          <div>
            <a class="block text-sm fontme text-black hover:underline" href="#"
              >Forgot your password?</a
            >
          </div>
        </div>

        <div class="flex mt-4">
          <span v-if="errors.status" class="text-red-700 text-sm">
            {{ errors.detail }}
          </span>
        </div>

        <div class="mt-6">
          <button
            type="submit"
            class="py-2 px-4 text-center bg-black rounded-md w-full text-white text-sm hover:bg-gray-700"
          >
            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import EmptyLayout from '../../layouts/EmptyLayout'
import User from '../../apis/User'
import PxLogo from '../../components/PxLogo'

export default {
  components: { PxLogo },
  data() {
    return {
      form: {
        email: 'team@livingroomcollege.org',
        password: '',
      },
      errors: [],
    }
  },

  created() {
    this.$emit(`update:layout`, EmptyLayout)
  },

  methods: {
    login() {
      User.login(this.form)
        .then(() => {
          this.$root.$emit('login', true)
          localStorage.setItem('auth', 'true')
          this.$router.push({ name: 'dashboard' })
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors[0]
          }
        })
    },
  },
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
    border-radius: .25rem;
    font-size: 1rem;
    line-height: 1.5;
    padding: .5rem .75rem;
}
</style>
