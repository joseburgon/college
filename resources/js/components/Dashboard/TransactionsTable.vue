<template>
    <div class="flex flex-col mt-8">
        <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
        >
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
            >
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Type / ID
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Detail / Metódo de Pago
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Status
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Referencia
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Estudiante
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50"
                            ></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr v-for="(transaction, index) in transactions" :key="index">
                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                            >
                                <div class="flex items-center">
                                    <div>
                                        <div
                                            class="text-sm leading-5 font-medium text-gray-900"
                                        >
                                            {{
                                                transaction.type
                                            }}
                                        </div>
                                        <div
                                            class="text-sm leading-5 text-gray-500"
                                        >
                                            {{ transaction.id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                            >
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ transaction.status_detail }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ transaction.payment_method_id }}
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                            >
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                    >{{ transaction.status }}</span
                                >
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                            >
                                {{ transaction.external_reference }}
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                            >
                                {{ `${transaction.reference_code.student.name} ${transaction.reference_code.student.last_name}` }}
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
                            >
                                <router-link
                                    :to="{
                                        name: 'transaction-edit',
                                        params: { id: transaction.id },
                                    }"
                                    class="text-indigo-600 hover:text-indigo-900"
                                    >Editar
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'transactionsTable',
    components: {},
    props: {
        transactions: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {};
    },
};
</script>
