<x-guest-layout>
    

<section class="dark:bg-gray-900">
    <div class="flex flex-row items-center justify-center mx-auto">

      <!-- Lewa kolumna, formularz -->
      <div class="bg-white w-full rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Zarejestruj się
              </h1>

              <!-- Lewa kolumna, początek formularza -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf


                    <!-- Imię -->
                    <div class="mt-4">
                        <x-input-label for="firstName" :value="__('Imię')" />
                        <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus />
                        <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                    </div>

                    <!-- Nazwisko -->
                    <div class="mt-4">
                        <x-input-label for="lastName" :value="__('Nazwisko')" />
                        <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required />
                        <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                    </div>

                    <!-- Rola -->
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Rola')" />
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="patient">Pacjent</option>
                            <option value="doctor">Lekarz</option>
                            <option value="admin">Administrator</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>


                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__(key: 'Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Hasło')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Powtórz hasło')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        Masz już konto?<a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-primary-500 ml-1">Zaloguj się</a>

                        <x-register-button class="ms-4">
                            {{ __('Rejestracja') }}
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
