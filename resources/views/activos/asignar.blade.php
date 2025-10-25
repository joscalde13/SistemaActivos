{{-- resources/views/activos/asignar.blade.php --}}
<x-layouts.app :title="__('Asignar Activo')">
    <div class="max-w-lg mx-auto">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Asignar / Reasignar Activo</h1>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-5 space-y-4">
            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                <p><span class="font-medium text-gray-900 dark:text-gray-100">Código:</span> {{ $activo->codigo }}</p>
                <p><span class="font-medium text-gray-900 dark:text-gray-100">Descripción:</span> {{ $activo->descripcion }}</p>
                <p><span class="font-medium text-gray-900 dark:text-gray-100">Estado:</span> <span class="capitalize">{{ $activo->estado }}</span></p>
                <p><span class="font-medium text-gray-900 dark:text-gray-100">Usuario actual:</span> {{ $activo->user?->name ?? 'No asignado' }}</p>
            </div>

            <form action="{{ route('activos.asignar.store', $activo) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Seleccionar Usuario</label>
                    <select name="user_id" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800" required>
                        <option value="" disabled selected>— Elegir —</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') 
                        <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('activos.index') }}" 
                       class="px-3 py-1.5 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 text-sm">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-3 py-1.5 rounded-md bg-blue-600 dark:bg-blue-700 text-white hover:bg-blue-700 dark:hover:bg-blue-800 text-sm">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>