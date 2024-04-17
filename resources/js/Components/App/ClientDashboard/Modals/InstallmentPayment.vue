<script setup>
import { Vue3Lottie } from 'vue3-lottie';
import CheckAnimation from '@/Lottie/CheckPayment.json';
import { DocumentDuplicateIcon } from '@heroicons/vue/24/outline';
import axios from "axios";
import { onMounted, ref } from 'vue';
const modalID = ref('');
const isLoading = ref(false);
const isPixKeyCopied = ref(false);
const copyPixToClipboard = (() => {
    isPixKeyCopied.value = true;
});
const showPaymentScreen = ref(false);

const paymentData = ref(null);

defineProps({
    loan: {
        type: Object,
        default: null
    },

});

onMounted(() => {
    modalID.value = 'modal_' + Math.floor(Math.random() * 10000000);
});

const showModal = () => {
    const modal = document.getElementById(modalID.value);
    if (modal) modal.showModal();
};

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

const handlePaymentScreen=()=>{
    showPaymentScreen.value = !showPaymentScreen.value;
    generatePayment();
}


// Requisicao para pagamento


async function generatePayment() {
    isLoading.value = true;
    try {
        const response = await axios.post('/generate-pix-payment');
        paymentData.value = response.data;
        // console.log("Encoded Image: ", response.data.pix.encodedImage);
        isLoading.value = false;
    } catch (error) {
        console.error('Erro ao gerar pagamento:', error);
        isLoading.value = false;
    }
}

</script>

<template>
    <button @click="showModal()" class="btn btn-success btn-sm  text-white"> Pagar / Detalhes</button>

    <dialog :id="modalID" class="modal">
        <div v-if="!showPaymentScreen" class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Detalhamento </h3>

            <div class="w-full">
<!--                detalhes do pagamento-->
                <div class="w-full my-4 flex flex-col gap-1 rounded-sm">
                    <div class="flex justify-between bg-gray-100 p-1"><span>Status atual</span> <span>{{ loan.loan_status.name }}</span></div>
                    <div class="flex justify-between bg-gray-100 p-1"><span>Valor solicitado</span> <span>{{ formatBRL(loan.value) }}</span></div>
                    <div class="flex justify-between bg-gray-100 p-1"><span>Valor total parcelado</span> <span>Vigente</span></div>
                    <div class="flex justify-between bg-gray-100 p-1"><span>Parcela atual</span> <span>{{ loan.current_installment }}/{{ loan.installment_amount }}</span></div>
                    <div class="flex justify-between bg-gray-100 p-1"><span>Data da solicitação</span> <span>{{ formateDate(loan.created_at) }}</span></div>
                </div>

                <div v-if="loan.loan_status.id === 3" class="w-full bg-green-100 text-green-600 p-4 text-xl">
                    Dívida quitada em {{formateDate(loan.updated_at)}}
                </div>
                <button @click="handlePaymentScreen" v-else class="btn w-full bg-blue-500 hover:bg-blue-600 text-white text-xl mt-4">
                    Pagar parcela {{ loan.current_installment }}/{{ loan.installment_amount }}
                </button>
            </div>
        </div>

        <!--payment-->
        <div v-else class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Pague com PIX</h3>
            <!-- <p class="py-4">Press ESC key or click on ✕ button to close</p> -->
            <div v-if="true" class="w-full animate-fade-left animate-duration-300">

                <div v-if="paymentData" class="w-full">
                    <img v-if="paymentData"
                         :src="'data:image/png;base64,' + paymentData.pix.encodedImage"
                         alt="QR Code de Pagamento"
                         class="max-w-full mx-auto">


                    <p v-if="isPixKeyCopied"
                       class="text-center rounded-lg my-2 p-4 bg-green-200 text-green-900 animate-shake animate-duration-200">
                        Chave PIX
                        copiada para sua
                        área de
                        transferência</p>

                    <div class="w-full bg-blue-50 p-3 mb-6 rounded-lg flex items-center gap-2 ">
                        <p class="truncate">{{paymentData.pix.payload}}</p>
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

                <div v-else class="w-full p-6 flex justify-center items-center ">
                        <p>Caregando...</p>
                </div>


                <button @click="handlePaymentScreen" class="btn w-full mt-4">< Voltar</button>
            </div>
            <div v-else class="w-full animate-fade-right animate-duration-300">
                <Vue3Lottie class="" :animationData="CheckAnimation" :width="220" :loop="false" :speed="1" />
                <h2 class="text-center text-xl">Recebemos seu pagamento, obrigado!</h2>
            </div>
        </div>
    </dialog>
</template>
