<template>
  <p>{{ query }}</p>
</template>

<script>
export default {
  data() {
    return {
      query: this.$route.query,
      Students: [],
    };
  },
};
</script>
