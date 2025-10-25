<div class="mt-4 flex flex-col gap-6">
    <flux:text class="text-center">
        {{ __('Por favor verifica tu correo haciendo clic en el enlace que te acabamos de enviar.') }}
    </flux:text>

    @if (session('status') == 'verification-link-sent')
        <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
            {{ __('Hemos enviado un nuevo enlace de verificación al correo que registraste.') }}
        </flux:text>
    @endif

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button wire:click="sendVerification" variant="primary" class="w-full">
            {{ __('Reenviar correo de verificación') }}
        </flux:button>

        <flux:link class="text-sm cursor-pointer" wire:click="logout">
            {{ __('Cerrar sesión') }}
        </flux:link>
    </div>
</div>
