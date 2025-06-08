<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<section class="dark:bg-gray-900">
    <div class="flex flex-row items-center justify-center mx-auto">

      <!-- Lewa kolumna, formularz -->
      <div class="bg-white w-full rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Zaloguj się
              </h1>

              <!-- Lewa kolumna, początek formularza -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <span>
                            Nie masz konta? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-primary-500 ml-1">Zarejestruj się</a>
                        </span>

                        <x-register-button class="ms-3">
                            {{ __('Log in') }}
                        </x-register-button>
                    </div>
                </form>
          </div>
      </div>

      <!-- Prawa kolumna, obrazek -->
      <div>
        <img src="{{ asset('images/register-image.png') }}" alt="Register Image" />
      </div>
  </div>
</section>

</x-guest-layout>
