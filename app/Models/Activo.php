<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $fillable = ['codigo','descripcion','estado','user_id','fecha_alta'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function movimientos() {
        return $this->hasMany(Movimiento::class);
    }
}
