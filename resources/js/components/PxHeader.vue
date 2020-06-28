<template>
    <nav class="flex items-center justify-between flex-wrap bg-wildsand p-6">
        <div>
            <router-link :to="{ name: 'registro' }">
                <px-logo class="w-48" />
            </router-link>
        </div>
        <div>
            <router-link
                :to="{ name: 'registro' }"
                class="no-underline text-dustyGray hover:text-black ml-2"
            >
                REGISTRO
            </router-link>
            <router-link
                :to="{ name: 'confirmation' }"
                class="no-underline text-dustyGray hover:text-black ml-2"
            >
                CONFIRMATION
            </router-link>
            <router-link
                :to="{ name: 'response' }"
                class="no-underline text-dustyGray hover:text-black ml-2"
            >
                RESPONSE
            </router-link>
        </div>
    </nav>
</template>

<script>
import PxLogo from "./PxLogo";

export default {
    data() {
        return {};
    },
    components: { PxLogo }
};
</script>
