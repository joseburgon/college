<template>
    <div class="flex h-screen bg-gray-200 font-roboto">
        <!-- Backdrop -->
        <div
            :class="sidebarOpen ? 'block' : 'hidden'"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"
            @click="closeSidebar"
        ></div>
        <!-- End Backdrop -->

        <sidebar :sidebar-open="sidebarOpen"/>

        <div class="flex-1 flex flex-col overflow-hidden">
            <nav-header class="my-header" @burgerClicked="toggleSidebar"/>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">

                <auto-logout></auto-logout>

                <div class="container mx-auto px-6 py-8">
                    <slot/>
                </div>
                <notifications
                    position="bottom right"
                    group="alerts"
                    class="mb-4 mr-4"
                />
            </main>
        </div>
    </div>
</template>

<script>
import NavHeader from '../components/Dashboard/NavHeader'
import Sidebar from '../components/Dashboard/Sidebar'
import AutoLogout from '../components/Dashboard/AutoLogout'

export default {
    components: {Sidebar, NavHeader, AutoLogout},

    data() {
        return {
            sidebarOpen: true,
            openSidebar: '',
        }
    },
    methods: {
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen
        },

        closeSidebar() {
            this.sidebarOpen = false
        },
    },
}
</script>

<style></style>
