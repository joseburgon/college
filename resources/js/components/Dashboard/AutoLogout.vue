<template>
    <div
        v-if="warningZone"
        class="modal z-50 fixed w-full h-full top-0 left-0 flex items-center justify-center"
    >
        <div
            class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
        ></div>

        <div
            class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto"
        >
            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50"
            >
                <svg
                    class="fill-current text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                >
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                    />
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">¿Sigues ah&iacute;?</p>
                    <div class="modal-close cursor-pointer z-50" @click="open = false">
                        <svg
                            class="fill-current text-black"
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                        >
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                            />
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <p>La sesi&oacute;n se cerrar&aacute; en 1 minuto.</p>
                <p>Mueve el mouse si deseas continuar logueado.</p>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from "../../apis/User";

export default {
    name: "AutoLogout",

    data: function () {
        return {
            events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],

            warningTimer: null,
            logoutTimer: null,
            warningZone: null
        }
    },

    mounted() {
        this.events.forEach(function (event) {
            window.addEventListener(event, this.resetTimers);
        }, this);

        this.setTimers();
    },

    destroyed() {
        this.events.forEach(function (event) {
            window.removeEventListener(event, this.resetTimers);
        }, this);

        this.resetTimers();
    },

    methods: {
        setTimers: function () {
            this.warningTimer = setTimeout(this.warningMessage, 14 * 60 * 1000);
            this.logoutTimer = setTimeout(this.logoutUser, 15 * 60 * 1000);

            this.warningZone = false;
        },

        warningMessage: function () {
            this.warningZone = true;
        },

        logoutUser: function () {
            User.logout().then(() => {
                localStorage.removeItem('auth');
                this.isLoggedIn = false;
                this.$router.push({ name: 'Login' });
            })
        },

        resetTimers: function () {
            clearTimeout(this.warningTimer);
            clearTimeout(this.logoutTimer);

            this.setTimers();
        }
    }
}
</script>
