<template>
    <section>
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <div class="flex justify-center mt-8">
                <px-thumbs-up class="w-12" />
            </div>
            <div class="flex flex-col justify-center items-center px-6 py-4">
                <p class="font-light text-sm">Hey Juan Carlos</p>
                <p class="font-bold text-2xl mb-2">
                    ¡Transacción Aprobada!
                </p>
                <p class="text-gray-700 text-base text-center">
                    Con esto has quedado matriculado para el:
                    <span class="tx-wildsand font-semibold">
                        Curso de Finanzas.
                    </span>
                    Enviaremos tu usuario y contraseña a tu mail para que puedas
                    acceder a la plataforma tan pronto se lance el curso.
                </p>
            </div>
            <div class="flex justify-center px-6 py-4">
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
                    >#photography</span
                >
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
                    >#travel</span
                >
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"
                    >#winter</span
                >
            </div>
        </div>
    </section>
</template>

<script>
import PxThumbsUp from "../components/PxThumbsUp";
export default {
    data() {
        return {
            query: this.$route.query,
            Students: []
        };
    },
    components: { PxThumbsUp }
};
</script>
