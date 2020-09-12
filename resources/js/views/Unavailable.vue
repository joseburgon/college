<template>
  <div class="w-full">
    <div class="flex bg-white sm:px-40 md:px-0" style="height: 685px">
      <div
        class="flex items-center text-center lg:text-left px-12 md:px-40 lg:w-1/2"
      >
        <div>
          <h2 class="text-3xl font-semibold md:text-4xl">
            Este curso no se encuentra disponible.
          </h2>
          <p class="mt-2 text-sm text-gray-500 md:text-base">
            El curso al que intentas matricularte no se encuentra disponible en
            este momento.
          </p>
        </div>
      </div>
      <div
        class="hidden lg:block lg:w-1/2"
        style="clip-path: polygon(10% 0, 100% 0%, 100% 100%, 0 100%)"
      >
        <div
          class="h-full object-fit"
          style="background-image: url(/img/unavailable_banner.jpg)"
        >
          <div class="h-full bg-black opacity-25"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DefaultLayout from '../layouts/DefaultLayout'

export default {
  created() {
    this.$emit(`update:layout`, DefaultLayout)
  },
}
</script>
