<template>
    <main>
        <px-header></px-header>
        <router-view class="py-12 flex justify-center" />
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
