<script setup>
import { UserCircleIcon } from '@heroicons/vue/24/solid'


</script>

<template>
    <div class="h-16 w-full bg-transparent flex items-center justify-between">
        <img src="@/Images/logo.png" class="w-36">
        <div class="text-white w-full hidden md:flex">
            <div class=" flex items-center">
                <ul class="ml-10 flex gap-4 text-gray-700 font-bold group">
                    <li><a href="#" class="hover:text-blue-500 ">Home</a></li>
                    <li><a href="#" class="hover:text-blue-500 ">Serviços</a></li>
                    <li><a href="#" class="hover:text-blue-500 ">Como funciona</a></li>
                    <li><a href="#" class="hover:text-blue-500 ">Dúvidas</a></li>
                </ul>
            </div>
        </div>

        <div v-if="false" class="flex items-center h-full hover:bg-blue-400 p-2 mr-4 rounded-md cursor-pointer">
            <!-- auth user -->
            <p class="text-nowrap mr-2 text-white">Usuario logado</p>
            <div class="avatar">
                <div class="w-10 h-10 rounded-full">
                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>
            </div>
        </div>

        <!-- no auth user -->

        <button
            class="btn bg-transparent h-11 px-8 mr-4 hover:bg-teal-400 flex items-center font-bold rounded-full border-2 hover:border-transparent text-white transition-all">
            <UserCircleIcon class="w-6" />Já sou cliente
        </button>
    </div>
</template>