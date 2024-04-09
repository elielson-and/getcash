<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { ArrowsRightLeftIcon } from "@heroicons/vue/24/solid";
import { Vue3Lottie } from 'vue3-lottie';

import CheckAnimation from '@/Lottie/CheckPayment.json';;

import { DocumentDuplicateIcon } from '@heroicons/vue/24/outline';
const isLoading = ref(false);
const isPixKeyCopied = ref(false);

const copyPixToClipboard = (() => {

    isPixKeyCopied.value = true;
});

defineProps({
    documentation: {
        type: Object,
    },
});



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
                                    <Button onclick="modalPayment.showModal()"
                                        class="btn btn-success btn-sm  text-white">Pagar </Button>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-orange-500">Em aberto</th>
                                <td>Empréstimo</td>
                                <td>R$: 410,00</td>
                                <td>1/2</td>
                                <td>17/03/2024</td>
                                <td>
                                    <Link class="btn btn-success btn-sm  text-white">Pagar </Link>
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
                                    <Link class="btn btn-success btn-sm  text-white">Pagar </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div v-else class="w-full text-center">
                        Você ainda não fez nenhuma transação.
                    </div>
                </div>

            </div>

            <!-- You can open the modal using ID.showModal() method -->
            <!-- <button class="btn" onclick="modalPayment.showModal()">open modal</button> -->
            <dialog id="modalPayment" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="font-bold text-lg">Pague com PIX</h3>
                    <!-- <p class="py-4">Press ESC key or click on ✕ button to close</p> -->

                    <div v-if="false" class="w-full">
                        <img src="@/Images/test_qr_code.png" class="w-full max-w-[240px] mx-auto">

                        <p v-if="isPixKeyCopied"
                            class="text-center rounded-lg my-2 p-4 bg-green-200 text-green-900 animate-shake animate-duration-200">
                            Chave PIX
                            copiada para sua
                            área de
                            transferência</p>

                        <div class="w-full bg-blue-50 p-3 mb-6 rounded-lg flex items-center gap-2 ">
                            <p class="truncate">
                                00020101021126580014br.gov.bcb.pix0136271f0939-418d-4bc5-b6b7-cb32b063fab552040000530398654040.105802BR5925ELIELSON
                                ANDRE MENDES SIL6009SAO PAULO622905251HTSVYYM4BGGRZ5TDFJAVFCJZ6304FE56</p>
                            <button @click="copyPixToClipboard" class="bg-blue-600 text-white py-3 px-6 rounded-lg">
                                <DocumentDuplicateIcon class="w-6" />
                            </button>
                        </div>
                        <p class="text-center mt-4">Caso o processamento automático não funcione
                            em até 10 segundos,
                            clique no botão
                            abaixo</p>
                        <button class="w-full bg-blue-500 text-white p-4 mt-8 text-xl font-bold rounded-md">Já realizei
                            o
                            pagamento</button>
                    </div>
                    <div v-else class="w-full">
                        <Vue3Lottie class="" :animationData="CheckAnimation" :width="220" :loop="false" :speed="1" />
                        <h2 class="text-center text-xl">Recebemos seu pagamento, obrigado!</h2>
                    </div>
                </div>
            </dialog>
        </div>
    </AuthenticatedLayout>
</template>
