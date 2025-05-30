<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edytuj wizytę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ request('back') }}">

                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="appointment_date" value="Data wizyty" />
                        <x-text-input id="appointment_date" name="appointment_date" type="text" disabled
                            class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                            value="{{ $appointment->appointment_date }}" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="appointment_status_id" value="Status wizyty" />
                        <select id="appointment_status_id" name="appointment_status_id"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $appointment->appointment_status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->appointmentStatusName }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('appointment_status_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="notes" value="Notatki" />
                        <textarea id="notes" name="notes" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $appointment->notes) }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Zapisz zmiany') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
