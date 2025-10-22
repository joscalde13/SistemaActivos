<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Movimiento;
use App\Models\User;
use Illuminate\Http\Request;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $activos = Activo::with('user')
            ->where('estado', '!=', 'baja') 
            ->orderByDesc('id')
            ->get();

        return view('activos.index', compact('activos'));
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activos.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:activos,codigo',
            'descripcion' => 'required',
        ]);

        $activo = Activo::create($request->all());
        Movimiento::create([
            'activo_id' => $activo->id,
            'accion' => 'Alta',
            'detalle' => 'Registro inicial del activo'
        ]);
        return redirect()->route('activos.index')->with('success', 'Activo creado.');
    }


     public function asignar($id)
    {
        $activo = Activo::findOrFail($id);
        $usuarios = User::all();
        return view('activos.asignar', compact('activo','usuarios'));
    }

    public function asignarStore(Request $request, $id)
    {
        $activo = Activo::findOrFail($id);

        $activo->update(['user_id' => $request->user_id, 'estado' => 'asignado']);

        Movimiento::create([
            'activo_id' => $activo->id,
            'user_id' => $request->user_id,
            'accion' => 'Asignación',
            'detalle' => 'Activo asignado a usuario'
        ]);
        
        return redirect()->route('activos.index')->with('success', 'Activo creado.');

    }



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $activo = Activo::findOrFail($id);
        return view('activos.edit', compact('activo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activo = Activo::findOrFail($id);

        $request->validate([
            'codigo' => 'required|unique:activos,codigo,' . $activo->id,
            'descripcion' => 'required',
        ]);

        $activo->update($request->all());

        Movimiento::create([
            'activo_id' => $activo->id,
            'user_id'   => $activo->user_id,
            'accion'    => 'Actualización',
            'detalle'   => 'Actualización de datos o estado del activo'
        ]);

        return redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(string $id)
{
    $activo = Activo::findOrFail($id);

    // registra el movimiento
    Movimiento::create([
        'activo_id' => $activo->id,
        'user_id'   => $activo->user_id,
        'accion'    => 'Baja',
        'detalle'   => 'Activo dado de baja',
    ]);

    
    $activo->update(['estado' => 'baja']);

    return redirect()->route('activos.index')->with( 'Activo dado de baja.');
}

}
