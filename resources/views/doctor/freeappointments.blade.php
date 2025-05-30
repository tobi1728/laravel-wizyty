<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wolne terminy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Zobacz swoje wolne terminy') }}
                    </h2>
                </header>

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">Data</th>
                            <th class="border px-4 py-2">Pacjent</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Notatki</th>
                            <th class="border px-4 py-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($freeAppointments as $appointment)
                            <tr>
                                <td class="border px-4 py-2">{{ $appointment->appointment_date }}</td>
                                <td class="border px-4 py-2">
                                    @if($appointment->patient)
                                        {{ $appointment->patient->firstName }} {{ $appointment->patient->lastName }}
                                    @else
                                        Nieznany
                                    @endif
                                </td>
                                <td class="border px-4 py-2">
                                    <x-appointment-status :status="$appointment->status->appointmentStatusName" />
                                </td>
                                <td class="border px-4 py-2">{{ $appointment->notes }}</td>
                                <td class="border px-4 py-2">Tu będą buttony ale już mi się dziś nie chce</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Brak wolnych terminów.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</x-app-layout>