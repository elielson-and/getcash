<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ChatBubbleBottomCenterIcon class="w-6 mr-2" />
                    Início
                </div>
            </div>

            <div class="w-full p-4">


            </div>

        </div>
    </AuthenticatedLayout>
</template>
