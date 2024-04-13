<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { BanknotesIcon } from "@heroicons/vue/24/outline";
import CurrencyMask from "@/Components/App/Input/CurrencyMask.vue";
import axios from "axios";

//-----
const interest = ref(40); // Juros 0 - 100
//-----
const wallet = ref([]);

const amountOfInstallments = ref(0);

async function getWalletData() {
    await axios.get('/get-wallet')
        .then((response) => {
            wallet.value = response.data;
        });
}

onMounted(() => {
    getWalletData();
});

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <BanknotesIcon class="w-6 mr-2" />
                    Solicitar empréstimo
                </div>
            </div>

            <div class="w-full p-4">
                <form enctype="multipart/form-data">

                    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">De quanto você precisa?</span>
                            </label>
                            <CurrencyMask required class="input input-bordered" v-model="testeValue"
                                :maxValue="wallet.max_available_value" :Interest="interest" />
                        </div>


                        <!-- <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nome Completo:</span>
                            </label>
                            <input type="text" placeholder="Digite seu nome completo" :modelValue="10"
                                class="input input-bordered" required />
                        </div> -->


                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Parcelas</span>
                            </label>
                            <select class="select select-bordered" required>
                                <option disabled selected>
                                    Selecione
                                </option>
                                <option value="1">
                                    1
                                </option>
                                <option value="2">
                                    2
                                </option>

                                <option value="3">
                                    2
                                </option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Dia do vencimento:</span>
                            </label>
                            <select class="select select-bordered" required>
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
                            <small class="text-gray-500">Esta é a <b>dia limite</b> do pagamento de sua(s)
                                parcela(s)</small>
                        </div>



                    </div>
                    <div class="w-full my-5 flex justify-end">
                        <button class="btn btn-info bg-blue-500 text-white border-none">
                            Continuar
                            <ArrowLongRightIcon class="w-6" />
                        </button>
                    </div>
                </form>
            </div>




        </div>
    </AuthenticatedLayout>
</template>
