<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Wystaw receptę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

            <form method="POST" action="{{ route('prescriptions.store') }}">
                    @csrf

                    <!-- Appointment -->
                    <div class="mb-4">
                        <x-input-label for="appointment_id" value="Wizyta pacjenta" />
                        <select id="appointment_id" name="appointment_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Wybierz --</option>
                            @foreach ($appointments as $appointment)
                                @php
                                    $user = $appointment->patient->user ?? null;
                                    $name = $user ? $user->firstName . ' ' . $user->lastName : 'Brak pacjenta';
                                    $date = \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d H:i');
                                @endphp
                                <option value="{{ $appointment->id }}">{{ $name }} — {{ $date }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                    </div>

                    <!-- Medicine -->
                    <div class="mb-4">
                        <x-input-label for="medicine_id" value="Lek" />
                        <select id="medicine_id" name="medicine_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Wybierz --</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->medicine_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_id')" class="mt-2" />
                    </div>

                    <!-- Issue Date -->
                    <div class="mb-4">
                        <x-input-label for="issue_date" value="Data wystawienia" />
                        <x-text-input id="issue_date" name="issue_date" type="date" class="mt-1 block w-full" value="{{ old('issue_date', now()->format('Y-m-d')) }}" />
                        <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <x-input-label for="notes" value="Dawkowanie / Uwagi" />
                        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Wystaw receptę') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
