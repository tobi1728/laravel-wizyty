<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Baza leków') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-2">
                {{ $medicinesSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.data.medicines') }}" class="mb-6 rounded-lg bg-white shadow px-6 py-4 flex flex-wrap items-center justify-between">

                {{-- WYSZUKIWANIE --}}
                <div class="flex flex-col">
                    <label for="search" class="text-sm font-medium text-gray-700">Szukaj</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 w-56 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                        placeholder="Nazwa, opis, typ...">
                </div>

                {{-- SORTOWANIE --}}
                <div class="flex flex-col">
                    <label for="sort_by" class="text-sm font-medium text-gray-700">Sortuj według</label>
                    <select name="sort" id="sort"
                            class="mt-1 w-80 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        <option value="medicine_name|asc" {{ request('sort') === 'medicine_name|asc' ? 'selected' : '' }}>Nazwa (A-Z)</option>
                        <option value="medicine_name|desc" {{ request('sort') === 'medicine_name|desc' ? 'selected' : '' }}>Nazwa (Z-A)</option>
                        <option value="medicine_form|asc" {{ request('sort') === 'medicine_form|asc' ? 'selected' : '' }}>Forma (A-Z)</option>
                        <option value="medicine_form|desc" {{ request('sort') === 'medicine_form|desc' ? 'selected' : '' }}>Forma (Z-A)</option>
                        <option value="medicine_producer|asc" {{ request('sort') === 'medicine_producer|asc' ? 'selected' : '' }}>Producent (A-Z)</option>
                        <option value="medicine_producer|desc" {{ request('sort') === 'medicine_producer|desc' ? 'selected' : '' }}>Producent (Z-A)</option>
                    </select>
                </div>

                {{-- PRZYCISKI --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700">
                        Zastosuj
                    </button>

                    <a href="{{ route('admin.data.medicines') }}"
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

                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.data.addMedicine') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-md shadow-sm hover:bg-gray-300">
                        <i class="fa-solid fa-plus mr-2"></i> Dodaj nowy lek
                    </a>
                </div>

                <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2">Nazwa</th>
                            <th class="px-4 py-2">Forma</th>
                            <th class="px-4 py-2">Substancja aktywna</th>
                            <th class="px-4 py-2">Kategoria</th>
                            <th class="px-4 py-2">Producent</th>
                            <th class="px-4 py-2">Opis</th>
                            <th class="px-4 py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($allMedicines as $medicine)
                            <tr>
                                <td class="px-4 py-2">{{ $medicine->medicine_name }}</td>
                                <td class="px-4 py-2">{{ $medicine->medicine_form }}</td>
                                <td class="px-4 py-2">{{ $medicine->active_substance }}</td>
                                <td class="px-4 py-2">{{ $medicine->medicine_category }}</td>
                                <td class="px-4 py-2">{{ $medicine->medicine_producer }}</td>
                                <td class="px-4 py-2">{{ $medicine->medicine_description }}</td>
                                <td class="px-4 py-2 text-center flex justify-center gap-4">
                                    {{-- Edytuj --}}
                                    <a href="{{ route('admin.data.editMedicine', $medicine->id) }}" class="text-yellow-500 hover:text-yellow-600" title="Edytuj">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>




                                    {{-- Usuń --}}
                                    <form action="{{ route('admin.data.medicines.delete', $medicine->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć lek z bazy?');">
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
                    {{ $allMedicines->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>