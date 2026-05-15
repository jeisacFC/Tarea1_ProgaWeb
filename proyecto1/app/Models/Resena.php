<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $table = 'resenas';
    protected $primaryKey = 'id_resena';

    protected $fillable = [
        'id_usuario',
        'id_vehiculo',
        'calificacion',
        'comentario',
        'fecha',
    ];

    protected $casts = [
        'calificacion' => 'integer',
        'fecha' => 'datetime',
    ];

    // Una reseña pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Una reseña pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}