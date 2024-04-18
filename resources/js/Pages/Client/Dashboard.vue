<script setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import Sidebar from '@/Components/App/Sidebar.vue'
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';


</script>

<template>

    <Head title="Dashboard" />

    <AdminAuthenticatedLayout>
        <div class="pt-2">
            <div class="max-w-7xl flex gap-2 mx-auto sm:px-6 lg:px-8">
                <Sidebar class="bg-white w-80 overflow-hidden shadow-sm sm:rounded-lg" />

                <div class="bg-white w-full h-screen overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    {{ $page.props.auth.user.name }}
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
