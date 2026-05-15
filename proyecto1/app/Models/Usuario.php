<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'fecha_registro',
        'tipo_usuario',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    // Un usuario puede vender muchos vehículos
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_vendedor', 'id_usuario');
    }

    // Un usuario puede tener muchas compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede tener muchos favoritos
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede dejar muchas reseñas
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'id_usuario', 'id_usuario');
    }
}