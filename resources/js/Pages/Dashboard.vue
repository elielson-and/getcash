<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const username = 'elielson_and'; // Substitua pelo username dinâmico
const imageUrl = ref(null);

async function fetchImage() {
    const url = `https://www.instagram.com/${username}/?__a=1`;
    try {
        const response = await fetch(url);
        const data = await response.json();
        imageUrl.value = data.graphql.user.profile_pic_url_hd;
    } catch (error) {
        console.error('Erro ao buscar imagem:', error);
    }
}

fetchImage();
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    {{ $page.props.auth.user.admin }}


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
