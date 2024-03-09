<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">

        <div class="w-full max-w-4xl mt-6 px-10 py-4  bg-white sm:shadow-lg overflow-hidden sm:rounded-lg ">
            <slot />
        </div>
    </div>
</template>
