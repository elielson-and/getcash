<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { ArrowsRightLeftIcon } from "@heroicons/vue/24/solid";
import axios from "axios";

import InstallmentPayment from '@/Components/App/ClientDashboard/Modals/InstallmentPayment.vue';

const isLoading = ref(false);




//listagem de solicitacoes
async function getLoans() {
    const response = await axios.get('/get-loan');
    this.clientDocumentation = response.data;
}


onMounted(() => {
    // getLoans()
})

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ArrowsRightLeftIcon class="w-6 mr-2" />
                    Minhas transações
                </div>
            </div>

            <div class="w-full p-4">

                <div class="overflow-x-auto">
                    <table v-if="true" class="table table-zebra">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Parcela</th>
                                <th>Data</th>
                                <th>Pagamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th class="text-orange-500">Em aberto</th>
                                <td>Empréstimo</td>
                                <td>R$: 180,00</td>
                                <td>1/2</td>
                                <td>17/03/2024</td>
                                <td>
                                    <InstallmentPayment />
                                </td>
                            </tr>
                            <tr>
                                <th class="text-orange-500">Em aberto</th>
                                <td>Empréstimo</td>
                                <td>R$: 410,00</td>
                                <td>1/2</td>
                                <td>17/03/2024</td>
                                <td>
                                    <InstallmentPayment />
                                </td>
                            </tr>
                            <tr>
                                <th class="text-green-500">Quitado</th>
                                <td>Empréstimo</td>
                                <td>R$: 310,00</td>
                                <td>1/2</td>
                                <td>17/03/2024</td>
                                <td>Quitado</td>
                            </tr>
                            <tr>
                                <th class="text-orange-500">Em aberto</th>
                                <td>Empréstimo</td>
                                <td>R$: 630,00</td>
                                <td>1/2</td>
                                <td>17/03/2024</td>
                                <td>
                                    <InstallmentPayment />
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div v-else class="w-full text-center">
                        Você ainda não fez nenhuma transação.
                    </div>
                </div>

            </div>


        </div>
    </AuthenticatedLayout>
</template>
