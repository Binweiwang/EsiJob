<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 bg-sky-100 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('storage/logo/logo.png') }}" class="block h-9 w-auto" alt="ESijob Logo"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="font-semibold">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    @if(Auth::check())
                    <x-nav-link :href="route('jobs.create')" :active="request()->routeIs('jobs.create')" class="font-semibold">
                        {{ __('Publicar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.jobs')" :active="request()->routeIs('jobs.index')" class="font-semibold">
                        {{ __('Mis Ofertas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('recargar')" :active="request()->routeIs('credits')" class="font-semibold">
                        {{ __('Recargar') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="font-semibold">
                        {{ __('Contactar') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings and Cart -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('carrito.index') }}" class="text-gray-500 hover:text-gray-700 relative">
                    <i class="fas fa-shopping-cart fa-2x text-md"></i>
                </a>
                @if(Auth::guest())
                <div class="ms-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-800">Login</a>
                    <a href="{{ route('register') }}"
                       class="ms-4 text-sm text-indigo-600">Registrar</a>
                </div>
                @else
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex bg-sky-100 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @php
                            $avatarUrl = Storage::exists('public/' . Auth::user()->avatar_url) ? 'storage/' . Auth::user()->avatar_url : 'storage/avatars/default-avatar.jpg';
                            @endphp

                            <img src="{{ asset($avatarUrl) }}" alt="{{ Auth::user()->name }}" class="h-14 w-14 rounded-full object-cover">
                            <div class="ms-2"> <!-- Adjusted margin for better spacing -->
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jobs.create')" :active="request()->routeIs('jobs.create')">
                {{ __('Publicar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.jobs')" :active="request()->routeIs('jobs.index')">
                {{ __('Mis Ofertas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('checkout')" :active="request()->routeIs('checkout')">
                {{ __('Checkout') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contactar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('credits')" :active="request()->routeIs('credits')">
                {{ __('Recargar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('carrito.index')" :active="request()->routeIs('cart.index')">
                {{ __('Carrito') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if(Auth::guest())
            <div class="px-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-800">Login</a>
                <a href="{{ route('register') }}"
                   class="ms-4 text-sm text-indigo-600">Registrar</a>
            </div>
            @else
            <div class="px-4 flex items-center">
                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                     class="h-12 w-12 rounded-full object-cover"> <!-- Changed size to h-12 w-12 -->
                <div class="ms-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endif
        </div>
    </div>
</nav>
