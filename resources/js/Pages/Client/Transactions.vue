<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import {ArrowsRightLeftIcon, ClockIcon} from "@heroicons/vue/24/outline";
import axios from "axios";

import InstallmentPayment from '@/Components/App/ClientDashboard/Modals/InstallmentPayment.vue';

const isLoading = ref(false);
const loans = ref();


//listagem de solicitacoes
async function getLoans() {
    const response = await axios.get('/get-loan');
    setTimeout(() => {
        loans.value = response.data;
    }, 1000);
}

const formatBRL = (value) => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    }).format(value);
}
const formateDate = (date) => {
    return new Date(date).toLocaleDateString('pt-BR');
}

onMounted(() => {
    getLoans()
});

</script>

<template>

    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ArrowsRightLeftIcon class="w-6 mr-2"/>
                    Minhas transações
                </div>
            </div>

            <div class="w-full p-4">

                <!-- skeleton -->
                <div v-if="!loans" class="w-full px-5">
                    <div v-for="i in 5" class="my-6 skeleton w-full h-10 rounded-md"></div>
                </div>

                <div v-else class="overflow-x-auto">
                    <table v-if="loans" class="table table-zebra border">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Parcela</th>
                            <th>Data solicitação</th>
                            <th>Pagamento/detalhes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(loan, index) in loans" :key="loan.id">
                            <th>

                                <small class="p-2 rounded-md flex" :class="{
                                        'text-yellow-500': loan.loan_status.id === 1,
                                        'bg-blue-200 text-blue-600': loan.loan_status.id === 2,
                                        'bg-green-200 text-green-600': loan.loan_status.id === 3,
                                        'bg-red-200 text-red-600': loan.loan_status.id === 4
                                    }">
                                    <ClockIcon class="hidden md:block w-5 mr-1" v-if="loan.loan_status.id === 1"/>
                                    {{ loan.loan_status.name }}
                                </small>
                            </th>
                            <td>{{ formatBRL(loan.value) }}</td>
                            <td>{{ loan.current_installment }}/{{ loan.installment_amount }}</td>
                            <td>{{ formateDate(loan.created_at) }}</td>
                            <td>
                                <InstallmentPayment :loan="loan"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    <div v-if="!loans || loans === ''" class="w-full text-center mt-20">
                        Você ainda não fez nenhuma transação.
                    </div>
                </div>

            </div>


        </div>
    </AuthenticatedLayout>
</template>
