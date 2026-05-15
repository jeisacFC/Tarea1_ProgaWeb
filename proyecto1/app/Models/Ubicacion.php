<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'id_ubicacion';

    protected $fillable = [
        'ciudad',
        'pais',
        'direccion',
        'latitud',
        'longitud',
        'codigo_postal',
    ];

    protected $casts = [
        'latitud' => 'float',
        'longitud' => 'float',
    ];

    // Una ubicación puede tener muchos vehículos
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_ubicacion', 'id_ubicacion');
    }
}
