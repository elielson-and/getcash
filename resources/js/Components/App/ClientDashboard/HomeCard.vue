<script setup>
import { BanknotesIcon, ChartBarIcon, CheckBadgeIcon, ExclamationCircleIcon, ClockIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';
const props = defineProps({
    CardName: String,
    Balance: Number,
    Score: Number,
    IsLoading: Boolean,
    Documentation: Object
});

const formattedBalance = computed(() => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(props.Balance);
});


</script>

<template>
    <div v-bind="$attrs" v-if="CardName === 'balance'"
        class="w-full  h-32 bg-white shadow-xl rounded-lg p-4 flex gap-5 items-center">



        <div class="p-3 md:p-5 bg-green-100 rounded-xl flex justify-center items-center">
            <BanknotesIcon class=" w-10 text-green-400" />
        </div>

        <div class="flex flex-col">
            <p class="text-sm md:text-md">Disponível para saque:</p>
            <div v-if="IsLoading" class="skeleton w-full h-6 rounded-sm"></div>
            <h3 v-else class="text-xl md:text-2xl font-bold ">{{ formattedBalance }}</h3>

            <small class="text-gray-400 hidden md:block">*Sujeito à aprovação</small>
        </div>
    </div>

    <div v-bind="$attrs" v-if="CardName === 'score'"
        class="w-full h-32 bg-white shadow-xl rounded-lg p-4 flex gap-5 items-center">
        <div class="p-5 bg-yellow-100 rounded-xl flex justify-center items-center">
            <ChartBarIcon class="w-8 text-yellow-400" />
        </div>

        <div class="flex flex-col">
            <p class="md:hidden text-xl">Score</p>
            <p class="hidden md:block">Score GetCash</p>
            <div v-if="IsLoading" class="skeleton w-full h-6 rounded-sm"></div>
            <h3 v-else class="text-2xl font-bold ">{{ Score }}</h3>
            <small class="text-gray-400">0 - 1000</small>
        </div>
    </div>

    <div v-bind="$attrs" v-if="CardName === 'other'"
        class="hidden lg:flex w-full h-32 bg-white shadow-xl rounded-lg p-4 gap-5 items-center ">
        <div v-if="Documentation.status_id === 3" class="p-5 bg-blue-100 rounded-xl flex justify-center items-center">
            <CheckBadgeIcon class="w-10 text-blue-400" />
        </div>

        <div v-if="Documentation.status_id === 3" class="flex flex-col">
            <div v-if="IsLoading" class="skeleton w-full px-12 h-6 rounded-sm"></div>
            <div v-else>
                <h3 class="text-1xl font-bold ">Conta verificada</h3>
                <small class="text-gray-400">Todos os ducumentos foram enviados e aprovados.</small>
            </div>
        </div>

        <div v-if="Documentation.status_id === 2" class="p-5 bg-orange-100 rounded-xl flex justify-center items-center">
            <ClockIcon class="w-10 text-orange-400" />
        </div>
        <div v-if="Documentation.status_id === 2" class="flex flex-col">
            <div v-if="IsLoading" class="skeleton w-full px-12 h-6 rounded-sm"></div>
            <h3 v-else class="text-1xl font-bold ">Documentação em análise</h3>
        </div>

        <div v-if="Documentation.status_id === 1 || Documentation.status_id === 4 || !Documentation.status_id"
            class="p-5 bg-red-100 rounded-xl flex justify-center items-center">
            <ExclamationCircleIcon class="w-10 text-red-400" />
        </div>
        <div v-if="Documentation.status_id === 1 || Documentation.status_id === 4 || !Documentation.status_id"
            class="flex flex-col">
            <div v-if="IsLoading" class="skeleton w-full px-12 h-6 rounded-sm"></div>
            <div v-else>
                <h3 class="text-1xl font-bold ">Documentação pendente</h3>
                <small class="text-gray-400">Envie sua documentação</small>
            </div>
        </div>


    </div>
</template>
