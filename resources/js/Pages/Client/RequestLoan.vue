<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import { Vue3Lottie } from 'vue3-lottie';
import { onClickOutside } from '@vueuse/core'
import { ArrowLongRightIcon, ArrowLeftIcon } from "@heroicons/vue/24/solid";
import { BanknotesIcon } from "@heroicons/vue/24/outline";
import CurrencyMask from "@/Components/App/Input/CurrencyMask.vue";
import CheckPayment from '@/Lottie/CheckPayment.json';
import ErrorAnimation from '@/Lottie/ErrorAnimation.json';
import MoneyLoading from '@/Lottie/MoneyLoading.json';
import axios from "axios";
import { computed } from "vue";
import { reactive } from "vue";

defineProps({
    success: {
        type: Boolean,
        default: null
    },

});

const page = usePage()

const user = computed(() => page.props.auth.user)

const isLoading = ref(false);

const target = ref(null); // Clickoutside

const modelValue = ref(0);
//-----
const interest = ref(40); // Juros 0 - 100
//-----
const wallet = ref([]);
const minValueToAcceptInstallment = ref(100);
const shuldFinance = ref(false); // deve parcelar
const amountOfInstallments = ref(3); // Numero de parcelas (backend)
const selectedAmountOfInstallments = ref(); // Deve-se incrementar + 1
const paymentDay = ref();
const installmentValue = ref(0);
const totalLoanWithInterest = ref(0);
const isTermsAccepted = ref(); // deve
const userPixKey = ref('');
const confirmationRange = ref(10);

async function getWalletData() {
    await axios.get('/get-wallet')
        .then((response) => {
            wallet.value = response.data;
        });
}
function handleCleanPriceUpdate(cleanedPrice) {
    modelValue.value = cleanedPrice;
}

onMounted(() => {
    getWalletData();
});

// Installments quantities handling
function handleInstallmentsAmount() {
    getInstallmentValue();
    if (modelValue.value >= minValueToAcceptInstallment.value) {
        shuldFinance.value = true;
    } else {
        selectedAmountOfInstallments.value = 0;
        shuldFinance.value = false;
    }
}

onClickOutside(target, event => {
    if (modelValue.value >= minValueToAcceptInstallment.value) {
        shuldFinance.value = true;
    } else {
        selectedAmountOfInstallments.value = 0;
        shuldFinance.value = false;
    }
    // shuldFinance.value = modelValue.value >= minValueToAcceptInstallment.value;
});

const getMaskedValue = () => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    }).format(modelValue.value);
}

// Installment calculation
const getInstallmentValue = (optionIndex) => {
    //deve calcular o valor individual de cada parcela
    var interestPorcentage = parseFloat(modelValue.value) * (interest.value / 100);
    var totalLoanWithInterest = interestPorcentage + parseFloat(modelValue.value);

    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    }).format(totalLoanWithInterest / optionIndex);
}


watch(confirmationRange, (newValue, oldValue) => {
    if (newValue == 100) {
        submit();

    }
});


