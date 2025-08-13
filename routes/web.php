<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\MovimientoController;

use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('activos.index');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

  

    Route::get('activos', [ActivoController::class, 'index'])->name('activos.index');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::view('condiciones', 'condiciones')->name('condiciones');
});

require __DIR__.'/auth.php';
  Route::middleware(['auth','role:admin'])->group(function () {

        Route::get('movimientos', [MovimientoController::class,'index'])->name('movimientos.index');
        Route::resource('activos', ActivoController::class)->except(['index']);
        Route::get('activos/{id}/asignar', [ActivoController::class,'asignar'])->name('activos.asignar');
        Route::post('activos/{id}/asignar', [ActivoController::class,'asignarStore'])->name('activos.asignar.store');
        
    });
