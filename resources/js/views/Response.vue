<template>
    <div class="flex justify-center mt-16">
        <div class="max-w-sm rounded overflow-hidden shadow-lg py-8">
            <div class="flex justify-center mt-8">
                <px-thumbs-up class="w-12" v-if="transactionState == 4" />
                <px-thumbs-down class="w-12" v-else />
            </div>
            <div class="flex flex-col justify-center items-center px-6 py-4">
                <p class="font-light text-sm">Resultado del pago:</p>
                <p class="font-bold text-2xl mb-2">
                    {{ estadoTx }}
                </p>
                <p
                    class="text-gray-700 text-base text-center"
                    v-if="transactionState == 4"
                >
                    Con esto has quedado matriculado para el curso:
                    <span class="tx-wildsand font-semibold">
                        {{ query.description }}
                    </span>
                    Enviaremos tu usuario y contraseña a tu mail ({{
                        query.buyerEmail
                    }}) para que puedas acceder a la plataforma tan pronto se
                    lance el curso.
                </p>
                <p class="text-gray-700 text-base text-center" v-else>
                    {{ query.message }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import PxThumbsUp from "../components/PxThumbsUp";
import PxThumbsDown from "../components/PxThumbsDown";
export default {
    data() {
        return {
            query: this.$route.query,
            transactionState: "",
            estadoTx: ""
        };
    },
    components: { PxThumbsUp, PxThumbsDown },
    created() {
        this.transactionState = this.query.transactionState;

        switch (parseInt(this.transactionState)) {
            case 4:
                this.estadoTx = "Transacción Aprobada";
                break;
            case 6:
                this.estadoTx = "Transacción Rechazada";
                break;
            case 7:
                this.estadoTx = "Transacción Pendiente";
                break;
            case 104:
                this.estadoTx = "Error";
                break;
            default:
                this.estadoTx = this.query.message;
        }
        console.log(this.estadoTx);
    }
};
</script>
