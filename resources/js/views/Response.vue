<template>
    <div class="w-full">
        <div class="flex bg-white sm:px-40 md:px-0" style="height: 685px">
            <div
                class="flex items-center text-center lg:text-left px-12 md:px-40 lg:w-1/2"
            >
                <div v-if="transactionState === 'approved'">
                    <h2 class="text-3xl font-semibold md:text-4xl">
                        ¡Compra completada!
                    </h2>
                    <p
                        v-if="transactionState == 'approved'"
                        class="mt-2 text-sm text-gray-500 md:text-base"
                    >
                        Con esto has quedado matriculado para el curso.<br />
                        Enviaremos tu usuario y contraseña a tu mail para que
                        puedas acceder a la plataforma tan pronto se lance el
                        curso.

                        Si en la próxima hora no recibes el mail de bienvenida por favor
                        escríbenos a: team@livingroomcollege.org
                    </p>
                    <div class="flex justify-center lg:justify-start mt-6">
                        <a
                            class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800"
                            href="https://cursos.livingroomcollege.org/users/sign_in"
                            >Iniciar Sesi&oacute;n</a
                        >
                        <a
                            class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400"
                            href="https://cursos.livingroomcollege.org/collections"
                            >Otros Cursos</a
                        >
                    </div>
                </div>

                <div v-else-if="transactionState === 'pending'">
                    <h2 class="text-3xl font-semibold md:text-4xl">
                        Tu pago se encuentra pendiente.
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 md:text-base">
                        Apenas tu pago cambie a estado aprobado procederemos a
                        enviar tus credenciales de acceso a tu correo
                        electr&oacute;nico.
                    </p>
                </div>

                <div v-else>
                    <h2 class="text-3xl font-semibold md:text-4xl">
                        Ocurri&oacute; un problema con tu compra
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 md:text-base">
                        Por favor intent&aacute;lo de nuevo.
                    </p>
                </div>
            </div>
            <div
                class="hidden lg:block lg:w-1/2"
                style="clip-path: polygon(10% 0, 100% 0%, 100% 100%, 0 100%)"
            >
                <div
                    v-if="transactionState === 'approved'"
                    class="h-full object-fit"
                    style="background-image: url(/img/approved_banner_v2.jpg)"
                >
                    <div class="h-full bg-black opacity-25"></div>
                </div>

                <div
                    v-else-if="transactionState === 'pending'"
                    class="h-full object-fit"
                    style="background-image: url(/img/pending_banner.jpg)"
                >
                    <div class="h-full bg-black opacity-25"></div>
                </div>

                <div
                    v-else
                    class="h-full object-fit"
                    style="background-image: url(/img/rejected_banner.jpg)"
                >
                    <div class="h-full bg-black opacity-25"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from '../layouts/DefaultLayout';

export default {
    data() {
        return {
            query: this.$route.query,
            transactionState: '',
            estadoTx: '',
            student: {},
        };
    },

    created() {
        this.$emit(`update:layout`, DefaultLayout);

        this.transactionState = this.query.collection_status;

        if (this.transactionState === 'COMPLETED') {
            this.transactionState = 'approved';
        }
    },
};
</script>
