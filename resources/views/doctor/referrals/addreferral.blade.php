<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Wystaw skierowanie') }}
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

                <form method="POST" action="{{ route('referrals.store') }}">
                    @csrf

                    <!-- Appointment -->
                    <div class="mb-4">
                        <x-input-label for="appointment_id" value="Wizyta pacjenta" />
                        <select id="appointment_id" name="appointment_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Wybierz --</option>
                            @foreach ($appointments as $appointment)
                                <option value="{{ $appointment->id }}">
                                    {{ $appointment->patient?->firstName ?? 'Brak pacjenta' }}
                                    {{ $appointment->patient?->lastName ?? '' }}
                                    —
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d H:i') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                    </div>

                    <!-- Specialization -->
                    <div class="mb-4">
                        <x-input-label for="target_specialization" value="Specjalizacja docelowa" />
                        <select id="specialization-select" name="target_specialization" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" onchange="toggleCustomSpecialization(this.value)">
                            @foreach ($specializations as $spec)
                                <option value="{{ $spec }}">{{ $spec }}</option>
                            @endforeach
                            <option value="custom">Inna...</option>
                        </select>
                        <x-input-error :messages="$errors->get('target_specialization')" class="mt-2" />

                        <input type="text" name="custom_specialization" id="custom-specialization" class="form-input mt-3 w-full hidden border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Własna specjalizacja">
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <x-input-label for="reason" value="Uwagi / Notatki" />
                        <textarea id="reason" name="reason" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('reason') }}</textarea>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Wystaw skierowanie') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomSpecialization(value) {
            const input = document.getElementById('custom-specialization');
            input.classList.toggle('hidden', value !== 'custom');
        }
    </script>
</x-app-layout>
