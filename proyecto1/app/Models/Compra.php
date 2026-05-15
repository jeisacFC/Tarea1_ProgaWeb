<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'id_usuario',
        'id_vehiculo',
        'precio_final',
        'fecha_compra',
        'estado',
    ];

    protected $casts = [
        'precio_final' => 'float',
        'fecha_compra' => 'datetime',
    ];

    // Una compra pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Una compra pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    // Una compra puede tener muchos pagos
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_compra', 'id_compra');
    }
}
