<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nacionalidad', 'id_compra', 'id_deposito', 'id_marca', 'modelo_moto', 'dominio',
        'cilindrada_moto', 'color_moto', 'anio_moto', 'km_moto', 'es_usada', 'nr_certificado',
        'dnrpa', 'nr_motor', 'nr_chasis', 'fecha_compra_moto', 'fecha_venta_moto',
        'precio_compra', 'precio_venta', 'estado_moto', 'imagen_moto'
    ];

    // Relación con la tabla marcas
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'id_nacionalidad');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class, 'id_deposito');
    }




}
