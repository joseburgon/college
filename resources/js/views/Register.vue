<template>
  <div class="py-4 md:py-12 mx-8 md:mx-20 lg:mx-40">
    <div class="flex-col">
      <div class="flex flex-wrap md:6">
        <div class="flex w-full md:w-1/2">
          <FormulateForm
            class="w-full max-w-lg pr-2 md:pr-8"
            v-model="formValues"
            id="registerForm"
            action="#"
            method="GET"
            v-show="!registered"
          >
            <h2 class="font-bold text-black text-xl md:text-2xl mt-2 mb-4 md:mb-8">MATR&Iacute;CULA</h2>

            <FormulateInput name="course" type="hidden" v-model="course" />

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
                label="Identificación"
                placeholder="Tu documento de identidad"
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
                label="Celular"
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
            <div class="flex-col mt-10">
              <FormulateInput
                type="button"
                name="Matricularme"
                @click="addStudent"
              />
            </div>
          </FormulateForm>
          <div class="payment-option w-full mt-6" v-show="registered">
            <ul class="flex border-b">
              <li class="-mb-px mr-1">
                <a
                  class="bg-white inline-block rounded-t py-2 px-4 text-mercadopagoBlue font-semibold cursor-pointer"
                  :class="{'border-r border-l border-t': openTab == 1, 'hover:text-blue-800': openTab !== 1}"
                  @click="toggleTabs(1)"
                >MercadoPago</a>
              </li>
              <li class="-mb-px mr-1">
                <a
                  class="bg-white inline-block rounded-t py-2 px-4 text-paypalBlue font-semibold cursor-pointer"
                  :class="{'border-r border-l border-t': openTab == 2, 'hover:text-blue-800': openTab !== 2}"
                  @click="toggleTabs(2)"
                >PayPal</a>
              </li>
            </ul>
            <div :class="{'hidden': openTab !== 1, 'block': openTab === 1}">
              <div class="p-8 text-center">
                <button
                  class="w-auto md:w-64 bg-gray-100 hover:bg-blue-100 border border-gray-300 py-2 px-4 rounded"
                  v-if="registered"
                  @click="goToMercadoPago"
                >
                  <img
                    :src="'/img/mercadopago_logo.svg'"
                    class="w-40 inline-block py-1 px-8"
                    alt="MercadoPago"
                  />
                </button>
                <p
                  class="font-hairline text-black text-xs mt-4"
                >PSE &bull; BANCA EN LÍNEA<br>TARJETAS DE CRÉDITO<br>EFECTY &bull; BALOTO</p>
              </div>
            </div>
            <div :class="{'hidden': openTab !== 2, 'block': openTab === 2}">
              <script
                type="application/javascript"
                src="https://www.paypal.com/sdk/js?client-id=ARUO9QDHYXWYbyJgUOF_FTEGXtKTtifep5xklBxSbeWYnI5MZdnKshKztdlRASZkLU_AQdrMrqi3e6lF"
              ></script>
              <p
                class="font-hairline text-center text-black text-xs mt-4"
              >MEDIO RECOMENDADO SI VAS A DONAR CON UNA TARJETA DE CR&Eacute;DITO INTERNACIONAL</p>
              <div id="paypal-button-container" class="p-8"></div>
            </div>
          </div>
        </div>
        <div
          class="flex flex-col flex-wrap bg-gray-100 rounded w-full md:w-1/2 mt-6 md:mt-0 sm:mt-6"
        >
          <div class="flex flex-col flex-wrap py-4 px-8" v-if="course.id">
            <div
              class="uppercase tracking-wide text-sm text-dustyGray font-bold my-4"
            >{{ course.name }}</div>
            <a
              href="#"
              class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline"
            >{{ course.tagline.toUpperCase() }}</a>
            <p class="mt-2 font-thin text-black break-words">{{ course.description }}</p>
            <hr class="border-gray-400 my-4 lg:my-8" />
            <p class="font-hairline text-dustyGray text-xs">DONACI&Oacute;N</p>
            <h3 class="text-lg lg:text-xl font-bold my-2">
              {{
              "$ " +
              new Intl.NumberFormat().format(
              course.price
              ) + " COP "
              }}
              <span
                class="text-gray-500"
              >{{ "| $ " + course.price_usd + " USD"}}</span>
            </h3>
            <p class="font-hairline text-dustyGray text-xs">MEDIOS DE PAGO</p>
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
      course: {},
      student: {},
      referenceCode: "",
      mercadoPagoUrl: "",
      registered: false,
      openTab: 1,
    };
  },

  components: { PxPaymentMethods },

  methods: {
    addStudent() {
      let data = this.formValues;

      axios
        .post("api/students", data)
        .then((res) => {
          console.log(res.data);
          this.student = res.data;
          this.getReferenceCode(res.data.id);
          this.registered = true;
        })
        .catch((e) => {
          console.log(e);
        });
    },

    getReferenceCode(student) {
      axios
        .post("api/reference", {
          course: this.query.course,
          student: student,
        })
        .then((res) => {
          console.log(res.data);
          this.referenceCode = res.data.referenceCode;
          this.mercadoPagoUrl = res.data.init_point;
          this.createPaypal(this.student, this.course, res.data.referenceId);
        })
        .catch((e) => {
          console.log(e);
        });
    },

    goToMercadoPago() {
      window.location.replace(this.mercadoPagoUrl);
    },

    createPaypal(student, course, referenceId) {
      window.paypal
        .Buttons({
          createOrder: function (data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
              payer: {
                name: {
                  given_name: student.name,
                  surname: student.last_name,
                },
                email_address: student.email,
              },
              purchase_units: [
                {
                  reference_id: referenceId,
                  description: course.name,
                  amount: {
                    value: course.price_usd,
                    currency_code: "USD",
                  },
                },
              ],
            });
          },
          onApprove: function (data, actions) {
            // This function captures the funds from the transaction.

            actions.order.capture().then(function (details) {
              // This function shows a transaction success message to your buyer.
              console.log(details);

              let transaction = {
                type: "PAYPAL",
                paypal_order: details.id,
                status: details.status,
                external_reference: details.purchase_units[0].reference_id,
                description: details.purchase_units[0].description,
                transaction_amount: details.purchase_units[0].amount.value,
                currency_id: details.purchase_units[0].amount.currency_code,
              };

              axios
                .post("api/transactions/paypal", transaction)
                .then((res) => {
                  window.location.replace(
                    `/response?collection_status=${transaction.status}`
                  );
                })
                .catch((e) => {
                  console.log(e);
                });
            });
          },
        })
        .render("#paypal-button-container");
      //This function displays Smart Payment Buttons on your web page.
    },

    toggleTabs(tabNumber) {
      this.openTab = tabNumber;
    },
  },

  created() {
    if (!this.query.course) {
      this.query.course = 2;
    }

    axios
      .get(`api/courses/${this.query.course}`)
      .then((res) => {
        this.course = res.data;
      })
      .catch((e) => {
        window.location.replace("/error");
      });
  },
};
</script>
