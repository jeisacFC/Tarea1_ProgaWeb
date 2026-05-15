<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_compra',
        'metodo_pago',
        'monto',
        'fecha_pago',
        'estado',
    ];

    protected $casts = [
        'monto' => 'float',
        'fecha_pago' => 'datetime',
    ];

    // Un pago pertenece a una compra
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }
}
