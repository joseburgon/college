<template>
  <div
    :class="
      sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'
    "
    class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0"
  >
    <div class="flex items-center justify-center mt-8">
      <div class="flex items-center">
        <px-logo class="fill-current text-white w-40"></px-logo>
      </div>
    </div>

    <nav class="mt-10 fill-current text-white">
      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[$route.name === 'Dashboard' ? activeClass : inactiveClass]"
        to="/dashboard"
      >
        <svg
          class="h-5 w-5"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
            fill="currentColor"
          />
          <path
            d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
            fill="currentColor"
          />
        </svg>

        <span class="mx-4">Dashboard</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[
          $route.name.includes('transactions') ? activeClass : inactiveClass,
        ]"
        :to="{ name: 'transactions' }"
      >
        <svg
          class="h-5 w-5"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z"
            fill="currentColor"
          />
          <path
            d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z"
            fill="currentColor"
          />
          <path
            d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z"
            fill="currentColor"
          />
          <path
            d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z"
            fill="currentColor"
          />
        </svg>

        <span class="mx-4">Transacciones</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[
          $route.name.includes('references') ? activeClass : inactiveClass,
        ]"
        :to="{ name: 'references' }"
      >
        <svg
          class="h-5 w-5"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M7 3C6.44772 3 6 3.44772 6 4C6 4.55228 6.44772 5 7 5H13C13.5523 5 14 4.55228 14 4C14 3.44772 13.5523 3 13 3H7Z"
            fill="currentColor"
          />
          <path
            d="M4 7C4 6.44772 4.44772 6 5 6H15C15.5523 6 16 6.44772 16 7C16 7.55228 15.5523 8 15 8H5C4.44772 8 4 7.55228 4 7Z"
            fill="currentColor"
          />
          <path
            d="M2 11C2 9.89543 2.89543 9 4 9H16C17.1046 9 18 9.89543 18 11V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V11Z"
            fill="currentColor"
          />
        </svg>

        <span class="mx-4">Referencias</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[$route.name === 'students' ? activeClass : inactiveClass]"
        :to="{ name: 'students' }"
      >
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
          ></path>
          <path
            fill-rule="evenodd"
            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
            clip-rule="evenodd"
          ></path>
        </svg>

        <span class="mx-4">Estudiantes</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[
          $route.name === 'students-create' ? activeClass : inactiveClass,
        ]"
        :to="{ name: 'students-create' }"
      >
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"
          />
        </svg>

        <span class="mx-4">Crear Estudiante</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[$route.name.includes('exports') ? activeClass : inactiveClass]"
        :to="{ name: 'exports' }"
      >
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path
            fill-rule="evenodd"
            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
            clip-rule="evenodd"
          />
        </svg>

        <span class="mx-4">Exportar</span>
      </router-link>

      <router-link
        class="flex items-center mt-4 py-2 px-6 block border-l-4"
        :class="[$route.name.includes('imports') ? activeClass : inactiveClass]"
        :to="{ name: 'imports' }"
      >
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path
            fill-rule="evenodd"
            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
            clip-rule="evenodd"
          />
        </svg>

        <span class="mx-4">Importar</span>
      </router-link>
    </nav>
  </div>
</template>

<script>
import PxLogo from '../../components/PxLogo'

export default {
  components: { PxLogo },
  props: {
    sidebarOpen: Boolean,
  },
  data() {
    return {
      activeClass: 'bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100',
      inactiveClass:
        'border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100',
    }
  },
}
</script>

<style></style>
