<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left -->
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/yourcure-logo.svg') }}" alt="Logo" class="h-9 w-auto">
                </a>

                <!-- Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Strona główna') }}
                    </x-nav-link>

                    @php $role = Auth::user()->role; @endphp

                    @if ($role === 'patient')

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Wizyty</x-nav-link>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="{{ route('patient.appointments.make') }}">
                                    Umów wizytę
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('patient.appointments.next') }}">
                                    Przyszłe wizyty
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('patient.appointments.historic') }}">
                                    Historia wizyt
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>

                        <x-nav-link href="{{ route('patient.documentation.prescriptions') }}">
                            Recepty
                        </x-nav-link>

                        <x-nav-link href="{{ route('patient.documentation.referrals') }}">
                            Skierowania
                        </x-nav-link>

                    @elseif ($role === 'doctor')
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Grafik</x-nav-link>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('doctor.addschedule') }}">Ustaw grafik</x-dropdown-link>
                                <x-dropdown-link href="{{ route('doctor.schedules') }}">Zobacz grafik</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Recepty</x-nav-link>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('prescriptions.addPrescription') }}">Wystaw receptę</x-dropdown-link>
                                <x-dropdown-link href="{{ route('prescriptions.index') }}">Wystawione recepty</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Skierowania</x-nav-link>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('referrals.create') }}">Wystaw skierowanie</x-dropdown-link>
                                <x-dropdown-link href="{{ route('referrals.index') }}">Wystawione skierowania</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Wizyty</x-nav-link>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('doctor.nextappointments') }}">Nadchodzące wizyty</x-dropdown-link>
                                <x-dropdown-link href="{{ route('doctor.historicappointments') }}">Historia wizyt</x-dropdown-link>
                                <x-dropdown-link href="{{ route('doctor.freeappointments') }}">Wolne wizyty</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @elseif ($role === 'admin')
                        <x-nav-link href="{{ route('admin.users.index') }}">Użytkownicy</x-nav-link>

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <x-nav-link href="#">Zarządzanie systemem</x-nav-link>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="{{ route('admin.data.schedules') }}">
                                    Grafik lekarzy
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('admin.data.appointments') }}">
                                    Wizyty
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('admin.data.medicines') }}">
                                    Baza leków
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('admin.data.prescriptions') }}">
                                    Recepty
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('admin.data.referrals') }}">
                                    Skierowania
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>

                    @endif
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-sm border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->firstName . ' ' . Auth::user()->lastName) }}&background=4F46E5&color=fff" alt="Avatar" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @php
                            $profileRoute = match (Auth::user()->role) {
                                'admin' => route('admin.profile'),
                                'doctor' => route('doctor.profile'),
                                default => route('patient.profile'),
                            };
                        @endphp

                        <x-dropdown-link :href="$profileRoute">Profil</x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="$profileRoute">Profil</x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
