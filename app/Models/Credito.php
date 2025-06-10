<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    
    protected $fillable = [
        'venta_id',
        'monto_total',
        'saldo_credito',
        'total_interes',
        'entrega',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleCredito::class, 'id_credito');
    }

    public function venta(){
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
