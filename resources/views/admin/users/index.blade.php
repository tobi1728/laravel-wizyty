<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Użytkownicy kliniki') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-2">
                {{ $usersSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 rounded-lg bg-white shadow px-6 py-4 flex flex-wrap items-center justify-between">

                {{-- WYSZUKIWANIE --}}
                <div class="flex flex-col">
                    <label for="search" class="text-sm font-medium text-gray-700">Szukaj po imieniu lub nazwisku</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 w-56 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                        placeholder="Imię lub nazwisko">
                </div>

                {{-- SORTOWANIE --}}
                <div class="flex flex-col">
                    <label for="sort_by" class="text-sm font-medium text-gray-700">Sortuj według</label>
                    <select name="sort" id="sort"
                            class="mt-1 w-80 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        <option value="created_at|desc" {{ request('sort') === 'created_at|desc' ? 'selected' : '' }}>Data utworzenia (najnowsze)</option>
                        <option value="created_at|asc" {{ request('sort') === 'created_at|asc' ? 'selected' : '' }}>Data utworzenia (najstarsze)</option>
                        <option value="firstName|asc" {{ request('sort') === 'firstName|asc' ? 'selected' : '' }}>Imię (A-Z)</option>
                        <option value="firstName|desc" {{ request('sort') === 'firstName|desc' ? 'selected' : '' }}>Imię (Z-A)</option>
                        <option value="lastName|asc" {{ request('sort') === 'lastName|asc' ? 'selected' : '' }}>Nazwisko (A-Z)</option>
                        <option value="lastName|desc" {{ request('sort') === 'lastName|desc' ? 'selected' : '' }}>Nazwisko (Z-A)</option>
                    </select>
                </div>

                {{-- FILTR ROLI --}}
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Rola</label>
                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="doctor" {{ request('role') == 'doctor' ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500 border-gray-300">
                            <span class="ml-2">Doktor</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="patient" {{ request('role') == 'patient' ? 'checked' : '' }}
                                class="text-yellow-600 focus:ring-yellow-500 border-gray-300">
                            <span class="ml-2">Pacjent</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="admin" {{ request('role') == 'admin' ? 'checked' : '' }}
                                class="text-red-600 focus:ring-red-500 border-gray-300">
                            <span class="ml-2">Admin</span>
                        </label>
                    </div>
                </div>

                {{-- PRZYCISKI --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700">
                        Zastosuj
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-md shadow-sm hover:bg-gray-300">
                        Resetuj
                    </a>
                </div>

            </form>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2">Imię</th>
                            <th class="px-4 py-2">Nazwisko</th>
                            <th class="px-4 py-2">Adres e-mail</th>
                            <th class="px-4 py-2">Rola</th>
                            <th class="px-4 py-2">Data rejestracji</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($allUsers as $user)
                            <tr>
                                <td class="px-4 py-2">{{ $user->firstName }}</td>
                                <td class="px-4 py-2">{{ $user->lastName }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    <x-user-role :role="$user->role" />
                                </td>
                                <td class="px-4 py-2">{{ $user->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Nie ma żadnych użytkowników do wyświetlenia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $allUsers->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>