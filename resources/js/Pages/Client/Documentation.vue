<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Sidebar from '@/Components/App/Sidebar.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { TheMask } from 'vue-the-mask'


const form = useForm({
    cpf: '',
    fullName: '',
    gender: '',
    birthDate: '',
    phone: '',
    address: ''
});


// handle cpf

async function fetchCpfData(cpf) {
    try {
        // Substitua 'https://seu-endpoint-api.com/cpf' pelo endpoint correto
        const response = await axios.get(`https://dbftools.pro/api/tools/search-cpf/${cpf}`);
        // Aqui você tem acesso aos dados retornados
        console.log(response.data);
        // Prossiga com o que deseja fazer com os dados
    } catch (error) {
        console.error('Erro ao buscar dados do CPF:', error);
        // Trate o erro conforme necessário
    }
}

const handleCpf = (() => {
    // Remove caracteres não numéricos
    var cpf = form.cpf.replace(/\D/g, '');
    if (cpf.length == 11) {
        fetchCpfData(cpf)
    }
});

const submit = () => {
    form.cpf = form.cpf.replace(/\D/g, '');
    form.post(route('save-documentation'), {
        // onFinish: () => form.reset('c'),
    });
};
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="pt-2">
            <div class="max-w-7xl flex gap-2 mx-auto sm:px-6 lg:px-8">
                <Sidebar class="bg-white w-80 overflow-hidden shadow-sm sm:rounded-lg" />

                <div class="bg-white w-full h-screen overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="w-full border-b-2 p-4 mb-4">
                        <div class="text-2xl text-gray-900">Entrega de documentação</div>
                    </div>
                    <!-- {{ $page.props.auth.user.name }} -->

                    <!-- body -->
                    <div class="w-full p-4">
                        <div role="alert" class="alert bg-green-200 border-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Sua documentação foi entregue e atende todos os requisitos! <br>
                                <small>Você já pode fazer a solicitação de novos empréstimos.</small></span>
                        </div>

                        <!-- <div role="alert" class="alert bg-red-200 border-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Sua documentação foi <b>revogada</b>, consulte o administrador para mais
                                informações.</span>
                        </div>

                        <div role="alert" class="alert bg-gray-200 border-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="stroke-current shrink-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Documentação <b>enviada para análise</b>. Consulte seu status nesta tela após algumas
                                horas.</span>
                        </div>
                        <div role="alert" class="alert bg-yellow-200 border-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span><b>Documentação pendente.</b> Considere atualizar seus dados para que possa realizar
                                solicitação de empréstimos.</span>
                        </div> -->


                        <!-- dados -->
                        <div class="w-full mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">CPF:</span>
                                </label>
                                <input v-mask="'###.###.###-##'" v-on:keyup="handleCpf" type="text"
                                    placeholder="Digite seu CPF" v-model="form.cpf" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nome Completo:</span>
                                </label>
                                <input type="text" placeholder="Digite seu nome completo"
                                    class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Sexo:</span>
                                </label>
                                <select class="select select-bordered">
                                    <option disabled selected>Selecione</option>
                                    <option>Masculino</option>
                                    <option>Feminino</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Data de Nascimento:</span>
                                </label>
                                <input type="date" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Telefone:</span>
                                </label>
                                <input v-mask="'(##) #####-####'" type="tel" placeholder="Digite seu telefone"
                                    class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email:</span>
                                </label>
                                <input type="email" placeholder="Digite seu email" class="input input-bordered" />
                            </div>
                            <div class="form-control col-span-1 md:col-span-2 lg:col-span-3">
                                <label class="label">
                                    <span class="label-text">Endereço Completo:</span>
                                </label>
                                <input type="text" placeholder="Digite seu endereço completo"
                                    class="input input-bordered" />
                            </div>


                        </div>
                        <div class="w-full my-5 ">
                            <button class="btn btn-success bg-green-500 text-white">Atualizar</button>
                        </div>






                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
