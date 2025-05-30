<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edytuj skierowanie') }}
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

                <form method="POST" action="{{ route('referrals.update', $referral->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Specialization -->
                    <div class="mb-4">
                        <x-input-label for="target_specialization" value="Specjalizacja docelowa" />
                        <select id="specialization-select" name="target_specialization" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" onchange="toggleCustomSpecialization(this.value)">
                            @foreach ($specializations as $spec)
                                <option value="{{ $spec }}" {{ $referral->target_specialization === $spec ? 'selected' : '' }}>
                                    {{ $spec }}
                                </option>
                            @endforeach
                            <option value="custom" {{ !in_array($referral->target_specialization, $specializations) ? 'selected' : '' }}>
                                Inna...
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('target_specialization')" class="mt-2" />

                        <input type="text" name="custom_specialization" id="custom-specialization"
                               class="form-input mt-3 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm {{ in_array($referral->target_specialization, $specializations) ? 'hidden' : '' }}"
                               placeholder="Własna specjalizacja"
                               value="{{ !in_array($referral->target_specialization, $specializations) ? $referral->target_specialization : '' }}">
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <x-input-label for="reason" value="Uwagi / Notatki" />
                        <textarea id="reason" name="reason" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('reason', $referral->reason) }}</textarea>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Zapisz zmiany') }}
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
