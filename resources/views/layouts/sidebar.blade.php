<!-- resources/views/layouts/sidebar.blade.php -->
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md border-r hidden sm:block">
        <div class="px-6 py-4 text-indigo-600 font-bold text-xl border-b">
            <span class="inline-block">Your<span class="text-blue-500">Cure</span></span>
        </div>

        <nav class="px-4 py-6 space-y-2 text-gray-800 text-sm">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fas fa-home mr-2"></i> Dashboard
            </x-nav-link>

            @php $role = Auth::user()->role; @endphp

            @if ($role === 'patient')
                <x-nav-link href="#">
                    <i class="fas fa-calendar-check mr-2"></i> Wizyty
                </x-nav-link>
                <x-nav-link href="#">
                    <i class="fas fa-prescription-bottle-alt mr-2"></i> Recepty
                </x-nav-link>
                <x-nav-link href="#">
                    <i class="fas fa-file-medical mr-2"></i> Skierowania
                </x-nav-link>
                <x-nav-link :href="route('patient.profile')">
                    <i class="fas fa-user mr-2"></i> Profil
                </x-nav-link>
            @elseif ($role === 'doctor')
                <x-nav-link href="#">
                    <i class="fas fa-clock mr-2"></i> Godziny pracy
                </x-nav-link>
                <x-nav-link href="#">
                    <i class="fas fa-users mr-2"></i> Wizyty pacjentów
                </x-nav-link>
                <x-nav-link :href="route('doctor.profile')">
                    <i class="fas fa-user-md mr-2"></i> Profil
                </x-nav-link>
            @elseif ($role === 'admin')
                <x-nav-link href="#">
                    <i class="fas fa-users-cog mr-2"></i> Użytkownicy
                </x-nav-link>
                <x-nav-link href="#">
                    <i class="fas fa-cogs mr-2"></i> Ustawienia systemu
                </x-nav-link>
                <x-nav-link :href="route('admin.profile')">
                    <i class="fas fa-user-shield mr-2"></i> Profil
                </x-nav-link>
            @endif

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded hover:bg-red-100 text-red-600 font-semibold">
                    <i class="fas fa-sign-out-alt mr-2"></i> Wyloguj się
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar (collapsible button on small screens) -->
        <header class="bg-white shadow p-4 flex items-center justify-between sm:hidden">
            <div class="text-xl font-semibold text-gray-800">YourCure</div>
            <button onclick="document.querySelector('aside').classList.toggle('hidden')"
                    class="p-2 rounded bg-gray-200">
                <i class="fas fa-bars"></i>
            </button>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
    @yield('content')
        </main>
    </div>
</div>

<!-- Font Awesome CDN (you may move this to app layout head section if needed) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
