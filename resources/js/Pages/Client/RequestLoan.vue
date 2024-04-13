<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { BanknotesIcon } from "@heroicons/vue/24/outline";
import CurrencyMask from "@/Components/App/Input/CurrencyMask.vue";
import axios from "axios";

const maxAvailableValue = ref();

async function getLoan() {
    const response = await axios.get('/get-loan');
    maxAvailableValue.value = response.data;
}

onMounted(() => {
    getLoan();
});

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <BanknotesIcon class="w-6 mr-2" />
                    Solicitar empréstimo {{ maxAvailableValue }}
                </div>
            </div>

            <div class="w-full p-4">
                <form enctype="multipart/form-data">

                    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">De quanto você precisa?</span>
                            </label>
                            <!-- <input type="text" required class="input input-bordered" /> -->
                            <CurrencyMask required class="input input-bordered" v-model="testeValue" :maxValue="1200" />
                        </div>


                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nome Completo:</span>
                            </label>
                            <input type="text" placeholder="Digite seu nome completo" :modelValue="10"
                                class="input input-bordered" required />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Sexo:</span>
                            </label>
                            <select class="select select-bordered" required>
                                <option disabled selected>
                                    Selecione
                                </option>
                                <option value="m">
                                    Masculino
                                </option>
                                <option value="f">
                                    Feminino
                                </option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Data de Nascimento:</span>
                            </label>
                            <input type="date" required class="input input-bordered" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Telefone:</span>
                            </label>
                            <input v-mask="'(##) #####-####'" required type="tel" placeholder="Digite seu telefone"
                                class="input input-bordered" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email:</span>
                            </label>
                            <input type="email" placeholder="Digite seu email" required class="input input-bordered" />
                        </div>
                        <div class="form-control col-span-1 md:col-span-2 lg:col-span-3">
                            <label class="label">
                                <span class="label-text">Endereço Completo:</span>
                            </label>
                            <input type="text" placeholder="Digite seu endereço completo" required
                                class="input input-bordered" />
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
