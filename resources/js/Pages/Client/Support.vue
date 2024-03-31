<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { ChatBubbleBottomCenterIcon, ArrowRightIcon } from "@heroicons/vue/24/outline";



</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full border-b-2 p-4 mb-4">
                <div class="text-2xl text-gray-900 flex items-center">
                    <ChatBubbleBottomCenterIcon class="w-6 mr-2" />
                    Suporte e dúvidas
                </div>
            </div>

            <div class="w-full p-4">

                <div class="w-full text-center">
                    <h2 class="text-xl text-gray-500 mb-4">Precisa tirar uma dúvida ou obter suporte com algo? Estamos
                        prontos para te
                        atender. Entre
                        em
                        contato com nossa equipe via
                        WhatsApp!</h2>
                    <a href="https://wa.me/559887714291?text=Olá!%20vim%20pelo%20site." target="_blank"
                        class="p-4 btn btn-success text-white">Abrir no whatsapp
                        <ArrowRightIcon class="w-4" />
                    </a>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
