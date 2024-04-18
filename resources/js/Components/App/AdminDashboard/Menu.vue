<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { ChartBarIcon, ClockIcon, ArrowsRightLeftIcon,Cog6ToothIcon } from '@heroicons/vue/24/outline';
import { useMainStore } from '@/stores/mainStore'

const { url } = usePage();

</script>

<template>
    <div class="w-1/2 md:w-full p-4 relative z-50" style="z-index: 10 !important;">

        <p class="text-center bg-yellow-300 md:hidden px-1 text-xs rounded-md">Administrador</p>
        <ul class="menu  menu-md w-full gap-1 rounded-box mt-4">
            <li>
                <Link :href="route('dashboard')" :class="{ 'bg-gray-200': url === '/painel-do-cliente' }">
                <ChartBarIcon class="w-6"/>
                Dashboard
                </Link>
            </li>

            <li>
                <Link :href="route('admin.management')" :class="{ 'bg-gray-200': url === '/termos-de-uso' }">
                <Cog6ToothIcon class="w-6"/>

                Gerenciamento
                </Link>
            </li>


            <li>
                <Link :href="route('admin.profile.edit')" :class="{ 'bg-gray-200': url === '/perfil' }">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                    Meu perfil
                </Link>
            </li>

            <div class="divider my-0"></div>
            <li>
                <Link :href="route('logout')" method="post" as="button" class="text-red-500 hover:bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
                Encerrar sessão</Link>
            </li>
        </ul>
    </div>

</template>
