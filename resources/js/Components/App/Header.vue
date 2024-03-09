<script setup>
import Navbar from '@/Components/App/Navbar.vue';
import HeaderBubble from '@/Components/Svg/HeaderBubble.vue';
import { Vue3Lottie } from 'vue3-lottie';

import HeroCash from '@/Lottie/HeroCash.json';
</script>

<template>
    <header class="w-full  relative">
        <div class="max-w-7xl relative mx-auto  p-2">
            <HeaderBubble class="absolute top-0 right-0 w-3/4 z-0" />

            <Navbar class="sticky z-10" />
            <div class="w-full flex mt-4">
                <div class="w-[42%] z-10">
                    <h2 class="mt-6 text-gray-600 text-5xl">Saia do aperto de forma prática, rápida e segura!</h2>
                    <p class="my-6 text-2xl text-gray-600">Não realizamos <s>consulta de crédito</s>. <br> Clique no
                        botão abaixo para conferir as ofertas e valores disponíveis agora mesmo.</p>
                    <button
                        class="w-64 bg-blue-500 hover:bg-blue-400 flex flex-row items-center py-4 px-10 text-white text-xl font-bold transition-all rounded-md">
                        Conferir ofertas
                        <div class="icon">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </button>

                </div>
                <div class="w-[58%] relative z-0 ">
                    <Vue3Lottie class="z-10 relative -top-12 -left-12" :animationData="HeroCash" :width="750"
                        :loop="true" :speed="1" />
                </div>
            </div>


        </div>
    </header>
</template>
