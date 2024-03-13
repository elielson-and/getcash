<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="w-full p-4">
        <button class="btn w-full btn-success  text-white">+ Solicitar valor</button>
        <ul class="menu  menu-md w-full gap-1 rounded-box">
            <li><a>Meu perfil</a></li>
            <li>
                <Link :href="route('documentacao')">Documentação</Link>
            </li>
            <li><a>Minhas solicitações</a></li>
            <li><a>Termos</a></li>
            <div class="divider my-0"></div>
            <li><a class="text-red-500 hover:bg-red-100">Logout</a></li>
        </ul>
    </div>

</template>