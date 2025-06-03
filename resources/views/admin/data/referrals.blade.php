<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skierowania') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-2">
                {{ $referralsSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('admin.data.referrals') }}" class="mb-6 rounded-lg bg-white shadow px-6 py-4 flex flex-wrap items-center justify-between">

                {{-- WYSZUKIWANIE --}}
                <div class="flex flex-col">
                    <label for="search" class="text-sm font-medium text-gray-700">Szukaj</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 w-56 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                        placeholder="Pacjent, lekarz, specjalizacja">
                </div>

                {{-- SORTOWANIE --}}
                <div class="flex flex-col">
                    <label for="sort_by" class="text-sm font-medium text-gray-700">Sortuj według</label>
                    <select name="sort" id="sort"
                            class="mt-1 w-80 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        <option value="isseu_date|desc" {{ request('sort') === 'isseu_date|desc' ? 'selected' : '' }}>Data wystawienia (najnowsze)</option>
                        <option value="isseu_date|asc" {{ request('sort') === 'isseu_date|asc' ? 'selected' : '' }}>Data wystawienia (najstarsze)</option>
                    </select>
                </div>

                {{-- PRZYCISKI --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-blue-700">
                        Zastosuj
                    </button>

                    <a href="{{ route('admin.data.referrals') }}"
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
                            <th class="px-4 py-2">Data</th>
                            <th class="px-4 py-2">Pacjent</th>
                            <th class="px-4 py-2">Lekarz</th>
                            <th class="px-4 py-2">Kod</th>
                            <th class="px-4 py-2">Specjalizacja docelowa</th>
                            <th class="px-4 py-2">Powód</th>
                            <th class="px-4 py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($allReferrals as $referral)
                            <tr>
                                <td class="px-4 py-2">{{ $referral->issue_date }}</td>
                                <td class="px-4 py-2">
                                    {{ $referral->appointment->patient?->user->firstName ?? '—' }}
                                    {{ $referral->appointment->patient?->user->lastName ?? '' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $referral->appointment->doctor?->user->firstName ?? '—' }}
                                    {{ $referral->appointment->doctor?->user->lastName ?? '' }}
                                </td>
                                <td class="px-4 py-2">{{ $referral->refferal_code }}</td>
                                <td class="px-4 py-2">{{ $referral->target_specialization }}</td>
                                <td class="px-4 py-2">{{ $referral->reason }}</td>
                                <td class="px-4 py-2 text-center flex justify-center gap-4">
                                    {{-- Edytuj --}}
                                    <a href="{{ route('admin.data.referrals.edit', $referral->id) }}" class="text-yellow-500 hover:text-yellow-600" title="Edytuj">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Usuń --}}
                                    <form action="{{ route('admin.data.referrals.delete', $referral->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć skierowanie z bazy?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600" title="Usuń">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                    {{-- PDF --}}
                                    <a href="{{ route('admin.data.referrals.pdf', $referral->id) }}" target="_blank" class="text-green-600 hover:text-green-700" title="Eksportuj PDF">
                                        <i class="fa-solid fa-file"></i>
                                    </a>
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
                    {{ $allReferrals->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>