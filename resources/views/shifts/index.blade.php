<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Turni</h1>

        <!-- Messaggi di Successo ed Errore -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per Creare un Nuovo Turno -->
        <div class="mb-6 p-4 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Aggiungi un Nuovo Turno</h2>
            <form action="{{ route('shifts.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Data di Inizio -->
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Inizio Turno</label>
                        <input type="datetime-local" id="start_time" name="start_time"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data di Fine -->
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Fine Turno</label>
                        <input type="datetime-local" id="end_time" name="end_time"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pulsante di Invio -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                            Aggiungi Turno
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabella Turni -->
        <div class="overflow-hidden rounded-lg shadow-lg bg-white">
            <table class="min-w-full border-collapse table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Utente</th>
                        <th class="py-3 px-6 text-left">Inizio</th>
                        <th class="py-3 px-6 text-left">Fine</th>
                        <th class="py-3 px-6 text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($shifts as $shift)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $shift->user->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $shift->start_time }}</td>
                            <td class="py-3 px-6 text-left">{{ $shift->end_time }}</td>
                            <td class="py-3 px-6 text-center space-x-2">
                                <!-- Pulsante Modifica -->
                                <a href="{{ route('shifts.edit', $shift) }}"
                                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                                    Modifica
                                </a>

                                <!-- Pulsante Elimina -->
                                <form action="{{ route('shifts.destroy', $shift) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Elimina
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
