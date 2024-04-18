<script setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import {ChatBubbleBottomCenterIcon}  from '@heroicons/vue/24/outline';
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

</script>

<template>

    <Head title="Dashboard" />

    <AdminAuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ChatBubbleBottomCenterIcon class="w-6 mr-2" />
                    Termos de uso
                </div>
            </div>

            <div class="w-full p-4">
                // Termosss

            </div>

        </div>
    </AdminAuthenticatedLayout>
</template>