const submit = () => {
    isLoading.value = true;

    router.post('/request-loan', {
        value: modelValue.value,
        user_id: user.id,
        installment_amount: selectedAmountOfInstallments.value + 1,
        installment_value: parseFloat((parseFloat(modelValue.value) * (interest.value / 100) + parseFloat(modelValue.value)) / (selectedAmountOfInstallments.value + 1)).toFixed(2),
        current_interest: interest.value,
        payment_day: paymentDay.value
    });
    setTimeout(() => {
        isLoading.value = false;
    }, 3000);
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <BanknotesIcon class="w-6 mr-2" />
                    Solicitar empréstimo <button @click="submit">teste</button>
                </div>
            </div>

            <div class="w-full p-4">


                <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">De quanto você precisa?</span>
                        </label>
                        <CurrencyMask class="input input-bordered" ref="target" v-model="modelValue"
                            :maxValue="parseFloat(wallet.max_available_value)" :Interest="interest"
                            @updateCleanPrice="handleCleanPriceUpdate" />
                    </div>



                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Parcelas {{ selectedAmountOfInstallments }}</span>
                        </label>
                        <select v-model="selectedAmountOfInstallments" @focus="handleInstallmentsAmount()"
                            class="select select-bordered" required>
                            <option disabled>
                                {{ shuldFinance ? 'Selecionar parcela' : 'Parcela unica disponivel' }}
                            </option>

                            <option v-for="(item, index) in amountOfInstallments " :key="index" :value="index++"
                                :hidden="!shuldFinance" :selected="!shuldFinance && index == 0">
                                {{ index }} x de {{ getInstallmentValue(index) }}
                            </option>

                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Dia do vencimento:</span>
                        </label>
                        <select class="select select-bordered" required v-model="paymentDay">
                            <option disabled selected>
                                Selecione
                            </option>
                            <option value="1">
                                1
                            </option>
                            <option value="5">
                                5
                            </option>
                            <option value="10">
                                10
                            </option>
                            <option value="15">
                                15
                            </option>
                        </select>
                        <small class="text-gray-500"><b>Dia limite</b> do pagamento de sua(s)
                            parcela(s)</small>
                    </div>

                </div>
                <div v-if="parseFloat(modelValue) > 1.00 && parseFloat(modelValue) <= wallet.max_available_value"
                    class="w-full my-5 flex justify-end gap-2 items-center animate-fade-up animate-duration-[400ms]">
                    <div class="form-control">
                        <label class="label cursor-pointer flex gap-2">
                            <input v-model="isTermsAccepted" type="checkbox" class=" border-gray-300 bg-gray-300 p-2" />
                            <span class="label-text ">Aceito os <a href="#" class="text-blue-400">termos</a></span>
                        </label>
                    </div>
                    <button :disabled="!isTermsAccepted" onclick="modal_confirm_loan.showModal()"
                        class="btn btn-info bg-blue-500 text-white border-none">
                        Continuar
                        <ArrowLongRightIcon class="w-6" />
                    </button>
                </div>

            </div>


            <dialog id="modal_confirm_loan" class="modal modal-bottom sm:modal-middle " style="user-select: none;">
                <div class="modal-box">

                    <div v-if="isLoading" class="w-full p-4 flex flex-col gap-3 ">
                        <Vue3Lottie class="z-10" :animationData="MoneyLoading" :width="190" :loop="true" :speed="1" />
                        <h2 class="text-center text-2xl text-gray-600 font-bold">
                            Quase lá.. <br> só mais um momento..
                        </h2>

                    </div>
                    <div v-else class="w-full">
                        <div v-if="success === true" class="w-full p-4 flex flex-col gap-3 ">
                            <Vue3Lottie class="z-10" :animationData="CheckPayment" :width="150" :loop="false"
                                :speed="1" />
                            <h2 class="text-center text-xl text-gray-600 font-bold">
                                Solicitação de empréstimo realizada com sucesso. Acompanhe o status na tela de
                                transações.
                            </h2>

                            <Link :href="route('transacoes')" class="text-center mb-8 text-blue-600 hover:underline ">
                            Ver minhas solicitações >
                            </Link>
                        </div>
                        <div v-if="success === false" class="w-full p-4 flex flex-col gap-3 ">
                            <Vue3Lottie class="z-10" :animationData="ErrorAnimation" :width="150" :loop="false"
                                :speed="1" />
                            <h2 class="text-center text-xl text-gray-600 font-bold">
                                Ocorreu um problema na sua solicitação, por favor, tente novamente mais tarde ou contate
                                o
                                nosso suporte.
                            </h2>

                        </div>
                        <div v-if="!success" class="w-full">

                            <h3 class="font-bold text-lg">Resumo da solicitação</h3>

                            <div class="bg-green-50 my-5 p-4 rounded-md ">
                                Valor solicitado: {{ getMaskedValue() }} <br>
                                Total de parcelas: {{ selectedAmountOfInstallments + 1 }} <br>
                                Valor da parcela: {{ getInstallmentValue(selectedAmountOfInstallments + 1) }}
                            </div>

                            <div class="form-control ">
                                <label class="label">
                                    <span class="label-text">Chave PIX para crédito do valor:</span>
                                </label>
                                <input type="text" v-model="userPixKey"
                                    placeholder="Email, CPF, telefone, chave aleatória..."
                                    class="input input-bordered w-full mb-5" />

                            </div>


                            <div v-if="userPixKey.length > 5" class="my-8 animate-shake animate-once">
                                <div class="text-gray-600 flex ">Arraste até o final para concluir a solicitação
                                    <ArrowLongRightIcon class="w-6" />
                                </div>
                                <input type="range" v-model="confirmationRange" min="0" max="100"
                                    class="range py-5 rounded-xl  "
                                    :class="confirmationRange < 70 ? 'range-info' : 'range-success'" />
                            </div>

                        </div>
                    </div>




                    <div v-if="success === true || success === false" class="w-full">
                        <button v-if="!isLoading" @click="router.get('/solicitar-valor')"
                            class="btn w-full">Fechar</button>
                    </div>
                    <form v-else method="dialog" class="w-full">
                        <button class="btn w-full">Cancelar</button>
                    </form>



                </div>



            </dialog>
        </div>
    </AuthenticatedLayout>
</template>
