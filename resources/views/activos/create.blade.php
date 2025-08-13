<x-layouts.app :title="__('Nuevo Activo')">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Nuevo Activo</h1>

    <form action="{{ route('activos.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <div>
            <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
            <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('codigo') border-red-500 @enderror">
            @error('codigo')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('descripcion') border-red-500 @enderror">
            @error('descripcion')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fecha_alta" class="block text-sm font-medium text-gray-700">Fecha de Alta</label>
            <input type="date" id="fecha_alta" name="fecha_alta"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mt-4">
            <div class="flex items-center">
                <input id="condiciones" name="condiciones" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" onchange="document.getElementById('submit-button').disabled = !this.checked;">
                <label for="condiciones" class="ml-2 block text-sm text-gray-900">
                    Acepto los <a href="{{ route('condiciones') }}" target="_blank" class="text-blue-600 hover:underline">términos y condiciones</a>.
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('activos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Cancelar
            </a>
            <button type="submit" id="submit-button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition" disabled>
                Guardar
            </button>
        </div>
    </form>
</x-layouts.app>
