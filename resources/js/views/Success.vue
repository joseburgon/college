<template>
    <div class="w-full">
        <div class="flex bg-white sm:px-40 md:px-0" style="height: 685px">
            <div
                class="flex items-center text-center lg:text-left px-12 md:px-40 lg:w-1/2"
            >
                <div>
                    <h2 class="text-3xl font-semibold md:text-4xl">
                        ¡Compra completada!
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 md:text-base">
                        Con esto has quedado matriculado para el curso.
                        <br />
                        Enviaremos tu usuario y contraseña a tu mail para que
                        puedas acceder a la plataforma tan pronto se lance el
                        curso.
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
            </div>
            <div
                class="hidden lg:block lg:w-1/2"
                style="clip-path: polygon(10% 0, 100% 0%, 100% 100%, 0 100%)"
            >
                <div
                    class="h-full object-fit"
                    style="background-image: url(/img/approved_banner.jpg)"
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
    created() {
        this.$emit(`update:layout`, DefaultLayout);
    },
};
</script>
