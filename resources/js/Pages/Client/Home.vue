<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Backgroundheader from "../../Components/Svg/Backgroundheader.vue";
import HomeCard from '../../Components/App/ClientDashboard/HomeCard.vue';
import { ref } from "vue";

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
                                <h2> Boa tarde, Mariana!</h2>
                                <small>{{ $page.props.auth.user.email }}</small>
                            </div>
                        </div>

                        <div class="flex flex-col items-end">
                            <p>Saldo:</p>
                            <h2 class="text-xl font-bold">R$:10,00</h2>
                        </div>
                    </nav>

                </div>

                <div class="w-full absolute -bottom-20 z-20 flex flex-row justify-between gap-4 p-4 ">
                    <HomeCard class="relative" CardName="balance" />
                    <HomeCard class="relative" CardName="score" />
                    <HomeCard class="relative" CardName="other" />
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
