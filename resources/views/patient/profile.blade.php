<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profil pacjenta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Uzupełnij dane pacjenta') }}
                    </h2>
                </header>

                <form method="POST" action="{{ url('/patient/profile') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="pesel" :value="__('PESEL')" />
                        <x-text-input id="pesel" name="pesel" type="text" class="mt-1 block w-full" :value="old('pesel', $patient->pesel)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('pesel')" />
                    </div>

                    <div>
                        <x-input-label for="birth_date" :value="__('Data urodzenia')" />
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $patient->birth_date)" />
                        <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                    </div>

                    <div>
                        <x-input-label for="phone_number" :value="__('Numer telefonu')" />
                        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $patient->phone_number)" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Adres')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $patient->address)" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Zapisz') }}</x-primary-button>
                        @if(session('success'))
                            <p class="text-sm text-gray-600">{{ session('success') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
