<template>
    <nav class="flex items-center justify-between flex-wrap bg-wildsand p-6">
        <div>
            <router-link :to="{ name: 'start' }">
                <px-logo class="w-48" />
            </router-link>
        </div>
        <div>
            <router-link
                :to="{ name: 'register' }"
                class="no-underline text-dustyGray hover:text-black ml-2"
            >
                REGISTER
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
    name: "PxHeader",
    data() {
        return {};
    },
    components: { PxLogo }
};
</script>
