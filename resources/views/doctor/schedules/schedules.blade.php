<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mój grafik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($schedules->isEmpty())
                    <p class="text-gray-600">Brak grafików.</p>
                @else
                    <table class="w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2">Data</th>
                                <th class="px-4 py-2">Godzina od</th>
                                <th class="px-4 py-2">Godzina do</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="px-4 py-2">{{ $schedule->dateStart }}</td>
                                    <td class="px-4 py-2">{{ $schedule->timeStart }}</td>
                                    <td class="px-4 py-2">{{ $schedule->timeEnd }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
