<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Compra extends Model
{
    Use HasFactory;

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
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

        DB::transaction(function () use ($data) {
            // 1. Crear compra principal
            $compra = self::create([
                'id_proveedor' => $data['id_proveedor'],
                'fecha_compra' => $data['fecha_compra'],
                'numero_compra' => 12,
                'numero_remito' => $data['numero_remito'] ?? null,
                'numero_factura' => $data['numero_factura'],
                'total_compra' => 111,  // Calcula el total real
                'estado_compra' => 1,
            ]);

            $compra->guardardetalledemoto($data);

            return $compra;
        });

}

  private function guardardetalledemoto(array $data){
    foreach ($data['id_marca'] as $index => $marca) {
        $moto = Moto::create([
            'id_nacionalidad' => $data['id_nacionalidad'][$index] ,
            'id_compra' => $this->id,
            'id_deposito' => $data['id_deposito'][$index],
            'id_marca' => $data['id_marca'][$index],
            'modelo_moto' => $data['modelo_moto'][$index],
            'dominio' => $data['dominio'][$index],
            'cilindrada_moto' => $data['cilindrada_moto'][$index],
            'color_moto' => $data['color_moto'][$index],
            'anio_moto' => $data['anio_moto'][$index],
            'km_moto' => $data['km_moto'][$index],
            'es_usada' => $data['es_usada'][$index],
            'nr_certificado' => $data['nr_certificado'][$index],
            'dnrpa' => $data['dnrpa'][$index],
            'nr_motor' => $data['nr_motor'][$index],
            'nr_chasis' => $data['nr_chasis'][$index],
            'fecha_compra_moto' => $data['fecha_compra'],
            'fecha_venta_moto' => null,
            'precio_compra' => $data['precio_compra'][$index],
            'precio_venta' => $data['precio_venta'][$index],
            'estado_moto' => 'En_stock',
            'imagen_moto' => $data['imagen_moto'][$index] ?? null,
        ]);
    }

  }


      /*   // 2. Crear los detalles de cada moto

 */
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
