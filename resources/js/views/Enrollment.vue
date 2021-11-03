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
                            class="font-bold text-black text-xl md:text-2xl mt-2"
                        >
                            MATR&Iacute;CULA
                        </h2>

                        <h4 v-show="course.hasOwnProperty('name')" class="text-dustyGray">{{ course.name }}</h4>

                        <FormulateInput v-model="course" name="course" type="hidden"/>

                        <div class="grid lg:grid-flow-col grid-cols-1 lg:grid-cols-2 lg:gap-4 mb-6 lg:mb-0">
                            <FormulateInput
                                name="name"
                                type="text"
                                label="Tu nombre"
                                placeholder="Tu primer nombre"
                                validation="required"
                                :validation-messages="{
                                  required: 'Nombre es requerido',
                                }"
                                element-class="flex-grow"
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
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>

                        <div class="grid lg:grid-flow-col grid-cols-1 lg:grid-cols-2 lg:gap-4 mb-6 lg:mb-0">
                            <FormulateInput
                                name="email"
                                type="email"
                                label="Correo electrónico"
                                placeholder="Email"
                                validation="bail|required|email"
                                :validation-messages="{
                                  required: 'Tu correo es requerido',
                                  email: 'Tu correo debe ser un email válido',
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                            <FormulateInput
                                name="email_confirmation"
                                type="email"
                                label="Confirmar correo"
                                placeholder="Email"
                                onpaste="return false;"
                                validation="required|confirm:email"
                                :validation-messages="{
                                  confirm: 'Los correos no coinciden',
                                  required: 'Es necesario confirmar la dirección de correo',
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>

                        <div class="flex-col justify-center mb-6">
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
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                        </div>

                        <div class="flex-col justify-center mb-6">
                            <FormulateInput
                                name="place_input"
                                id="place_input"
                                type="text"
                                label="Ciudad"
                                placeholder="Escribe el nombre y escoge la ciudad de la lista"
                                validation="required"
                                :validation-messages="{
                                  required: 'Ciudad es requerida',
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                            />
                            <FormulateInput name="city" type="hidden"/>
                            <FormulateInput name="state" type="hidden"/>
                            <FormulateInput name="country" type="hidden"/>
                        </div>

                        <div class="grid xl:grid-flow-col grid-cols-1 xl:grid-cols-2 xl:gap-4 mb-6 xl:mb-0">
                            <FormulateInput
                                name="campus_id"
                                type="select"
                                label="Campus"
                                v-model="formValues.campus_id"
                                placeholder="Selecciona un Campus"
                                :options="campuses"
                                validation="required"
                                :validation-messages="{
                                  required: 'El campus al que asistes es requerido',
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="registered"
                                @input="getCampusLeaders"
                            />
                            <FormulateInput
                                name="leader_id"
                                type="select"
                                label="Lider / Trainer"
                                placeholder="Selecciona tu líder de LivingGroup"
                                :options="leaders"
                                validation="required"
                                :validation-messages="{
                                  required: 'Tu lider es requerido',
                                }"
                                element-class="flex-grow"
                                label-class="text-xs font-bold"
                                :disabled="!formValues.campus_id"
                            />
                        </div>

                        <div class="flex-col mt-5" v-if="errors">
                          <span
                              class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                              v-for="error in errors"
                              :key="error[0]"
                          >{{ error[0] }}
                          </span>
                        </div>

                        <div class="flex-col text-center lg:text-left mt-10">
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
                                >Medios de Pago Colombia</a
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
                                >Medios de Pago Internacionales</a
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
                                <p
                                    class="font-hairline text-center text-gray-600 text-xs px-4 xl:px-20 mb-8"
                                >
                                    DÉBITO, CRÉDITO Y EFECTIVO EN COLOMBIA
                                </p>
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
                                    PSE &bull; BANCA EN LÍNEA<br/>TARJETAS DE CRÉDITO<br/>EFECTY
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
                                :src="paypalUrl"
                            ></script>
                            <p
                                class="font-hairline text-center text-gray-600 text-xs px-4 xl:px-20 mt-8"
                            >
                                DÉBITO Y CR&Eacute;DITO INTERNACIONAL
                            </p>
                            <div id="paypal-button-container" class="px4 xl:px-20 py-8"></div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col flex-wrap bg-gray-100 rounded w-full md:w-1/2 mt-10 md:mt-0 sm:mt-10"
                >
                    <div v-if="course.id" class="flex flex-col flex-wrap py-4 px-8">
                        <div
                            class="uppercase tracking-wide text-sm text-dustyGray font-bold my-4"
                        >
                            {{ course.name }} <span v-if="course.id === 7">(ACCESO POR 1 AÑO)</span>
                        </div>
                        <a
                            href="#"
                            class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline"
                        >{{ course.tagline.toUpperCase() }} <span v-if="course.id === 7">(20% OFF)</span>
                        </a>
                        <p class="mt-2 font-thin text-black break-words">
                            {{ course.description }}
                        </p>
                        <hr class="border-gray-400 my-4 lg:my-8"/>
                        <p class="font-hairline text-dustyGray text-xs">
                            PRECIO FINAL
                            <span v-if="parseInt(course.discount_percentage) > 0"
                                  class="font-bold">{{ ` (${course.discount_percentage}% OFF)` }}</span>
                        </p>
                        <h3 class="text-lg lg:text-xl font-bold my-2">
                            {{
                                '$ ' + new Intl.NumberFormat().format(course.price_with_discount) + ' COP '
                            }}
                            <span class="text-gray-500">
                                {{ '| $ ' + course.price_usd_with_discount + ' USD' }}
                            </span>

                        </h3>
                        <p v-if="parseInt(course.discount_percentage) > 0" class="font-hairline text-dustyGray text-xs">
                            PRECIO FULL</p>
                        <h4 v-if="parseInt(course.discount_percentage) > 0" class="text-lg lg:text-lg mt-2 mb-4">
                            {{
                                '$ ' + new Intl.NumberFormat().format(course.price) + ' COP '
                            }}
                            <span class="text-gray-500">
                                {{ '| $ ' + course.price_usd + ' USD' }}
                            </span>
                        </h4>
                        <p class="font-hairline text-dustyGray text-xs">MEDIOS DE PAGO</p>
                        <px-payment-methods/>
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
    components: {PxPaymentMethods},

    data() {
        return {
            query: this.$route.query,
            formValues: {},
            valid: {},
            course: {},
            campuses: {},
            leaders: {},
            student: {},
            referenceCode: '',
            mercadoPagoUrl: '',
            paypalUrl: 'https://www.paypal.com/sdk/js?client-id=ASJj90rMP8iMp4VnLxXLX3p1qIPrYPjit7GYnEFOqsNjJEzysf8_Hi9L882ksCzxIpGEnsB3JrUT11o5',
            registered: false,
            openTab: 1,
            errors: [],
        }
    },

    created() {
        this.$emit(`update:layout`, DefaultLayout)

        if (!this.query.course) {
            this.query.course = 2
        }

        /*if (parseInt(this.query.course) === 6) {
            this.$router.push({name: 'unavailable'})
        }*/

        axios
            .get(`api/courses/${this.query.course}`)
            .then((res) => {
                this.course = res.data.data
            })
            .catch((e) => {
                this.$router.push({name: 'error'})
            })

        axios
            .get(`api/campuses`)
            .then((res) => {
                this.campuses = res.data
            })
            .catch((e) => {
                this.$router.push({name: 'error'})
            })
    },

    mounted() {
        const autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('place_input')
        )

        autocomplete.addListener('place_changed', () => {
            let place = autocomplete.getPlace()

            this.formValues.place_input = place.formatted_address

            this.setLocation(place.address_components)
        })
    },

    methods: {
        addStudent() {
            const data = this.formValues

            axios
                .post('api/students', data)
                .then((res) => {
                    this.student = res.data

                    this.getReferenceCode(res.data.id)

                    this.registered = true
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                    }
                })
        },

        getReferenceCode(student) {
            axios
                .post('api/reference', {
                    course: this.query.course,
                    student,
                    testing: false
                })
                .then((res) => {
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
                                        value: course.price_usd_with_discount,
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
                            // console.log(details)

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

        setLocation(addressComponents) {
            let api_city = '',
                api_state = '',
                api_country = ''

            addressComponents.forEach(function (item) {
                if (item.types.includes('locality')) {
                    api_city = item.long_name
                }

                if (item.types.includes('administrative_area_level_1')) {
                    api_state = item.long_name
                }

                if (item.types.includes('country')) {
                    api_country = item.long_name
                }
            })

            this.formValues.city = api_city
            this.formValues.state = api_state
            this.formValues.country = api_country

            console.log(
                `${this.formValues.city} | ${this.formValues.state} | ${this.formValues.country}`
            )
        },

        getCampusLeaders() {
            axios
                .get(`api/campuses/${this.formValues.campus_id}/leaders`)
                .then((res) => {
                    this.formValues.leader_id = undefined

                    this.leaders = Object.entries(res.data)
                        .sort((a, b) => a[1] > b[1] ? 1 : -1)
                        .map(function (obj) {
                            return {
                                'label': obj[1],
                                'value': obj[0],
                            };
                        });

                    console.log(this.leaders)
                })
                .catch((e) => {
                    this.$router.push({name: 'error'})
                })
        }
    },
}
</script>
