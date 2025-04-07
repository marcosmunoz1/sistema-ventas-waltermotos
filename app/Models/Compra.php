<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
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
        return DB::transaction(function () use ($data) {
            //dd($data);
            $compra = self::create([
                'id_proveedor' => $data['id_proveedor'],
                'fecha_compra' => $data['fecha_compra'],
                'numero_compra' => 12,
                'numero_remito' => $data['numero_remito'] ?? '',
                'numero_factura' => $data['numero_factura'] ?? '',
                'total_compra' => 21,
                'estado_compra' => 1,
            ]);

            $compra->guardamoto($data);

            return $compra;
        });
    }


    public function guardamoto($data)
        {
            foreach ($data['motos'] as $index => $motoData) {
                Moto::create([
                    'id_nacionalidad' => $this->id,
                    'id_compra' => $this->id,
                    'id_deposito' => $motoData['deposito'],
                    'id_marca' => $motoData['marca'],
                    'modelo_moto' => $motoData['modelo'],
                    'dominio' => $motoData['dominio'],
                    'cilindrada_moto' => $motoData['cilindrada'],
                    'color_moto' => $motoData['color'],
                    'anio_moto' => $motoData['anio_moto'],
                    'km_moto' => $motoData['km'],
                    'es_usada' => $motoData['es_usada'],
                    'nr_certificado' => $motoData['nr'],
                    'dnrpa' => $motoData['dnrpa'],
                    'nr_motor' => $motoData['nr_motor'],
                    'nr_chasis' => $motoData['nr_chasis'],
                    'fecha_compra_moto' => $motoData['fecha_compra'],
                    'fecha_venta_moto' => $motoData['fecha_venta'],
                    'precio_compra' => $motoData['precio_compra'],
                    'precio_venta' => $motoData['precio_venta'],
                    'estado_moto' => $motoData['estado_moto'] ?? null,
                    'imagen_moto' => $motoData['imagen'] ?? null,
                ]);
            }
        }

}
