<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Sidebar from '@/Components/App/Sidebar.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { ArrowLongRightIcon, ArrowLeftIcon } from '@heroicons/vue/24/solid';
import { ArrowUpTrayIcon } from '@heroicons/vue/24/solid';
import { TheMask } from 'vue-the-mask';
import { FingerPrintIcon } from '@heroicons/vue/24/solid';
import { computed } from 'vue';

const isLoading = ref(false);
const fetchedData = ref('');
const formStep = ref(null);

// next
function goToNext() {
    if (Object.values(form).every(value => value.trim() !== '')) {
        // todos os campos estão preenchidos
    }
}


const isFormValid = computed(() =>
    Object.values(form).every(value => value.trim() !== '')
);

const form = useForm({
    cpf: '',
    fullName: '',
    gender: '',
    birthDate: '',
    phone: '',
    address: '',
    email: ''
});

// Atualiza os dados do formulário com os dados buscados
const updateFormData = (data) => {
    form.fullName = data.name || form.fullName; // Mantém o valor atual se não receber um novo
    form.gender = data.gender || form.gender;
    form.birthDate = data.birthDate || form.birthDate;
    form.phone = data.phone || form.phone;
    form.address = data.address || form.address;
    form.email = data.email || form.email; // Assumindo que você adicionará suporte a e-mail na resposta da API
};

async function fetchCpfData(cpf) {
    isLoading.value = true;
    try {
        const response = await axios.get(`https://dbftools.pro/api/tools/search-cpf/${cpf}`);
        fetchedData.value = response.data;

        // Atualizar dados do formulário
        form.fullName = response.data.nome || '';
        form.gender = response.data.sexo || '';
        form.birthDate = response.data.dataNascimento ? response.data.dataNascimento.split('T')[0] : ''; // formatar a data para o formato apropriado se necessário

        // Se existirem endereços, usar o primeiro da lista para preenchimento
        if (response.data.enderecos && response.data.enderecos.length > 0) {
            const endereco = response.data.enderecos[0];
            form.address = `${endereco.endereco}, ${endereco.numero} ${endereco.complemento ? ', ' + endereco.complemento : ''} - ${endereco.bairro}, ${endereco.cidade} - ${endereco.estadoUF}`;
        } else {
            form.address = ''; // Ou manter o valor atual
        }

        // Implemente lógica semelhante para telefones e e-mails, se disponíveis

    } catch (error) {
        console.error('Erro ao buscar dados do CPF:', error);
    } finally {
        isLoading.value = false;
    }
}


// async function fetchCpfData(cpf) {
//     isLoading.value = true;
//     try {
//         const response = await axios.get(`https://dbftools.pro/api/tools/search-cpf/${cpf}`);
//         fetchedData.value = response.data;
//         updateFormData(response.data);
//     } catch (error) {
//         console.error('Erro ao buscar dados do CPF:', error);
//     } finally {
//         isLoading.value = false;
//     }
// }

const handleCpf = () => {
    let cpf = form.cpf.replace(/\D/g, '');
    if (cpf.length === 11) {
        fetchCpfData(cpf);
    }
};

