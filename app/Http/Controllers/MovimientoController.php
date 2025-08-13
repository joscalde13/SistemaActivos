<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\User;
use App\Models\Activo;
use Illuminate\Http\Request;


class MovimientoController extends \Illuminate\Routing\Controller
{
    public function index(Request $request)
    {
        // Filtros opcionales: q (texto), accion, desde, hasta, activo_id, user_id
        $query = Movimiento::with(['activo','user'])->latest();

        if ($request->filled('accion')) {
            $query->where('accion', $request->accion);
        }

        if ($request->filled('q')) {
            $q = '%'.$request->q.'%';
            $query->where(function($qq) use ($q) {
                $qq->where('detalle','like',$q)
                   ->orWhereHas('activo', fn($a)=>$a->where('codigo','like',$q)
                                                    ->orWhere('descripcion','like',$q))
                   ->orWhereHas('user', fn($u)=>$u->where('name','like',$q)
                                                  ->orWhere('email','like',$q));
            });
        }

        if ($request->filled('desde')) {
            $query->whereDate('created_at','>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('created_at','<=', $request->hasta);
        }

        if ($request->filled('activo_id')) {
            $query->where('activo_id', $request->activo_id);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $movimientos = $query->paginate(15)->withQueryString();

        // Para llenar selects (opcional)
        $acciones = ['Alta','Asignación','Reasignación','Actualización','Robo','Baja'];
        $activos  = Activo::orderBy('codigo')->get(['id','codigo']);
        $usuarios = User::orderBy('name')->get(['id','name']);

        return view('movimientos.index', compact('movimientos','acciones','activos','usuarios'));
    }
}
