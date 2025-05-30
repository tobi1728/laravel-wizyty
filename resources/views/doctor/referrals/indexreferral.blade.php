<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Wystawione skierowania') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($referrals->isEmpty())
                    <p class="text-gray-600">Brak wystawionych skierowań.</p>
                @else
                    <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2">Data</th>
                                <th class="px-4 py-2">Pacjent</th>
                                <th class="px-4 py-2">Specjalizacja docelowa</th>
                                <th class="px-4 py-2">Kod</th>
                                <th class="px-4 py-2">Powód</th>
                                <th class="px-4 py-2 text-center">Akcje</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($referrals as $referral)
                                <tr>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($referral->issue_date)->format('Y-m-d') }}</td>
                                    <td>
                                        {{ $referral->appointment->patient?->firstName ?? 'Brak pacjenta' }}
                                        {{ $referral->appointment->patient?->lastName ?? '' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $referral->target_specialization }}</td>
                                    <td class="px-4 py-2">{{ $referral->refferal_code }}</td>
                                    <td class="px-4 py-2">{{ $referral->reason }}</td>
                                    <td class="px-4 py-2 text-center flex justify-center gap-4">
                                        <a href="{{ route('referrals.edit', $referral->id) }}" class="text-yellow-500 hover:text-yellow-600" title="Edytuj">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('referrals.destroy', $referral->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć skierowanie?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600" title="Usuń">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('referrals.pdf', $referral->id) }}" class="text-green-600 hover:text-green-700" title="PDF">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
