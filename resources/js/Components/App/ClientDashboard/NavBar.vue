<template>
    <nav class="bg-white border-b border-gray-100">
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

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.name }}
                                    </button>
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
                            <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label>
                        </div>
                        <div class="drawer-side">
                            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                                <!-- Sidebar content here -->
                                <li><a>Sidebar Item 1</a></li>
                                <li><a>Sidebar Item 2</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </nav>
</template>