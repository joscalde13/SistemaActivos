<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
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

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
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
