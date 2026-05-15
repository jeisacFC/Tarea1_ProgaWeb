<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenVehiculo extends Model
{
    protected $table = 'imagenes_vehiculo';
    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'id_vehiculo',
        'url_imagen',
        'descripcion',
        'orden',
        'fecha_subida',
    ];

    protected $casts = [
        'orden'       => 'integer',
        'fecha_subida' => 'datetime',
    ];

    // Una imagen pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}