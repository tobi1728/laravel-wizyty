<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Witaj, Dr. {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}!
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dzisiaj -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Dzisiejsze wizyty</h3>
                @if ($todayAppointments->isEmpty())
                    <p class="text-gray-500">Brak wizyt na dziś.</p>
                @else
                    @foreach ($todayAppointments as $appt)
                        <div class="border-b py-2">
                            <p><strong>Godzina:</strong> {{ \Carbon\Carbon::parse($appt->appointment_date)->format('H:i') }}</p>
                            <p><strong>Pacjent:</strong> {{ $appt->patient?->user->firstName }} {{ $appt->patient?->user->lastName }}</p>
                            <p><strong>Status:</strong>
                                <x-appointment-status :status="$appt->status->appointmentStatusName" />
                            </p>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $todayAppointments->links() }}
                    </div>
                @endif
            </div>

            <!-- Grafik -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Twój grafik</h3>
            @if ($todaySchedule)
                <p><strong>Data:</strong> {{ $todaySchedule->dateStart }}</p>
                <p><strong>Od:</strong> {{ $todaySchedule->timeStart }} — <strong>Do:</strong> {{ $todaySchedule->timeEnd }}</p>
            @else
                <p class="text-gray-500">Brak grafiku na dziś.</p>
            @endif

            <div class="mt-4 border-t pt-4 text-m text-gray-900">
                <p><strong>Wystawione recepty:</strong> {{ $prescriptionCount }}</p>
                <p><strong>Wystawione skierowania:</strong> {{ $referralCount }}</p>
                <p><strong>Zaplanowane wizyty:</strong> {{ $plannedAppointmentsCount }}</p>
            </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Historia wizyt</h3>
                @if ($historicAppointments->isEmpty())
                    <p class="text-gray-500">Brak historii wizyt.</p>
                @else
                    @foreach ($historicAppointments as $appt)
                        <div class="border-b py-2">
                            <p><strong>Data:</strong> {{ $appt->appointment_date }}</p>
                            <p><strong>Pacjent:</strong>
                                {{ $appt->patient?->user->firstName }} {{ $appt->patient?->user->lastName }}
                            </p>
                            <p><strong>Status:</strong>
                                <x-appointment-status :status="$appt->status->appointmentStatusName" />
                            </p>
                            <p><strong>Notatki:</strong> {{ $appt->notes ?? '—' }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
