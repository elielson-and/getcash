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

onMounted(() => {
    modalID.value = 'modal_' + Math.floor(Math.random() * 10000000);
});

const showModal = () => {
    const modal = document.getElementById(modalID.value);
    if (modal) modal.showModal();
};

</script>

<template>
    <button @click="showModal()" class="btn btn-success btn-sm  text-white"> Pagar / Detalhes</button>

    <dialog :id="modalID" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Pague com PIX</h3>
            <!-- <p class="py-4">Press ESC key or click on ✕ button to close</p> -->

            <div v-if="true" class="w-full">
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
</template>