<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { FingerPrintIcon } from '@heroicons/vue/24/solid'
import { ShieldCheckIcon } from '@heroicons/vue/24/solid'
import { CalendarDaysIcon } from '@heroicons/vue/24/solid'
import { TicketIcon } from '@heroicons/vue/24/solid'
import { TheMask } from 'vue-the-mask'
import { Vue3Lottie } from 'vue3-lottie';

import RegisterDocs from '@/Lottie/RegisterDocs.json';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div class=" w-full flex  h-screen sm:h-auto">

            <div class="w-1/2 hidden sm:block ">
                <!-- <img src="@/Images/AuthIllustration.png" class="w-full" /> -->
                <Vue3Lottie class="z-1 " :animationData="RegisterDocs" width="100 %" :loop="true" :speed="0.8" />
            </div>
            <div class="w-full sm:w-1/2 flex flex-col justify-between">

                <div class="w-full">
                    <div class="w-full mb-16 flex justify-center sm:hidden">
                        <img src="@/Images/logo.png" class="w-44" />
                    </div>

                    <!-- <span class="mb-1.5 block text-gray-500 font-medium">Cadastro de usuário</span> -->
                    <h2 class="mb-9 text-2xl font-bold text-gray-500 sm:text-title-xl2">
                        Vamos começar🤑
                    </h2>

                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-black ">Nome completo:</label>

                        <label class="input input-bordered flex items-center gap-2">
                            <input type="text" class="grow text-xl border-none focus:ring-0 shadow-none" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </label>

                        <small v-if="false" style="color: red">Digite um CPF válido.</small>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-black ">Digite seu CPF:</label>

                        <label class="input input-bordered flex items-center gap-2">
                            <input v-mask="'###.###.###-##'" type="text"
                                class="grow text-xl border-none focus:ring-0 shadow-none"
                                placeholder="___.___.___-__" />
                            <FingerPrintIcon class="w-6" />
                        </label>

                        <small v-if="false" style="color: red">Digite um CPF válido.</small>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2.5 block font-medium text-black ">Data de nascimento:</label>

                        <label class="input input-bordered flex items-center gap-2">
                            <input v-mask="'##/###/####'" type="text"
                                class="grow text-xl border-none focus:ring-0 shadow-none" placeholder="__/__/____" />
                            <CalendarDaysIcon class="w-6" />
                        </label>

                        <small v-if="false" style="color: red">Digite um CPF válido.</small>
                    </div>


                    <div class="mb-4 border-t ">
                        <label class="mb-2.5 mt-4 block font-medium text-gray-700 ">Códido de
                            indicação(Opcional):</label>

                        <label class="input input-bordered flex items-center gap-2 border-dashed border-green-500">
                            <input v-mask="'########'" type="text"
                                class="grow text-xl border-none focus:ring-0 shadow-none" />
                            <TicketIcon class="w-6 text-green-600" />
                        </label>

                        <small v-if="false" style="color: red">Digite um CPF válido.</small>
                    </div>



                    <button
                        class="btn  w-full bg-blue-500 hover:bg-blue-400  px-4 text-white text-xl font-bold transition-all rounded-xl">
                        Entrar
                        <div class="icon">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <!-- <span class="loading loading-spinner"></span> -->
                    </button>

                    <p class="text-center my-4 text-gray-500">
                        Já tem cadastro?
                        <Link href="/login" class=" text-blue-500 hover:underline">Login</Link>
                    </p>

                    <div class="w-full flex justify-center">
                        <button class="text-blue-500 underline" onclick="modal_info_data.showModal()">
                            Por que pedimos esses dados?</button>
                        <dialog id="modal_info_data" class="modal sm:modal-middle">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg flex text-green-600">
                                    <ShieldCheckIcon class="w-6" /> Dados do usuário
                                </h3>
                                <p class="mt-4">
                                    Nossa equipe está trabalhando constantemente para garantir a segurança de nossos
                                    usuários e de credores parceiros.
                                </p><br>
                                <p class="bg-green-100 p-2 rounded-md">
                                    Ao fornecer essas informações, você
                                    valida
                                    que é uma pessoa real e que é de fato proprietário(a) desta documentação. Além de
                                    estar em total consentimento da solicitação do serviço.
                                </p><br>

                                <p>
                                    Os dados submetidos por nossos usuários são armazenados de maneira criptografada e
                                    em <b>nenhuma hipótese</b> serão compartilhados com terceiros.
                                </p><br>

                                <p>
                                    Você poderá solicitar a exclusão permanente de suas informações através do <u>painel
                                        do
                                        cliente</u> posteriormente.
                                </p>
                                <div class="modal-action">
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn">Entendi</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>


                </div>
                <div class="hidden w-full my-6 sm:flex justify-center">
                    <img src="@/Images/logo.png" class="w-40" />
                </div>
                <small class="text-center text-gray-400">© 2024 - GetCash</small>
            </div>

        </div>


    </GuestLayout>
</template>
