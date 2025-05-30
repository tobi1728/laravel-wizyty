<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Zaplanowane wizyty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($nextAppointments->isEmpty())
                    <p class="text-gray-600">Brak zaplanowanych wizyt.</p>
                @else
                    <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2">Data</th>
                                <th class="px-4 py-2">Pacjent</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Notatki</th>
                                <th class="px-4 py-2 text-center">Akcje</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($nextAppointments as $appointment)
                                <tr>
                                    <td class="px-4 py-2">{{ $appointment->appointment_date }}</td>
                                    <td class="px-4 py-2">
                                        {{ $appointment->patient?->user?->firstName ?? '—' }}
                                        {{ $appointment->patient?->user?->lastName ?? '' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $appointment->status->appointmentStatusName ?? 'Brak' }}</td>
                                    <td class="px-4 py-2">{{ $appointment->notes ?? '—' }}</td>
                                    <td class="px-4 py-2 text-center flex justify-center gap-4">
                                        <a href="{{ route('appointments.edit', ['id' => $appointment->id, 'back' => url()->current()]) }}" class="text-yellow-500 hover:text-yellow-600" title="Edytuj">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć wizytę?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600" title="Usuń">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
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
