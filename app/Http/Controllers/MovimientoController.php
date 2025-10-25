<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;

class MovimientoController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        $movimientos = Movimiento::with(['activo','user'])
            ->latest()
            ->paginate(15);

        return view('movimientos.index', compact('movimientos'));
    }
}
