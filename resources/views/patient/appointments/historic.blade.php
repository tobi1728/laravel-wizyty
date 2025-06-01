<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historia wizyt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2">Data</th>
                            <th class="px-4 py-2">Lekarz</th>
                            <th class="px-4 py-2">Specjalizacja</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Notatki</th>
                            <th class="px-4 py-2 text-center w-20">Skierowania</th>
                            <th class="px-4 py-2 text-center w-20">Recepty</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($historicAppointments as $appointment)
                            <tr>
                                <td class="px-4 py-2">{{ $appointment->appointment_date }}</td>
                                <td class="px-4 py-2">
                                    @if($appointment->doctor)
                                        {{ $appointment->doctor->user->firstName }} {{ $appointment->doctor->user->lastName }}
                                    @else
                                        Nieznany
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $appointment->doctor->specialization }}</td>
                                <td class="px-4 py-2">
                                    <x-appointment-status :status="$appointment->status->appointmentStatusName" />
                                </td>
                                <td class="px-4 py-2">Notatka</td>
                                <td class="px-4 py-2">
                                    <div class="flex flex-col">
                                    
                                    @forelse ($appointment->referrals as $referral)
                                        <a href="{{ route('referrals.pdf', $referral->id) }}" target="_blank" title="PDF">
                                            <i class="fa-solid fa-file text-green-600 hover:text-green-700"></i> ...{{ substr($referral->refferal_code, -5) }}
                                        </a>
                                    @empty
                                        <div>Brak skierowań</div>
                                    @endforelse

                                    </div>
                                    
                                </td>
                                
                                <td class="px-4 py-2">
                                    <div class="flex flex-col">
                                    
                                    @forelse ($appointment->prescriptions as $prescription)
                                        <a href="{{ route('prescriptions.export', $prescription->id) }}" target="_blank" title="PDF">
                                            <i class="fa-solid fa-file text-green-600 hover:text-green-700"></i> {{ $prescription->prescription_code }}
                                        </a>
                                    @empty
                                        <div>Brak recept</div>
                                    @endforelse

                                    </div>
                                    
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Nie masz żadnych historycznych wizyt.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</x-app-layout>