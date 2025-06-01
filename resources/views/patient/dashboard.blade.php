<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Witaj, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}!
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dzisiaj -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Następna wizyta</h3>
                @if (!$nextAppointment)
                    <p class="text-gray-500">Nie masz umówionej następnej wizyty.</p>
                @else
                        <div class="border-b py-2">
                            <p><strong>Godzina:</strong> {{ \Carbon\Carbon::parse($nextAppointment->appointment_date)->format('H:i') }}</p>
                            <p><strong>Lekarz:</strong> {{ $nextAppointment->doctor->user->firstName }} {{ $nextAppointment->doctor->user->lastName }}</p>
                            <p><strong>Specjalizacja:</strong> {{ $nextAppointment->doctor->specialization }}</p>
                            <p><strong>Status:</strong>
                                <x-appointment-status :status="$nextAppointment->status->appointmentStatusName" />
                            </p>
                        </div>
                @endif
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Ostatnia wizyta</h3>
                @if (!$lastAppointment)
                    <p class="text-gray-500">Nie masz żadnej poprzedniej wizyty.</p>
                @else
                        <div class="border-b py-2">
                            <p><strong>Godzina:</strong> {{ \Carbon\Carbon::parse($lastAppointment->appointment_date)->format('H:i') }}</p>
                            <p><strong>Lekarz:</strong> {{ $lastAppointment->doctor->user->firstName }} {{ $lastAppointment->doctor->user->lastName }}</p>
                            <p><strong>Specjalizacja:</strong> {{ $lastAppointment->doctor->specialization }}</p>
                            <p><strong>Status:</strong>
                                <x-appointment-status :status="$lastAppointment->status->appointmentStatusName" />
                            </p>
                            <p><strong>Notatki:</strong> {{ $lastAppointment->notes }}</p>
                        </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>