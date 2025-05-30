<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mój grafik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Zobacz swój grafik') }}
                    </h2>
                </header>

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">Data</th>
                            <th class="border px-4 py-2">Godzina od</th>
                            <th class="border px-4 py-2">Godzina do</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td class="border px-4 py-2">{{ $schedule->dateStart }}</td>
                                <td class="border px-4 py-2">{{ $schedule->timeStart }}</td>
                                <td class="border px-4 py-2">{{ $schedule->timeEnd }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">Brak grafików.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</x-app-layout>