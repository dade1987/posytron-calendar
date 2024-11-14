<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Turni con Preavviso di Almeno 10 Giorni</h1>

        @if ($shifts->isEmpty())
            <p class="text-gray-600">Non ci sono turni inviati con un preavviso di almeno 10 giorni.</p>
        @else
            <div class="overflow-hidden rounded-lg shadow-lg bg-white">
                <table class="min-w-full border-collapse table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Utente</th>
                            <th class="py-3 px-6 text-left">Data di Creazione</th>
                            <th class="py-3 px-6 text-left">Data di Inizio</th>
                            <th class="py-3 px-6 text-left">Data di Fine</th>
                            <th class="py-3 px-6 text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach ($shifts as $shift)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $shift->user->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $shift->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-6 text-left">{{ $shift->start_time }}</td>
                                <td class="py-3 px-6 text-left">{{ $shift->end_time }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <!-- Pulsante Elimina -->
                                    <form action="{{ route('turni.destroy', $shift) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
                                            onclick="return confirm('Sei sicuro di voler eliminare questo turno?');">
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('shifts.index') }}"
            class="mt-6 inline-block bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
            Torna all'elenco dei turni
        </a>
    </div>
</x-app-layout>