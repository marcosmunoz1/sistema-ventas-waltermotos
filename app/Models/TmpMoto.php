<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpMoto extends Model
{
    use HasFactory;

    protected $table = 'tmp_motos';
    public function moto()
    {
        return $this->belongsTo(Moto::class, 'id_moto', 'id');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_moto');
        // 'marca_moto' es la columna en tmp_motos que tiene el id de la marca
    }
    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'id_nacionalidad');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class, 'id_deposito');
    }

    protected $fillable = [
        'id_nacionalidad', 'id_deposito', 'marca_moto', 'modelo_moto', 'dominio', 'cilindrada_moto',
        'color_moto', 'anio_moto', 'km_moto', 'es_usada', 'nr_certificado', 'dnrpa', 'nr_motor',
        'nr_chasis', 'precio_compra', 'precio_venta', 'estado_moto', 'condicion', 'session_id'
    ];
}

