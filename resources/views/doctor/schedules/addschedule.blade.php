<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Ustaw grafik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                <form method="POST" action="{{ route('doctor.addschedule') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="date" value="Wybierz datę" />
                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="time-from" value="Wybierz godzinę od" />
                        <x-text-input id="time-from" name="time-from" type="time" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('time-from')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="time-to" value="Wybierz godzinę do" />
                        <x-text-input id="time-to" name="time-to" type="time" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('time-to')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Zapisz grafik') }}</x-primary-button>
                        @if(session('success'))
                            <p class="text-sm text-gray-600">{{ session('success') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
