<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nowa wizyta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col md:flex-row gap-6">

                    <!-- LEWA STRONA – FORMULARZ -->
                    <div class="basis-1/2">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Umów się na wizytę') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('patient.appointments.post') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="specialization" value="Wybierz specjalizację" />
                                <select id="specialization" name="specialization" class="w-full p-2 rounded border-gray-300">
                                    <option value="">-- wybierz specke --</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('specialization')" />
                            </div>

                            <div>
                                <x-input-label for="doctor_id" value="Wybierz lekarza" />
                                <select id="doctor_id" name="doctor_id" class="w-full p-2 rounded border-gray-300">
                                    <option value="">-- wybierz doktorka --</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('doctor_id')" />
                            </div>

                            <div>
                                <x-input-label for="appointment_day" value="Wybierz datę" />
                                <select id="appointment_day" name="appointment_day" class="w-full p-2 rounded border-gray-300">
                                    <option value="">-- wybierz dzien --</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('appointment_day')" />
                            </div>

                            <div>
                                <x-input-label for="appointment_id" value="Wybierz godzinę" />
                                <select id="appointment_id" name="appointment_id" class="w-full p-2 rounded border-gray-300">
                                    <option value="">-- wybierz godzine --</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('appointment_id')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Umów wizytę') }}</x-primary-button>
                                @if(session('success'))
                                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- PRAWA STRONA – OBRAZEK -->
<div class="shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/patient-make-visit.jpg') }}"
                             alt="Rejestracja wizyty"
                             class="h-80">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const spec = document.getElementById('specialization');
            const doctor = document.getElementById('doctor_id');
            const day = document.getElementById('appointment_day');
            const time = document.getElementById('appointment_id');

            fetch('/patient/appointments/api/specializations')
                .then(res => res.json())
                .then(data => {
                    data.forEach(s => {
                        spec.innerHTML += `<option value="${s}">${s}</option>`;
                    });
                });

            spec.addEventListener('change', function () {
                fetch(`/patient/appointments/api/doctors/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        doctor.innerHTML = `<option value="">-- wybierz lekarza --</option>`;
                        data.forEach(d => {
                            doctor.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                        });
                        doctor.disabled = false;
                        day.innerHTML = '<option value="">-- wybierz dzień --</option>';
                        time.innerHTML = '<option value="">-- wybierz godzinę --</option>';
                        day.disabled = true;
                        time.disabled = true;
                    });
            });

            doctor.addEventListener('change', function () {
                fetch(`/patient/appointments/api/dates/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        day.innerHTML = `<option value="">-- wybierz dzień --</option>`;
                        data.forEach(d => {
                            day.innerHTML += `<option value="${d}">${d}</option>`;
                        });
                        day.disabled = false;
                        time.innerHTML = '<option value="">-- wybierz godzinę --</option>';
                        time.disabled = true;
                    });
            });

            day.addEventListener('change', function () {
                const docId = doctor.value;
                fetch(`/patient/appointments/api/hours/${docId}/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        time.innerHTML = `<option value="">-- wybierz godzinę --</option>`;
                        data.forEach(h => {
                            time.innerHTML += `<option value="${h.id}">${h.time}</option>`;
                        });
                        time.disabled = false;
                    });
            });
        });
    </script>
</x-app-layout>
