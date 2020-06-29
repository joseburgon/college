<template>
    <div class="flex">
        <FormulateForm
            class="w-full max-w-lg px-6"
            v-model="formValues"
            id="registerForm"
            action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"
            method="post"
            @submit="submitHandler"
        >
            <h2 class="font-normal text-black text-5xl text-center mb-8">
                Registrarme
            </h2>

            <FormulateInput
                type="hidden"
                name="ApiKey"
                value="4Vj8eK4rloUd272L48hsrarnUA"
            />
            <FormulateInput name="merchantId" type="hidden" value="508029" />
            <FormulateInput name="referenceCode" type="hidden" value="" />
            <FormulateInput name="amount" type="hidden" value="20000" />
            <FormulateInput name="accountId" type="hidden" value="512321" />
            <FormulateInput
                name="description"
                type="hidden"
                value="Curso de Finanzas"
            />
            <FormulateInput name="extra1" type="hidden" value="" />
            <FormulateInput name="currency" type="hidden" value="COP" />
            <FormulateInput name="signature" type="hidden" value="" />
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

            <div class="flex-col justify-center pb-6">
                <FormulateInput
                    name="buyerFullName"
                    type="text"
                    label="Tu nombre completo"
                    placeholder="Tu nombre"
                    validation="required"
                    element-class="flex-grow"
                    label-class="text-xs font-bold"
                />
                <FormulateInput
                    name="buyerEmail"
                    type="email"
                    label="Correo electrónico"
                    placeholder="Email"
                    validation="required|email"
                    element-class="flex-grow"
                    label-class="text-xs font-bold"
                />
            </div>
            <div class="grid grid-flow-col grid-cols-2 gap-4">
                <FormulateInput
                    name="id"
                    type="text"
                    label="Número de cédula"
                    placeholder="Tu cédula"
                    validation="required"
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
                    outer-class="formulate-input flex-grow pl-2"
                    label-class="text-xs font-bold"
                />
            </div>
            <div class="flex-col justify-center mb-6">
                <FormulateInput
                    name="city"
                    type="text"
                    label="Ciudad de residencia"
                    placeholder="Tu ciudad"
                    validation="required"
                    element-class="flex-grow"
                    label-class="text-xs font-bold"
                />
            </div>
            <FormulateInput type="submit" name="Registrarme y Pagar" />
            <pre class="code px-2" v-text="formValues" />
        </FormulateForm>
    </div>
</template>

<script>
import md5 from "crypto-js/md5";
import "../../sass/form/form.scss";

export default {
    data() {
        return {
            formValues: {},
            valid: {},
            Students: [],
            cedula: ""
        };
    },
    methods: {
        addStudent() {
            let data = this.formValues;
            data.extra1 = data.id;

            axios
                .post("api/students", {
                    data: data
                })
                .then(res => {
                    console.log(`Response: ${res.message}`);
                })
                .catch(e => {
                    console.log(e);
                });
        },
        submitHandler() {
            this.addStudent();
            //document.forms["registerForm"].submit();
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
