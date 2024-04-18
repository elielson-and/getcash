<script setup>
import { ref } from 'vue';
import Sidebar from '@/Components/App/Sidebar.vue';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/App/ClientDashboard/NavBar.vue';
import AdminMenu from '@/Components/App/AdminDashboard/Menu.vue';
import { Bars3BottomRightIcon } from '@heroicons/vue/24/outline';



const showingNavigationDropdown = ref(false);

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-200">

            <!-- <Navbar  /> -->
            <nav class="bg-white border-b border-gray-100 z-50 sticky top-0  ">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>


                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md ">
                                            <div class="my-2 mr-4 px-2 bg-yellow-300 rounded-md">Administrador</div>
                                            <div
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}
                                            </div>
                                        </span>
                                    </template>


                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <div class="drawer">
                                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                                <div class="drawer-content">
                                    <!-- Page content here -->
                                    <label for="my-drawer" class="p-12 cursor-pointer">
                                        <Bars3BottomRightIcon class="w-9" />
                                    </label>
                                </div>
                                <div class="drawer-side ">
                                    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                                    <AdminMenu class="h-screen bg-white" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </nav>


            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl min-h-[calc(100vh-10vh)] flex gap-2 mx-auto sm:px-6 lg:px-8 p-2">
                <Sidebar
                    class="hidden md:block bg-white w-80 overflow-hidden shadow-sm sm:rounded-lg sticky top-[7.5vh]" />

                <slot />
            </main>
        </div>
    </div>
</template>
