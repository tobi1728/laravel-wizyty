@props(['role'])

@switch($role)
    @case('doctor')
        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
            <i class="fa-solid fa-stethoscope"></i> Doktor
        </span>
        @break

    @case('patient')
        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
            <i class="fa-solid fa-user-injured"></i> Pacjent
        </span>
        @break

    @case('admin')
        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
            <i class="fa-solid fa-user-tie"></i> Admin
        </span>
        @break

    @default
        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">
            Nieznana rola
        </span>
@endswitch
