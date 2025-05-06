<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $primaryKey = 'id_venta';
    
    protected $fillable = [
        'total_pago', 
        'total_interes',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function moto(){
        return $this->belongsTo(Moto::class, 'id_moto');
    }

    public function creditos(){
        return $this->hasMany(Credito::class, 'id_venta');
    }

}
