<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Compra extends Model
{
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    protected $table = 'compras';

    protected $fillable = [
        'id_proveedor',
        'fecha_compra',
        'numero_remito',
        'numero_compra',
        'numero_factura',
        'total_compra',
        'estado_compra'
    ];

    //Registrar nueva compra
    public static function registrarCompra(array $data)
    {

        dd('guardamoto'); // Ver si entra acá 

    }


    public function guardamoto($data)
        {
            foreach ($data['marca'] as $index => $motoId) {
                Moto::create([
                    'id_nacionalidad' => $data['nacionalidad'][$index] ,
                    'id_compra' => $this->id,
                    'id_deposito' => $data['deposito'][$index],
                    'id_marca' => $data['marca'][$index],
                    'modelo_moto' => $data['modelo'][$index],
                    'dominio' => $data['dominio'][$index],
                    'cilindrada_moto' => $data['cilindrada'][$index],
                    'color_moto' => $data['color'][$index],
                    'anio_moto' => $data['anio'][$index],
                    'km_moto' => $data['km'][$index],
                    'es_usada' => $data['es_usada'][$index],
                    'nr_certificado' => $data['nr_certificado'][$index],
                    'dnrpa' => $data['dnrpa'][$index],
                    'nr_motor' => $data['nr_motor'][$index],
                    'nr_chasis' => $data['nr_chasis'][$index],
                    'fecha_compra_moto' => $data['fecha_compra'],
                    'fecha_venta_moto' => $data['fecha_venta'] ?? null,
                    'precio_compra' => $data['precio_compra'][$index],
                    'precio_venta' => $data['precio_venta'][$index],
                    'estado_moto' => 1,
                    'imagen_moto' => $data['imagen'][$index] ?? null,
                ]);
            }
        }

}
