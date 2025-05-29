<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profil administratora') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Dane podstawowe') }}
                    </h2>
                </header>

                <form method="POST" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="firstName" :value="__('Imię')" />
                        <x-text-input id="firstName" name="firstName" type="text" class="mt-1 block w-full"
                                      :value="old('firstName', auth()->user()->firstName)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('firstName')" />
                    </div>

                    <div>
                        <x-input-label for="lastName" :value="__('Nazwisko')" />
                        <x-text-input id="lastName" name="lastName" type="text" class="mt-1 block w-full"
                                      :value="old('lastName', auth()->user()->lastName)" />
                        <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                      :value="old('email', auth()->user()->email)" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
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
