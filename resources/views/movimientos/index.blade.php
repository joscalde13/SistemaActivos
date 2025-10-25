<x-layouts.app :title="__('Historial de Movimientos')">
  

    

    <!-- Tabla -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow mt-10">
        <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Fecha</th>
                    <th class="px-4 py-2 text-left">Activo</th>
                    <th class="px-4 py-2 text-left">Usuario</th>
                    <th class="px-4 py-2 text-left">Acción</th>
                    <th class="px-4 py-2 text-left">Detalle</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movimientos as $m)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $m->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">
                            <div class="font-mono">{{ $m->activo?->codigo }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $m->activo?->descripcion }}</div>
                        </td>
                        <td class="px-4 py-2">{{ $m->user?->name ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $m->accion }}</td>
                        <td class="px-4 py-2">{{ $m->detalle }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Sin movimientos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $movimientos->links() }}
    </div>
</x-layouts.app>