<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';
    protected $primaryKey = 'id_favorito';

    protected $fillable = [
        'id_usuario',
        'id_vehiculo',
        'fecha_agregado',
        'estado',
        'nota',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'fecha_agregado' => 'datetime',
    ];

    // Un favorito pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Un favorito pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}