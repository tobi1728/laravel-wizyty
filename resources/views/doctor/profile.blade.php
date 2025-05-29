<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profil lekarza') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Uzupełnij dane lekarza') }}
                    </h2>
                </header>

                <form method="POST" action="{{ url('/doctor/profile') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="specialization" :value="__('Specjalizacja')" />
                        <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full"
                                      :value="old('specialization', $doctor->specialization)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('specialization')" />
                    </div>

                    <div>
                        <x-input-label for="license_number" :value="__('Numer licencji')" />
                        <x-text-input id="license_number" name="license_number" type="text" class="mt-1 block w-full"
                                      :value="old('license_number', $doctor->license_number)" />
                        <x-input-error class="mt-2" :messages="$errors->get('license_number')" />
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
