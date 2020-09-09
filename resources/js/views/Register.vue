<template>
  <div class="py-4 md:py-12 mx-8 md:mx-20 lg:mx-40">
    <div class="flex-col">
      <div class="flex flex-wrap md:6">
        <div class="flex w-full md:w-1/2">
          <FormulateForm
            v-show="!registered"
            id="registerForm"
            v-model="formValues"
            class="w-full max-w-lg pr-2 md:pr-8"
            action="#"
            method="GET"
          >
            <h2
              class="font-bold text-black text-xl md:text-2xl mt-2 mb-4 md:mb-8"
            >
              MATR&Iacute;CULA
            </h2>

            <FormulateInput v-model="course" name="course" type="hidden" />

            <div class="grid grid-flow-col grid-cols-2 gap-4">
              <FormulateInput
                name="name"
                type="text"
                label="Tu nombre"
                placeholder="Tu primer nombre"
                validation="required"
                :validation-messages="{
                  required: 'Nombre es requerido',
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
                  required: 'Apellido es requerido',
                }"
                outer-class="formulate-input flex-grow pl-2"
                label-class="text-xs font-bold"
                :disabled="registered"
              />
            </div>

            <div class="flex-col justify-center pb-6">
              <FormulateInput
                name="email"
                type="email"
                label="Correo electrónico"
                placeholder="Email"
                validation="required|email"
                :validation-messages="{
                  required: 'Tu correo es requerido',
                  email: 'Tu correo debe ser un email válido',
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
                  required: 'Cedula es requerida',
                }"
                element-class="flex justify-center"
                outer-class="formulate-input flex-grow pr-2"
                label-class="text-xs font-bold"
                :disabled="registered"
              />
              <FormulateInput
                name="phone"
                type="text"
                label="Celular"
                placeholder="Tu teléfono"
                validation="required|number"
                :validation-messages="{
                  required: 'Tu teléfono es requerido',
                  number: 'Tu teléfono debe ser un número',
                }"
                outer-class="formulate-input flex-grow pl-2"
                label-class="text-xs font-bold"
                :disabled="registered"
              />
            </div>
            <div class="flex-col justify-center mb-6">
              <FormulateInput
                name="city"
                type="text"
                label="Ciudad de residencia"
                placeholder="Tu ciudad"
                validation="required"
                :validation-messages="{
                  required: 'Ciudad es requerida',
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
          <div v-show="registered" class="payment-option w-full px-4 mt-6">
            <ul class="flex border-b">
              <li class="-mb-px mr-1">
                <a
                  class="bg-white inline-block rounded-t py-2 px-4 text-mercadopagoBlue font-semibold cursor-pointer"
                  :class="{
                    'border-r border-l border-t': openTab == 1,
                    'hover:text-blue-800': openTab !== 1,
                  }"
                  @click="toggleTabs(1)"
                  >MercadoPago</a
                >
              </li>
              <li class="-mb-px mr-1">
                <a
                  class="bg-white inline-block rounded-t py-2 px-4 text-paypalBlue font-semibold cursor-pointer"
                  :class="{
                    'border-r border-l border-t': openTab == 2,
                    'hover:text-blue-800': openTab !== 2,
                  }"
                  @click="toggleTabs(2)"
                  >PayPal</a
                >
              </li>
            </ul>
            <div
              :class="{
                hidden: openTab !== 1,
                block: openTab === 1,
              }"
            >
              <div class="p-8 text-center">
                <button
                  v-if="registered"
                  class="w-auto xl:w-3/4 bg-gray-100 hover:bg-blue-100 border border-gray-300 py-2 px-4 rounded"
                  @click="goToMercadoPago"
                >
                  <img
                    :src="'/img/mercadopago_logo.svg'"
                    class="w-40 inline-block py-1 px-8"
                    alt="MercadoPago"
                  />
                </button>
                <p class="font-hairline text-gray-600 text-xs mt-8">
                  PSE &bull; BANCA EN LÍNEA<br />TARJETAS DE CRÉDITO<br />EFECTY
                  &bull; BALOTO
                </p>
              </div>
            </div>
            <div
              :class="{
                hidden: openTab !== 2,
                block: openTab === 2,
              }"
            >
              <script
                type="application/javascript"
                src="https://www.paypal.com/sdk/js?client-id=AfZDLVmK8PtGjQq4nOhtZNch1qBpOvLOLHf5f5SmtwTWP9rfinjzVLyLK91Pf8p9nt6gOGSwKSsH_80X"
              ></script>
              <p
                class="font-hairline text-center text-gray-600 text-xs px-4 xl:px-20 mt-8"
              >
                MEDIO RECOMENDADO SI VAS A DONAR CON UNA TARJETA DE
                CR&Eacute;DITO INTERNACIONAL
              </p>
              <div id="paypal-button-container" class="px4 xl:px-20 py-8"></div>
            </div>
          </div>
        </div>
        <div
          class="flex flex-col flex-wrap bg-gray-100 rounded w-full md:w-1/2 mt-6 md:mt-0 sm:mt-6"
        >
          <div v-if="course.id" class="flex flex-col flex-wrap py-4 px-8">
            <div
              class="uppercase tracking-wide text-sm text-dustyGray font-bold my-4"
            >
              {{ course.name }}
            </div>
            <a
              href="#"
              class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline"
              >{{ course.tagline.toUpperCase() }}</a
            >
            <p class="mt-2 font-thin text-black break-words">
              {{ course.description }}
            </p>
            <hr class="border-gray-400 my-4 lg:my-8" />
            <p class="font-hairline text-dustyGray text-xs">DONACI&Oacute;N</p>
            <h3 class="text-lg lg:text-xl font-bold my-2">
              {{
                '$ ' + new Intl.NumberFormat().format(course.price) + ' COP '
              }}
              <span class="text-gray-500">{{
                '| $ ' + course.price_usd + ' USD'
              }}</span>
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
import DefaultLayout from '../layouts/DefaultLayout'
import PxPaymentMethods from '../components/PxPaymentMethods'

