<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ustaw grafik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Uzupełnij grafik') }}
                    </h2>
                </header>

                <form method="POST" action="{{ route('doctor.addschedule') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="date" value="Wybierz datę" />
                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                    </div>

                    <div>
                        <x-input-label for="time-from" value="Wybierz godzinę od" />
                        <x-text-input id="time-from" name="time-from" type="time" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('time-from')" />
                    </div>

                    <div>
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
