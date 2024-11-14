<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifica Turno</h1>

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

        <!-- Form per Modificare il Turno -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <form action="{{ route('shifts.update', $shift) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Data di Inizio -->
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Inizio Turno</label>
                        <input type="datetime-local" id="start_time" name="start_time"
                            value="{{ old('start_time', $shift->start_time) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data di Fine -->
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Fine Turno</label>
                        <input type="datetime-local" id="end_time" name="end_time"
                            value="{{ old('end_time', $shift->end_time) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pulsanti di Azione -->
                <div class="mt-6 flex items-center space-x-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Salva Modifiche
                    </button>

                    <a href="{{ route('shifts.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Annulla
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
