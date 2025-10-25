<x-layouts.app :title="__('Editar Activo')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Editar Activo</h1>

    <form action="{{ route('activos.update', $activo->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código</label>
            <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $activo->codigo) }}" required
                   class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('codigo') border-red-500 @enderror">
            @error('codigo')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $activo->descripcion) }}" required
                   class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('descripcion') border-red-500 @enderror">
            @error('descripcion')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select id="estado" name="estado" 
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach(['disponible','asignado','mantenimiento','robado','baja'] as $estado)
                    <option value="{{ $estado }}" @selected($activo->estado == $estado)>{{ ucfirst($estado) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <div class="flex items-center">
                <input id="condiciones" name="condiciones" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded" onchange="document.getElementById('submit-button').disabled = !this.checked;">
                <label for="condiciones" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                    Acepto los <a href="{{ route('condiciones') }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">términos y condiciones</a>.
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('activos.index') }}" class="px-4 py-2 bg-gray-500 dark:bg-gray-600 text-white rounded hover:bg-gray-600 dark:hover:bg-gray-700 transition">
                Cancelar
            </a>
            <button type="submit" id="submit-button" class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded hover:bg-blue-700 dark:hover:bg-blue-800 transition" disabled>
                Actualizar
            </button>
        </div>
    </form>
</x-layouts.app>