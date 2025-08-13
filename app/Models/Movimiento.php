<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = ['activo_id','user_id','accion','detalle'];

    public function activo() {
        return $this->belongsTo(Activo::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
