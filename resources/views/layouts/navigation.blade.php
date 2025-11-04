<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800 text-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-pink-500" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-gray-300 hover:text-pink-400 border-b-2 border-transparent hover:border-pink-400 {{ request()->routeIs('dashboard') ? 'text-pink-500 border-pink-500 font-semibold' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')"
                        class="text-gray-300 hover:text-pink-400 border-b-2 border-transparent hover:border-pink-400 {{ request()->routeIs('events.index') ? 'text-pink-500 border-pink-500 font-semibold' : '' }}">
                        {{ __('View All Events') }}
                    </x-nav-link>

                    <!-- create link only appears for admin users -->
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                                {{ __('Create New Event') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-gray-700 text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-gray-100 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-500/40 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="text-gray-200 hover:bg-gray-800 hover:text-pink-400">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    class="text-gray-200 hover:bg-gray-800 hover:text-pink-400"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-pink-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/40 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900 border-t border-gray-800">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400 {{ request()->routeIs('dashboard') ? 'text-pink-500 border-pink-500 font-semibold bg-gray-800' : '' }}">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')"
                    class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400 {{ request()->routeIs('events.index') ? 'text-pink-500 border-pink-500 font-semibold bg-gray-800' : '' }}">
                    {{ __('View All Events') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')"
                    class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400 {{ request()->routeIs('events.create') ? 'text-pink-500 border-pink-500 font-semibold bg-gray-800' : '' }}">
                    {{ __('Add Event') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('events.admin')" :active="request()->routeIs('events.admin')"
                    class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400 {{ request()->routeIs('events.admin') ? 'text-pink-500 border-pink-500 font-semibold bg-gray-800' : '' }}">
                    {{ __('Admin') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-pink-400 hover:bg-gray-800 hover:border-pink-400"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>