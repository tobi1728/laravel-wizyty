<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wizyty') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-2">
                {{ $appointmentsSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.data.appointments') }}" class="mb-6 rounded-lg bg-white shadow px-6 py-4 flex flex-wrap items-center justify-between">

                <div>
                    <div class="flex items-center justify-between mb-4">
                        {{-- WYSZUKIWANIE --}}
                        <div class="flex flex-col">
                            <label for="search" class="text-sm font-medium text-gray-700">Szukaj</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                class="mt-1 w-56 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                                placeholder="Pacjent, lekarz">
                        </div>

                        {{-- SORTOWANIE --}}
                        <div class="flex flex-col">
                            <label for="sort_by" class="text-sm font-medium text-gray-700">Sortuj według</label>
                            <select name="sort" id="sort"
                                    class="mt-1 w-80 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                                <option value="appointment_date|asc" {{ request('sort') === 'appointment_date|asc' ? 'selected' : '' }}>Data wizyty (najbliższe)</option>
                                <option value="appointment_date|desc" {{ request('sort') === 'appointment_date|desc' ? 'selected' : '' }}>Data wizyty (najdalsze)</option>
                            </select>
                        </div>
                    </div>

                    {{-- FILTR STATUSU --}}
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 mb-1">Status</label>
                        <div class="flex items-center gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="wolna" {{ request('status') == 'wolna' ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-2">Wolna</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="zaplanowana" {{ request('status') == 'zaplanowana' ? 'checked' : '' }}
                                    class="text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                <span class="ml-2">Zaplanowana</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="zrealizowana" {{ request('status') == 'zrealizowana' ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500 border-gray-300">
                                <span class="ml-2">Zrealizowana</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="anulowana" {{ request('status') == 'anulowana' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 border-gray-300">
                                <span class="ml-2">Anulowana</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="nieobecność" {{ request('status') == 'nieobecność' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 border-gray-300">
                                <span class="ml-2">Nieobecność</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    {{-- PRZYCISKI --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700">
                            Zastosuj
                        </button>

                        <a href="{{ route('admin.data.appointments') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-md shadow-sm hover:bg-gray-300">
                            Resetuj
                        </a>
                    </div>
                </div>

            </form>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 font-medium text-sm text-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2">Pacjent</th>
                            <th class="px-4 py-2">Lekarz</th>
                            <th class="px-4 py-2">Data wizyty</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Notatki</th>
                            <th class="px-4 py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($allAppointments as $appointment)
                            <tr>
                                <td class="px-4 py-2">
                                    {{ $appointment->patient?->user->firstName ?? '—' }}
                                    {{ $appointment->patient?->user->lastName ?? '' }}
                                </td>
                                <td class="px-4 py-2">{{ $appointment->doctor->user->firstName }} {{ $appointment->doctor->user->lastName }}</td>
                                <td class="px-4 py-2">{{ $appointment->appointment_date }}</td>
                                <td class="px-4 py-2">{{ $appointment->notes }}</td>
                                <td class="px-4 py-2">
                                    <x-appointment-status :status="$appointment->status->appointmentStatusName" />
                                </td>
                                <td class="px-4 py-2 text-center flex justify-center gap-4">
                                    {{-- Edytuj --}}
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-yellow-500 hover:text-yellow-600" title="Edytuj">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Usuń --}}
                                    <form action="{{ route('admin.data.appointments.delete', $appointment->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć wizytę?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600" title="Usuń">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Nie ma żadnych leków do wyświetlenia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $allAppointments->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>