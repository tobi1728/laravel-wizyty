<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edytuj lek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.data.addNewMedicine', $medicine->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Lek --}}
                    <div class="mb-4">
                        <x-input-label for="medicine_name" value="Nazwa leku" />
                        <x-text-input id="medicine_name" type="text" name="medicine_name"
                            class="mt-1 block w-full" :value="old('medicine_name', $medicine->medicine_name)" />
                        <x-input-error :messages="$errors->get('medicine_name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="medicine_form" value="Forma leku" />
                        <x-text-input id="medicine_form" type="text" name="medicine_form"
                            class="mt-1 block w-full" :value="old('medicine_form', $medicine->medicine_form)" />
                        <x-input-error :messages="$errors->get('medicine_form')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="active_substance" value="Substancja aktywna" />
                        <x-text-input id="active_substance" type="text" name="active_substance"
                            class="mt-1 block w-full" :value="old('active_substance', $medicine->active_substance)" />
                        <x-input-error :messages="$errors->get('active_substance')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="medicine_category" value="Kategoria" />
                        <x-text-input id="medicine_category" type="text" name="medicine_category"
                            class="mt-1 block w-full" :value="old('medicine_category', $medicine->medicine_category)" />
                        <x-input-error :messages="$errors->get('medicine_category')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="medicine_producer" value="Producent" />
                        <x-text-input id="medicine_producer" type="text" name="medicine_producer"
                            class="mt-1 block w-full" :value="old('medicine_producer', $medicine->medicine_producer)" />
                        <x-input-error :messages="$errors->get('medicine_producer')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="medicine_description" value="Opis" />
                        <textarea id="medicine_description" name="medicine_description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('medicine_description', $medicine->medicine_description) }}</textarea>
                        <x-input-error :messages="$errors->get('medicine_description')" class="mt-2" />
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
