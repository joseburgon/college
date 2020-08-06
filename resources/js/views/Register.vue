<template>
    <div class="flex-col">
        <div class="flex flex-wrap md:6 lg:px-20">
            <div class="flex w-full md:w-1/2">
                <FormulateForm
                    class="w-full max-w-lg px-2 md:px-8"
                    v-model="formValues"
                    id="registerForm"
                    action="http://checkout.livingroomcollege.org/response"
                    method="GET"
                    
                >
                    <h2
                        class="font-normal text-black text-2xl md:text-4xl mb-4 md:mb-8"
                    >
                        Registrarme
                    </h2>

                    <FormulateInput
                        name="extra1"
                        type="hidden"
                        v-model="cedula"
                    />
                    <div class="grid grid-flow-col grid-cols-2 gap-4">
                        <FormulateInput
                            name="name"
                            type="text"
                            label="Tu nombre"
                            placeholder="Tu primer nombre"
                            v-model="firstName"
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
                            v-model="lastName"
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
                            v-model="cedula"
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
                    <div class="div mt-10">
                        <FormulateInput
                            type="button"
                            name="Registrarme"
                            @click="addStudent"
                            :disabled="registered"
                        />
                        <script v-if="registered"
                            src="https://www.mercadopago.com.co/integrations/v1/web-payment-checkout.js"
                            type="application/javascript"
                            :data-preference-id="referenceCode"
                        ></script>
                        <!-- <pre class="code px-2" v-text="formValues" /> -->
                    </div>
                </FormulateForm>
            </div>
            <div
                class="bg-gray-100 rounded w-full md:w-1/2 mt-6 md:mt-0 sm:mt-6"
            >
                <div class="md:flex py-4 px-8">
                    <div class="flex-col flex-wrap mt-4 md:mt-0">
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
                        <p class="mt-2 font-thin text-black">
                            {{ course.description }}
                        </p>
                        <hr class="border-gray-400 my-4 lg:my-8" />
                        <h3 class="text-2xl font-bold mb-4">
                            {{
                                "$ " +
                                    new Intl.NumberFormat().format(course.price)
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
import md5 from "crypto-js/md5";
import PxPaymentMethods from "../components/PxPaymentMethods";

export default {
    data() {
        return {
            query: this.$route.query,
            formValues: {},
            valid: {},
            Students: [],
            course: "",
            referenceCode: "",
            cedula: "",
            firstName: "",
            lastName: "",
            registered: false,
        };
    },
    components: { PxPaymentMethods },
    computed: {
        fullName: function() {
            return this.firstName + " " + this.lastName;
        }
    },
    methods: {
        addStudent() {
            let data = this.formValues;

            axios
                .post("api/students", data)
                .then(res => {
                    console.log(`Response: ${res.data.extra1}`);
                    console.log(`Response: ${res.data.message}`);
                    this.registered = true;
                    //document.forms["registerForm"].submit();
                })
                .catch(e => {
                    console.log(e);
                });
        },
        setReferenceCode(reference) {
            this.referenceCode = reference.code;
        },
        setSignature() {
            let data = this.formValues;
            data.signature = md5(
                `${this.formValues.ApiKey}~${this.formValues.merchantId}~${this.formValues.referenceCode}~${this.formValues.amount}~${this.formValues.currency}`
            ).toString();
            console.log("Signature created!");
        }
    },
    created() {
        axios
            .get(`api/courses/${this.query.course}`)
            .then(res => {
                this.course = res.data;
            })
            .catch(e => {
                window.location.replace("/error");
            });
    },
    mounted() {
        axios
            .post("api/reference", {
                course: this.query.course
            })
            .then(res => {
                this.setReferenceCode(res.data);
                this.setSignature();
            })
            .catch(e => {
                console.log(e);
            });
    }
};
</script>
