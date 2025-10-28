<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Actualiza tu contraseña')" :subheading="__('Asegúrate de usar una contraseña larga y segura para proteger tu cuenta')">
        <form method="POST" wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Contraseña actual')"
                type="password"
                required
                autocomplete="current-password"
            />
            
            <flux:input
                wire:model.live="password"
                :label="__('Nueva contraseña')"
                type="password"
                required
                autocomplete="new-password"
            />
            <div class="rounded-md border border-zinc-200 px-3 py-2 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
            <p class="font-medium text-zinc-700 dark:text-zinc-200">La contraseña debe incluir:</p>
            <ul class="mt-2 space-y-1">
                @foreach ($this->passwordChecklist as $item)
                    <li class="{{ $item['met'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ $item['label'] }} 
                    </li>
                @endforeach
            </ul>
        </div>
            
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Guardar') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Guardado.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
