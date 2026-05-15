<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo';

    protected $fillable = [
        'marca',
        'modelo',
        'anio',
        'precio',
        'descripcion',
        'id_vendedor',
        'id_ubicacion',
        'estado',
        'fecha_publicacion',
    ];

    protected $casts = [
        'precio' => 'float',
        'anio' => 'integer',
        'fecha_publicacion' => 'datetime',
    ];

    // Un vehículo pertenece a un vendedor (usuario)
    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'id_vendedor', 'id_usuario');
    }

    // Un vehículo pertenece a una ubicación
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    // Un vehículo puede tener muchas imágenes
    public function imagenes()
    {
        return $this->hasMany(ImagenVehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    // Un vehículo puede estar en muchas compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_vehiculo', 'id_vehiculo');
    }

    // Un vehículo puede estar en muchos favoritos
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_vehiculo', 'id_vehiculo');
    }

    // Un vehículo puede tener muchas reseñas
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'id_vehiculo', 'id_vehiculo');
    }
}
