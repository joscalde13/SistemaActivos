{{-- resources/views/activos/asignar.blade.php --}}
<x-layouts.app :title="__('Asignar Activo')">
    <div class="max-w-lg mx-auto">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Asignar / Reasignar Activo</h1>

        <div class="bg-white border border-gray-200 rounded-lg p-5 space-y-4">
            <div class="text-sm text-gray-700 space-y-1">
                <p><span class="font-medium text-gray-900">Código:</span> {{ $activo->codigo }}</p>
                <p><span class="font-medium text-gray-900">Descripción:</span> {{ $activo->descripcion }}</p>
                <p><span class="font-medium text-gray-900">Estado:</span> <span class="capitalize">{{ $activo->estado }}</span></p>
                <p><span class="font-medium text-gray-900">Usuario actual:</span> {{ $activo->user?->name ?? 'No asignado' }}</p>
            </div>

            <form action="{{ route('activos.asignar.store', $activo) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Seleccionar Usuario</label>
                    <select name="user_id" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="" disabled selected>— Elegir —</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') 
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('activos.index') }}" 
                       class="px-3 py-1.5 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-3 py-1.5 rounded-md bg-blue-600 text-white hover:bg-blue-700 text-sm">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
