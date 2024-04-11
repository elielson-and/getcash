<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Backgroundheader from "../../Components/Svg/Backgroundheader.vue";
import HomeCard from '../../Components/App/ClientDashboard/HomeCard.vue';
import { ArrowPathRoundedSquareIcon, ShareIcon } from '@heroicons/vue/24/outline';
import { ref } from "vue";
import axios from 'axios';
import { onMounted } from "vue";


const wallet = ref([]);
const isLoading = ref(false);

async function getWallet() {
    isLoading.value = true

    await axios.get('/get-wallet')
        .then((response) => {
            setTimeout(() => {

                wallet.value = response.data;
                isLoading.value = false
            }, 1000);
        });
}

onMounted(() => {
    getWallet();
    // setInterval(getWallet, 3000);
});

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <!-- <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ChatBubbleBottomCenterIcon class="w-6 mr-2" />
                    Início
                </div>
            </div> -->

            <div class="w-full h-60 relative">

                <Backgroundheader class="w-full h-full absolute top-0 left-0 z-0" />
                <div class="w-full h-full absolute top-0 left-0 z-10 p-4 text-white">
                    <!-- nav header -->
                    <nav class="w-full flex justify-between ">
                        <div class="flex items-center gap-4">
                            <div class="avatar">
                                <div class="w-14 rounded-full">
                                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-0">
                                <!-- {{ $page.props.auth.user.name }} -->
                                <h2> Boa tarde, Elielson!</h2>
                                <small>{{ $page.props.auth.user.email }}</small>
                            </div>
                        </div>

                        <div class="flex flex-row gap-4">
                            <!-- <ShareIcon class="w-7" /> -->
                            <div class="tooltip tooltip-bottom" data-tip="Atualizar">
                                <button @click="getWallet()" class="p-4">
                                    <ArrowPathRoundedSquareIcon class="w-8" />
                                </button>
                            </div>
                        </div>
                    </nav>

                </div>

                <div class="w-full absolute -bottom-20 z-20 flex flex-row justify-between gap-4 p-4 ">
                    <HomeCard class="relative" CardName="balance" :Balance="wallet.balance" :IsLoading="isLoading" />
                    <HomeCard class="relative" CardName="score" :Score="wallet.score" :IsLoading="isLoading" />
                    <HomeCard class="relative" CardName="other" :IsLoading="isLoading" />
                </div>


            </div>

        </div>
    </AuthenticatedLayout>
</template>
