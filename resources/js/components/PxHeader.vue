<template>
  <nav class="flex items-center justify-between flex-wrap bg-wildsand">
    <div class="py-4 mx-8 md:mx40 lg:mx-40">
      <a href="https://cursos.livingroomcollege.org/">
        <px-logo class="w-40" />
      </a>
    </div>
  </nav>
</template>

<script>
import PxLogo from "./PxLogo";

export default {
  name: "PxHeader",
  data() {
    return {};
  },
  components: { PxLogo },
};
</script>
