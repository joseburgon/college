<template>
  <div class="flex-col items-center text-center mt-32">
    <h1 class="text-black font-bold text-5xl uppercase">
      &#161;Algo sali&oacute; mal&#33;
    </h1>
    <a
      href="https://cursos.livingroomcollege.org"
      class="mt-5 text-lg text-black uppercase hover:underline"
    >
      Volver a la página de Inicio
    </a>
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
