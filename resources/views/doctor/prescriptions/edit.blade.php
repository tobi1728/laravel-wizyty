<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edytuj receptę') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('prescriptions.update', $prescription->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Lek --}}
                    <div class="mb-4">
                        <x-input-label for="medicine_id" value="Lek" />
                        <select id="medicine_id" name="medicine_id"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}" {{ $prescription->medicine_id == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->medicine_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_id')" class="mt-2" />
                    </div>

                    {{-- Data wystawienia --}}
                    <div class="mb-4">
                        <x-input-label for="issue_date" value="Data wystawienia" />
                        <x-text-input id="issue_date" type="date" name="issue_date"
                            class="mt-1 block w-full" :value="old('issue_date', $prescription->issue_date)" />
                        <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                    </div>

                    {{-- Uwagi / dawkowanie --}}
                    <div class="mb-4">
                        <x-input-label for="notes" value="Dawkowanie / Uwagi" />
                        <textarea id="notes" name="notes" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('notes', $prescription->notes) }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    {{-- Zapisz --}}
                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Zapisz zmiany') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
