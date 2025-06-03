<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grafik lekarzy') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-2">
                {{ $schedulesSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.data.schedules') }}" class="mb-6 rounded-lg bg-white shadow px-6 py-4 flex flex-wrap items-center justify-between">

                {{-- WYSZUKIWANIE --}}
                <div class="flex flex-col">
                    <label for="search" class="text-sm font-medium text-gray-700">Szukaj</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 w-56 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                        placeholder="Doktor">
                </div>

                {{-- SORTOWANIE --}}
                <div class="flex flex-col">
                    <label for="sort_by" class="text-sm font-medium text-gray-700">Sortuj według</label>
                    <select name="sort" id="sort"
                            class="mt-1 w-80 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        <option value="dateStart|asc" {{ request('sort') === 'dateStart|asc' ? 'selected' : '' }}>Data początkowa (najbliższe)</option>
                        <option value="dateStart|desc" {{ request('sort') === 'dateStart|desc' ? 'selected' : '' }}>Data początkowa (najdalsze)</option>
                        <option value="dateEnd|asc" {{ request('sort') === 'dateEnd|asc' ? 'selected' : '' }}>Data końcowa (najbliższe)</option>
                        <option value="dateEnd|desc" {{ request('sort') === 'dateEnd|desc' ? 'selected' : '' }}>Data końcowa (najdalsze)</option>
                    </select>
                </div>

                {{-- PRZYCISKI --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700">
                        Zastosuj
                    </button>

                    <a href="{{ route('admin.data.schedules') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-md shadow-sm hover:bg-gray-300">
                        Resetuj
                    </a>
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
                            <th class="px-4 py-2">Lekarz</th>
                            <th class="px-4 py-2">Data początkowa</th>
                            <th class="px-4 py-2">Data końcowa</th>
                            <th class="px-4 py-2">Godzina początkowa</th>
                            <th class="px-4 py-2">Godzina końcowa</th>
                            <th class="px-4 py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($allSchedules as $schedule)
                            <tr>
                                <td class="px-4 py-2">{{ $schedule->doctor->user->firstName }} {{ $schedule->doctor->user->lastName }}</td>
                                <td class="px-4 py-2">{{ $schedule->dateStart }}</td>
                                <td class="px-4 py-2">{{ $schedule->dateEnd }}</td>
                                <td class="px-4 py-2">{{ $schedule->timeStart }}</td>
                                <td class="px-4 py-2">{{ $schedule->timeEnd }}</td>
                                <td class="px-4 py-2 text-center flex justify-center gap-4">
                                    {{-- Usuń --}}
                                    <form action="{{ route('admin.data.schedules.delete', $schedule->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć grafik lekarza?');">
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
                    {{ $allSchedules->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>