<script setup>
import ClientMenu from '@/Components/App/ClientDashboard/Menu.vue';
import AdminMenu from '@/Components/App/AdminDashboard/Menu.vue';
</script>
<template>
    <div class="h-[90vh]">
        <AdminMenu v-if="$page.props.auth.user.admin"/>
        <ClientMenu v-else />
    </div>
</template>
