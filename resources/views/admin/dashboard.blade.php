<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Witaj, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}!
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- PACJENCI KLINIKI -->
            <div class="bg-white shadow rounded-lg p-6 flex justify-between">
                <div class="grow">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Pacjenci</h3>
                    
                    <h1 class="text-3xl font-bold py-2">{{ $allPatientsCount }}</h1>

                    <div class="border-b py-2">Najnowszy pacjent
                        <p>
                            <strong>{{ $lastPatient->user->firstName }} {{ $lastPatient->user->lastName }}</strong>
                        </p>
                        <p>
                            {{ $lastPatient->user->email }}
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/patient-girl.png') }}" alt="Patient" class="h-48 w-auto">
                </div>
            </div>
            
            <!-- LEKI -->
            <div class="bg-white shadow rounded-lg p-6 flex justify-between">
                <div class="grow">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Leki</h3>
                    
                    <h1 class="text-3xl font-bold py-2">{{ $allMedicinesCount }}</h1>

                    <div class="border-b py-2">Najnowszy lek
                        <p>
                            <strong>{{ $lastMedicine->medicine_name }}</strong>
                        </p>
                        <p>
                            {{ $lastMedicine->medicine_category }}
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/medicines.png') }}" alt="Medicine" class="h-48 w-auto">
                </div>
            </div>

            <!-- PERSONEL KLINIKI -->
            <div class="bg-white shadow rounded-lg p-6 flex justify-between">
                <div class="grow">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Personel</h3>
                    
                    <h1 class="text-3xl font-bold py-2">{{ $allDoctorsCount }}</h1>

                    <div class="border-b py-2">Nowy lekarz
                        <p>
                            <strong>{{ $lastDoctor->user->firstName }} {{ $lastDoctor->user->lastName }}</strong>
                        </p>
                        <p>
                            {{ $lastDoctor->user->email }}
                        </p>
                        <p class="italic">
                            {{ $lastDoctor->specialization }}
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/doctors.png') }}" alt="Doctors" class="h-48 w-auto">
                </div>
            </div>

            <!-- WIZYTY -->
            <div class="bg-white shadow rounded-lg p-6 flex justify-between">
                <div class="grow">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Wizyty</h3>
                    
                    <h1 class="text-3xl font-bold py-2">{{ $allAppointmentsCount }}</h1>

                    <div class="border-b py-2">Nowa wizyta
                        <p>
                            <strong>{{ $appointmentDate }}</strong> godz. {{ $appointmentTime }}
                        </p>
                        <p>
                            {{ $lastAppointment->doctor->specialization }}
                        </p>
                        <p>
                            <x-appointment-status :status="$lastAppointment->status->appointmentStatusName" />
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/appointment.png') }}" alt="Appointments" class="h-48 w-auto">
                </div>
            </div>

        </div>

    </div>
</x-app-layout>