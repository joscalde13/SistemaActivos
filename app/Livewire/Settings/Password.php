<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Password extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate(
                [
                    'current_password' => ['required', 'string', 'current_password'],
                    'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)->letters()->numbers()->symbols()],
                ],
                [
                    'password.required' => 'La contraseña es obligatoria.',
                    'password.confirmed' => 'Las contraseñas no coinciden.',
                    'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                    'password.letters' => 'La contraseña debe contener al menos una letra.',
                    'password.numbers' => 'La contraseña debe contener al menos un número.',
                    'password.symbols' => 'La contraseña debe contener al menos un símbolo.',
                ]
            );
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }

    #[Computed]
    public function passwordChecklist(): array
    {
        $password = $this->password ?? '';

        return [
            [
                'label' => 'Al menos una letra (mayúscula o minúscula)',
                'met' => (bool) preg_match('/[A-Za-z]/', $password),
            ],
            [
                'label' => 'Al menos un número',
                'met' => (bool) preg_match('/\d/', $password),
            ],
            [
                'label' => 'Al menos un carácter especial (como @, $, !, %, *, ?, &)',
                'met' => (bool) preg_match('/[^A-Za-z0-9]/', $password),
            ],
            [
                'label' => 'Una longitud mínima de 8 caracteres',
                'met' => strlen($password) >= 8,
            ],
        ];
    }
}
