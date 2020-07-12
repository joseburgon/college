<template>
    <main>
        <px-header></px-header>
        <router-view class="p-4 md:p-12 mx-2 md:mx-20 xl:mx-48" />
    </main>
</template>

<script>
import PxHeader from "./PxHeader";

export default {
    name: "App",
    components: {
        PxHeader
    }
};
</script>

<style></style>
