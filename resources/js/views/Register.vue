<template>
    <div class="py-4 md:py-12 mx-8 md:mx-40">
        <div class="flex-col">
            <div class="flex flex-wrap md:6">
                <div class="flex w-full md:w-1/2">
                    <FormulateForm
                        class="w-full max-w-lg pr-2 md:pr-8"
                        v-model="formValues"
                        id="registerForm"
                        action="#"
                        method="GET"
                    >
                        <h2
                            class="font-normal text-black text-2xl md:text-4xl mb-4 md:mb-8"
                        >
                            Matricularme
                        </h2>

                        <FormulateInput
                            name="course"
                            type="hidden"
                            v-model="course"
                        />

                        <div class="grid grid-flow-col grid-cols-2 gap-4">
                            <FormulateInput
                                name="name"
                                type="text"
                                label="Tu nombre"
                                placeholder="Tu primer nombre"
                                validation="required"
                                :validation-messages="{
                                    required: 'Nombre es requerido'
                                }"
                                outer-class="formulate-input flex-grow pr-2"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                            <FormulateInput
                                name="last_name"
                                type="text"
                                label="Tu apellido"
                                placeholder="Tu apellido"
                                validation="required"
                                :validation-messages="{
                                    required: 'Apellido es requerido'
                                }"
                                outer-class="formulate-input flex-grow pl-2"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>

                        <div class="flex-col justify-center pb-6">
                            <FormulateInput
                                name="buyerEmail"
                                type="email"
                                label="Correo electrónico"
                                placeholder="Email"
                                validation="required|email"
                                :validation-messages="{
                                    required: 'Tu correo es requerido',
                                    email: 'Tu correo debe ser un email válido'
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>

                        <div class="grid grid-flow-col grid-cols-2 gap-4">
                            <FormulateInput
                                name="identification"
                                type="text"
                                label="Número de cédula"
                                placeholder="Tu cédula"
                                validation="required"
                                :validation-messages="{
                                    required: 'Cedula es requerida'
                                }"
                                element-class="flex justify-center"
                                outer-class="formulate-input flex-grow pr-2"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                            <FormulateInput
                                name="mobilePhone"
                                type="text"
                                label="Número de teléfono"
                                placeholder="Tu teléfono"
                                validation="required|number"
                                :validation-messages="{
                                    required: 'Tu teléfono es requerido',
                                    number: 'Tu teléfono debe ser un número'
                                }"
                                outer-class="formulate-input flex-grow pl-2"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>
                        <div class="flex-col justify-center mb-6">
                            <FormulateInput
                                name="billingCity"
                                type="text"
                                label="Ciudad de residencia"
                                placeholder="Tu ciudad"
                                validation="required"
                                :validation-messages="{
                                    required: 'Ciudad es requerida'
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>
                        <div class="flex mt-10">
                            <FormulateInput
                                type="button"
                                name="Pagar"
                                @click="addStudent"
                                :disabled="registered"
                            />
                            <!-- <pre class="code px-2" v-text="formValues" /> -->
                        </div>
                    </FormulateForm>
                </div>
                <div
                    class="flex flex-col flex-wrap bg-gray-100 rounded w-full md:w-1/2 mt-6 md:mt-0 sm:mt-6"
                >
                    <div class="flex flex-col flex-wrap py-4 px-8">
                            <div
                                class="uppercase tracking-wide text-sm text-dustyGray font-bold my-4"
                            >
                                {{ course.name }}
                            </div>
                            <a
                                href="#"
                                class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline"
                                >{{ course.tagline }}</a
                            >
                            <p class="mt-2 font-thin text-black break-words">
                                {{ course.description }}
                            </p>
                            <hr class="border-gray-400 my-4 lg:my-8" />
                            <h3 class="text-2xl font-bold mb-4">
                                {{
                                    "$ " +
                                        new Intl.NumberFormat().format(
                                            course.price
                                        )
                                }}
                            </h3>
                            <p class="font-hairline text-dustyGray text-xs">
                                MEDIOS DE PAGO
                            </p>
                            <px-payment-methods />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PxPaymentMethods from "../components/PxPaymentMethods";

export default {
    data() {
        return {
            query: this.$route.query,
            formValues: {},
            valid: {},
            course: "",
            referenceCode: "",
            mercadoPagoUrl: "",
            registered: false
        };
    },

    components: { PxPaymentMethods },

    methods: {
        addStudent() {
            let data = this.formValues;

            axios
                .post("api/students", data)
                .then(res => {
                    this.getReferenceCode(res.data.id);
                    //this.registered = true;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        getReferenceCode(student) {
            axios
                .post("api/reference", {
                    course: this.query.course,
                    student: student
                })
                .then(res => {
                    console.log(res.data);
                    this.referenceCode = res.data.referenceCode;
                    this.mercadoPagoUrl = res.data.init_point;
                    this.goToMercadoPago();
                })
                .catch(e => {
                    console.log(e);
                });
        },

        goToMercadoPago() {
            window.location.replace(this.mercadoPagoUrl);
        }
    },

    created() {
        if (!this.query.course) {
            this.query.course = 2;
        }

        axios
            .get(`api/courses/${this.query.course}`)
            .then(res => {
                this.course = res.data;
            })
            .catch(e => {
                window.location.replace("/error");
            });
    },

    mounted() {}
};
</script>
