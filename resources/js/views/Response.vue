<template>
    <div class="w-full">
        <div class="flex bg-white pl-40" style="height:700px;">
            <div
                class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2"
            >
                <div>
                    <h2 class="text-3xl font-semibold md:text-4xl">
                        ¡Compra completada!
                    </h2>
                    <p
                        class="mt-2 text-sm text-gray-500 md:text-base"
                        v-if="transactionState == 'approved'"
                    >
                        Con esto has quedado matriculado para el curso:
                        <span class="text-black font-semibold">
                            De la carencia a la abundancia.
                        </span>
                        Enviaremos tu usuario y contraseña a tu mail para que
                        puedas acceder a la plataforma tan pronto se lance el
                        curso.
                    </p>
                    <div class="flex justify-center lg:justify-start mt-6">
                        <a
                            class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800"
                            href="https://cursos.livingroomcollege.org/users/sign_in"
                            >Iniciar Sesi&oacuten</a
                        >
                        <a
                            class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400"
                            href="https://cursos.livingroomcollege.org/collections"
                            >Otros Cursos</a
                        >
                    </div>
                </div>
            </div>
            <div
                class="hidden lg:block lg:w-1/2"
                style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)"
            >
                <div
                    class="h-full object-none"
                    style="background-image: url(/img/approved_banner.jpg)"
                >
                    <div class="h-full bg-black opacity-25"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../api";
import PxThumbsUp from "../components/PxThumbsUp";
import PxThumbsDown from "../components/PxThumbsDown";
export default {
    data() {
        return {
            query: this.$route.query,
            transactionState: "",
            estadoTx: "",
            student: {}
        };
    },
    components: { PxThumbsUp, PxThumbsDown },

    created() {
        this.transactionState = this.query.collection_status;
    }
};
</script>