export default {
  components: { PxPaymentMethods },
  data() {
    return {
      query: this.$route.query,
      formValues: {},
      valid: {},
      course: {},
      student: {},
      referenceCode: '',
      mercadoPagoUrl: '',
      registered: false,
      openTab: 1,
    }
  },

  created() {
    this.$emit(`update:layout`, DefaultLayout)

    if (!this.query.course) {
      this.query.course = 2
    }

    axios
      .get(`api/courses/${this.query.course}`)
      .then((res) => {
        console.log(res.data)
        this.course = res.data
      })
      .catch((e) => {
        window.location.replace('/error')
      })
  },

  methods: {
    addStudent() {
      const data = this.formValues

      axios
        .post('api/students', data)
        .then((res) => {
          console.log(res.data)
          this.student = res.data
          this.getReferenceCode(res.data.id)
          this.registered = true
        })
        .catch((e) => {
          console.log(e)
        })
    },

    getReferenceCode(student) {
      axios
        .post('api/reference', {
          course: this.query.course,
          student,
        })
        .then((res) => {
          console.log(res.data)
          this.referenceCode = res.data.referenceCode
          this.mercadoPagoUrl = res.data.init_point
          this.createPaypal(this.student, this.course, res.data.referenceId)
        })
        .catch((e) => {
          console.log(e)
        })
    },

    goToMercadoPago() {
      window.location.replace(this.mercadoPagoUrl)
    },

    createPaypal(student, course, referenceId) {
      window.paypal
        .Buttons({
          createOrder(data, actions) {
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
                    currency_code: 'USD',
                  },
                },
              ],
            })
          },
          onApprove(data, actions) {
            // This function captures the funds from the transaction.

            actions.order.capture().then(function (details) {
              // This function shows a transaction success message to your buyer.
              console.log(details)

              const transaction = {
                type: 'PAYPAL',
                paypal_order: details.id,
                status: details.status,
                external_reference: details.purchase_units[0].reference_id,
                description: details.purchase_units[0].description,
                transaction_amount: details.purchase_units[0].amount.value,
                currency_id: details.purchase_units[0].amount.currency_code,
              }

              axios
                .post('api/transactions/paypal', transaction)
                .then((res) => {
                  window.location.replace(
                    `/response?collection_status=${transaction.status}`
                  )
                })
                .catch((e) => {
                  console.log(e)
                })
            })
          },
        })
        .render('#paypal-button-container')
      // This function displays Smart Payment Buttons on your web page.
    },

    toggleTabs(tabNumber) {
      this.openTab = tabNumber
    },
  },
}
</script>
