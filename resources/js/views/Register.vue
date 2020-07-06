<template>
    <div class="flex-col">
        <div class="flex flex-wrap md:6 lg:px-20">
            <div class="flex w-full md:w-1/2">
                <FormulateForm
                    class="w-full max-w-lg px-2 md:px-8"
                    v-model="formValues"
                    id="registerForm"
                    action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"
                    method="post"
                    @submit="addStudent"
                >
                    <h2
                        class="font-normal text-black text-2xl md:text-4xl mb-4 md:mb-8"
                    >
                        Registrarme
                    </h2>
                    <FormulateInput
                        type="hidden"
                        name="ApiKey"
                        value="4Vj8eK4rloUd272L48hsrarnUA"
                    />
                    <FormulateInput
                        name="merchantId"
                        type="hidden"
                        value="508029"
                    />
                    <FormulateInput
                        name="referenceCode"
                        type="hidden"
                        value=""
                    />
                    <FormulateInput name="amount" type="hidden" value="20000" />
                    <FormulateInput
                        name="accountId"
                        type="hidden"
                        value="512321"
                    />
                    <FormulateInput
                        name="description"
                        type="hidden"
                        value="Curso de Finanzas"
                    />
                    <FormulateInput name="extra1" type="hidden" value="" />
                    <FormulateInput name="extra2" type="hidden" value="2" />
                    <FormulateInput name="currency" type="hidden" value="COP" />
                    <FormulateInput name="signature" type="hidden" value="" />
                    <FormulateInput
                        name="buyerFullName"
                        type="hidden"
                        value=""
                    />
                    <FormulateInput name="test" type="hidden" value="1" />
                    <FormulateInput
                        name="responseUrl"
                        type="hidden"
                        value="http://college.test/response"
                    />
                    <FormulateInput
                        name="confirmationUrl"
                        type="hidden"
                        value="http://college.test/api/transactions"
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
                        />
                    </div>
                    <div class="div mt-10">
                        <FormulateInput
                            type="submit"
                            name="Registrarme y Pagar"
                        />
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
                            Curso de finanzas
                        </div>
                        <a
                            href="#"
                            class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline"
                            >De la carencia a la abundancia</a
                        >
                        <p class="mt-2 font-thin text-black">
                            Getting a new business off the ground is a lot of
                            hard work. Here are five ideas you can use to find
                            your first customers.
                        </p>
                        <hr class="border-gray-400 my-4 lg:my-8" />
                        <h3 class="text-2xl font-bold mb-4">$80.000 COP</h3>
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
            formValues: {},
            valid: {},
            Students: [],
            cedula: ""
        };
    },
    components: { PxPaymentMethods },
    methods: {
        addStudent() {
            this.formValues.extra1 = this.formValues.identification;
            this.formValues.buyerFullName =
                this.formValues.name + " " + this.formValues.last_name;
            let data = this.formValues;

            axios
                .post("api/students", data)
                .then(res => {
                    console.log(`Response: ${res.message}`);
                    document.forms["registerForm"].submit();
                })
                .catch(e => {
                    console.log(e);
                });
        },
        setReferenceCode(reference) {
            this.formValues.referenceCode = reference.code;
        },
        setSignature() {
            let data = this.formValues;
            data.signature = md5(
                `${this.formValues.ApiKey}~${this.formValues.merchantId}~${this.formValues.referenceCode}~${this.formValues.amount}~${this.formValues.currency}`
            ).toString();
            console.log("Signature created!");
        }
    },
    mounted() {
        axios
            .post("api/reference", {
                prefix: "LvrCollege_Test"
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
