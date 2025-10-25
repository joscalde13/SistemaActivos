{{-- resources/views/activos/index.blade.php --}}
<x-layouts.app :title="__('Activos')">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Activos</h1>

        @if(auth()->user()?->isAdmin())
            <a href="{{ route('activos.create') }}"
               class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
               + Nuevo Activo
            </a>
        @endif
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Código</th>
                    <th class="px-4 py-2 text-left">Descripción</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Usuario</th>
                    @if(auth()->user()?->isAdmin())
                        <th class="px-4 py-2 text-center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($activos as $activo)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 font-mono">{{ $activo->codigo }}</td>
                        <td class="px-4 py-2">{{ $activo->descripcion }}</td>
                        <td class="px-4 py-2 capitalize">{{ $activo->estado }}</td>
                        <td class="px-4 py-2">{{ $activo->user?->name ?? 'No asignado' }}</td>

                        @if(auth()->user()?->isAdmin())
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('activos.edit',$activo) }}"
                               class="px-3 py-1 text-sm bg-yellow-500 dark:bg-yellow-600 text-white rounded hover:bg-yellow-600 dark:hover:bg-yellow-700 transition">
                                Editar
                            </a>
                            <a href="{{ route('activos.asignar',$activo) }}"
                               class="px-3 py-1 text-sm bg-green-600 dark:bg-green-700 text-white rounded hover:bg-green-700 dark:hover:bg-green-800 transition">
                                Asignar
                            </a>
                            <form action="{{ route('activos.destroy',$activo) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Eliminar activo?');">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 text-sm bg-red-600 dark:bg-red-700 text-white rounded hover:bg-red-700 dark:hover:bg-red-800 transition">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-center text-gray-500 dark:text-gray-400" colspan="5">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>