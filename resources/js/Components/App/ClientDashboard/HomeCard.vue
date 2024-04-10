<script setup>
import { BanknotesIcon, ChartBarIcon, CheckBadgeIcon } from '@heroicons/vue/24/outline';
defineProps({
    CardName: String,
})

</script>

<template>
    <div v-if="CardName == 'balance'" class="w-full  h-32 bg-white shadow-xl rounded-lg p-4 flex gap-5 items-center">
        <div class="p-3 md:p-5 bg-green-100 rounded-xl flex justify-center items-center">
            <BanknotesIcon class=" w-10 text-green-400" />
        </div>

        <div class="flex flex-col">
            <p class="text-sm md:text-md">Saldo disponível:</p>
            <h3 class="text-xl md:text-2xl font-bold ">R$: 765,00</h3>
            <small class="text-gray-400 hidden md:block">Saldo disponível para saque.</small>
        </div>
    </div>

    <div v-if="CardName == 'score'" class="w-full h-32 bg-white shadow-xl rounded-lg p-4 flex gap-5 items-center">
        <div class="p-5 bg-yellow-100 rounded-xl flex justify-center items-center">
            <ChartBarIcon class="w-8 text-yellow-400" />
        </div>

        <div class="flex flex-col">
            <p class="md:hidden text-xl">Score</p>
            <p class="hidden md:block">Score GetCash</p>
            <h3 class="text-2xl font-bold ">650</h3>
            <small class="text-gray-400">0 - 1000</small>
        </div>
    </div>

    <div v-if="CardName == 'other'"
        class="hidden lg:flex w-full h-32 bg-white shadow-xl rounded-lg p-4 gap-5 items-center ">
        <div class="p-5 bg-blue-100 rounded-xl flex justify-center items-center">
            <CheckBadgeIcon class="w-10 text-blue-400" />
        </div>

        <div class="flex flex-col">
            <h3 class="text-1xl font-bold ">Conta verificada</h3>
            <small class="text-gray-400">verificada em 18/04/2024</small>
        </div>
    </div>
</template>