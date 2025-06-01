<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex items-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Twoje skierowania') }}
            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-blue-800 bg-blue-100 border-2 rounded-full ml-1">
                {{ $referralSum }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2">Kod skierowania</th>
                            <th class="px-4 py-2">Data wystawienia</th>
                            <th class="px-4 py-2">Lekarz</th>
                            <th class="px-4 py-2">Skierowanie do</th>
                            <th class="px-4 py-2">Powód</th>
                            <th class="px-4 py-2 text-center w-20">Pobierz</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($referrals as $referral)
                            <tr>
                                <td class="px-4 py-2">{{ $referral->refferal_code }}</td>
                                <td class="px-4 py-2">{{ $referral->issue_date }}</td>

                                <td class="px-4 py-2">
                                    @if($referral->appointment->doctor)
                                        {{ $referral->appointment->doctor->user->firstName }} {{ $referral->appointment->doctor->user->lastName }}
                                    @else
                                        Nieznany
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $referral->target_specialization }}</td>
                                <td class="px-4 py-2">{{ $referral->reason }}</td>
                                
                                <td class="px-4 py-2">
                                    <div class="flex justify-center">
                                    
                                        <a href="{{ route('referrals.pdf', $referral->id) }}" target="_blank" title="PDF">
                                            <i class="fa-solid fa-file text-green-600 hover:text-green-700"></i>
                                        </a>

                                    </div>
                                    
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Nie masz żadnych recept.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</x-app-layout>