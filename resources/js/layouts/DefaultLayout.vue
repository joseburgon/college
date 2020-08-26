<template>
    <div>
        <px-header />
        <slot />
    </div>
</template>

<script>
import PxHeader from '../components/PxHeader';

export default {
    components: { PxHeader },
};
</script>