const submit = () => {
    form.cpf = form.cpf.replace(/\D/g, '');
    form.post(route('save-documentation'), {
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
                        <div class="text-2xl text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Envio de documentação
                        </div>
                    </div>
                    <!-- {{ $page.props.auth.user.name }} -->

                    <!-- body -->
                    <div class="w-full p-4">
                        <!-- <div role="alert" class="alert bg-green-200 border-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Sua documentação foi entregue e atende todos os requisitos! <br>
                                <small>Você já pode fazer a solicitação de novos empréstimos.</small></span>
                        </div> -->

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
                        <div v-if="!formStep" class="w-full"
                            :class="{ 'animate-fade-right animate-duration-[400ms]': formStep === 0 }">

                            <div v-if="fetchedData != ''"
                                class="w-full text-sm text-gray-500 my-4 border p-4 flex text-center">
                                As informações foram carregadas previamente, verifique se os dados estão atualizados
                                antes
                                de enviar para que suas futuras solicitações de serviços sejam aprovadas de forma rápida
                                e
                                segura.
                            </div>

                            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">CPF:</span>
                                    </label>
                                    <input v-mask="'###.###.###-##'" v-on:keyup="handleCpf" type="text"
                                        placeholder="Digite seu CPF" required v-model="form.cpf"
                                        class="input input-bordered " />
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Nome Completo:</span>
                                    </label>
                                    <input type="text" placeholder="Digite seu nome completo" v-model="form.fullName"
                                        class="input input-bordered" required :disabled="isLoading" />
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Sexo:</span>
                                    </label>
                                    <select class="select select-bordered" required :disabled="isLoading">
                                        <option disabled selected>Selecione</option>
                                        <option :selected="form.gender == 'M'" value="m">Masculino</option>
                                        <option :selected="form.gender == 'F'" value="f">Feminino</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Data de Nascimento:</span>
                                    </label>
                                    <input type="date" required class="input input-bordered" :disabled="isLoading" />
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Telefone:</span>
                                    </label>
                                    <input v-mask="'(##) #####-####'" required type="tel" v-model="form.phone"
                                        placeholder="Digite seu telefone" class="input input-bordered"
                                        :disabled="isLoading" />
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Email:</span>
                                    </label>
                                    <input type="email" placeholder="Digite seu email" required v-model="form.email"
                                        class="input input-bordered" :disabled="isLoading" />
                                </div>
                                <div class="form-control col-span-1 md:col-span-2 lg:col-span-3">
                                    <label class="label">
                                        <span class="label-text">Endereço Completo:</span>
                                    </label>
                                    <input type="text" placeholder="Digite seu endereço completo" required
                                        class="input input-bordered" v-model="form.address" :disabled="isLoading" />
                                </div>

                            </div>
                            <div class="w-full my-5 flex justify-end ">
                                <button @click="formStep++"
                                    :disabled="!form.cpf || !form.fullName || !form.gender || !form.birthDate || !form.phone || !form.email || !form.address"
                                    class="btn btn-info bg-blue-500 text-white border-none ">
                                    Continuar
                                    <ArrowLongRightIcon class="w-6" />
                                </button>
                            </div>
                        </div>



                        <!-- Imagens -->
                        <div v-if="formStep === 1" class="w-full animate-fade-left animate-duration-[500ms]">
                            <h2 class="text-2xl text-gray-400 text-center">Clique ou arraste as imagens para as áreas
                                abaixo</h2>


                            <form action="" class="w-full p-4 my-5">
                                <div class="w-full flex flex-col md:flex-row justify-center gap-4">
                                    <div class="file-upload">
                                        <label class="file-upload-label">
                                            <input type="file" required name="selfie">
                                            <!-- <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" ...></svg> -->
                                            <img src="@/Images/selfie.png" class="w-40">
                                            <!-- ícone de upload -->
                                            <p>Anexe uma <b>selfie de seu rosto</b> com uma boa iluminação</p>
                                            <p>Você pode tirar uma foto agora ou fazer upload da sua galeria.</p>
                                            <small>JPG, PNG, JPEG</small>
                                        </label>
                                    </div>
                                    <div class="file-upload">
                                        <label class="file-upload-label">
                                            <input type="file" required name="rg">
                                            <img src="@/Images/rg.jpg" class="w-40 mb-3">
                                            <p>Documento de identificação</p>
                                            <p>Certifique-se de que as informações estarão nítidas na imagem.</p>
                                            <small>JPG, PNG, JPEG</small>
                                        </label>
                                    </div>
                                </div>

                                <div class="w-full my-5 flex justify-end gap-2 ">
                                    <button @click="formStep = 0" class="btn  border-none"
                                        style="text-decoration: none;">
                                        <ArrowLeftIcon class="w-6" />
                                        Voltar
                                    </button>
                                    <button class="btn btn-info bg-blue-500 text-white border-none">
                                        Finalizar tudo e enviar
                                        <ArrowUpTrayIcon class="w-6" />
                                    </button>
                                </div>
                            </form>
                        </div>


                        <div class="w-full border-dashed text-blue-500 bg-blue-50 p-4 mt-16 rounded-lg">

                            <span class="flex text-blue-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                                <b>Atenção</b> </span>
                            <hr class="my-2 border-blue-100">
                            As informações aqui submetidas,
                            <b>não serão
                                usadas</b> pra
                            quaisquer
                            análises de
                            crédito em bancos terceiros. Portanto não comprometerá seu score ou demais meios de análise
                            de
                            crédito. Os dados servem apenas para fins de controle interno em nosso sistema.
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped lang="scss">
.file-upload {
    @apply relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500;
    text-align: center;
    display: block;
    padding: 20px;
    border: 2px dashed gray;

    &:hover {
        border: 2px solid rgb(2, 52, 218);
    }

    input[type='file'] {
        @apply absolute w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md;
        left: 0;
        top: 0;

        &:focus {
            @apply outline-none ring-0;
        }
    }

    .file-upload-label {
        @apply flex flex-col items-center justify-center h-full;

        p {
            @apply text-sm text-gray-500;
        }
    }
}
</style>