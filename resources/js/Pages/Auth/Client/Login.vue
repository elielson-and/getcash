<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { FingerPrintIcon } from '@heroicons/vue/24/solid'
import { TheMask } from 'vue-the-mask'

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
                <img src="@/Images/AuthIllustration.png" class="w-full" />
            </div>
            <div class="w-full sm:w-1/2 flex flex-col justify-between">

                <div class="w-full">
                    <div class="w-full mb-16 flex justify-center sm:hidden">
                        <img src="@/Images/logo.png" class="w-44" />
                    </div>

                    <span class="mb-1.5 block text-gray-500 font-medium">Olá novamente!👋</span>
                    <h2 class="mb-9 text-2xl font-bold text-gray-500 sm:text-title-xl2">
                        Acesse seu painel
                    </h2>
                    <form @submit.prevent="submit">

                        <div class="mb-4">
                            <InputLabel for="email" value="Email" />
                            <label class="input input-bordered flex items-center gap-2">
                                <input v-model="form.email" type="email"
                                    class="grow border-none focus:ring-0 shadow-none"
                                    placeholder="seuemail@email.com" />
                                <FingerPrintIcon class="w-6" />
                            </label>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="password" value="Senha" />
                            <label class="input input-bordered flex items-center gap-2">
                                <input v-model="form.password" type="password"
                                    class="grow border-none focus:ring-0 shadow-none" />
                                <FingerPrintIcon class="w-6" />
                            </label>
                        </div>


                        <div v-if="form.errors.cpf" role="alert"
                            class="alert alert-error mb-2 text-red-600 bg-red-100 ">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="stroke-current shrink-0 h-6 w-6 hidden sm:block" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Cliente não encontrado. Caso não tenha cadastro
                                <Link href="/cadastro" class="text-blue-500 underline">Clique aqui
                                </Link>
                            </span>


                        </div>

                        <button type="submit"
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
                    </form>
                    <p class="text-center my-4 text-gray-500">
                        Não tem conta?
                        <Link href="/cadastro" class=" text-blue-500 hover:underline">Cadastre-se</Link>
                    </p>

                </div>
                <div class="hidden w-full my-6 sm:flex justify-center">
                    <img src="@/Images/logo.png" class="w-40" />
                </div>
                <small class="text-center text-gray-400">© 2024 - GetCash</small>
            </div>

        </div>


    </GuestLayout>
</template>
