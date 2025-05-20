<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Compra extends Model
{
    Use HasFactory;

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
    public function moto()
    {
        return $this->hasMany(Moto::class, 'id_compra');
        // Esto asume que en la tabla `motos` hay un campo `id_compra`
    }

    protected $table = 'compras';

    protected $fillable = [
        'id_proveedor',
        'fecha_compra',
        'numero_remito',
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
                'numero_remito' => $data['numero_remito'] ?? null,
                'numero_factura' => $data['numero_factura'],
                'total_compra' => $data['total_compra'],  // Calcula el total real
                'estado_compra' => 1,
            ]);

            $compra->guardardetalledemoto($data);

            return $compra;
        });

}

private function guardardetalledemoto(array $data)
{
    foreach ($data['id_marca'] as $index => $marca) {
        // Preparar datos básicos de la moto
        $motoData = [
            'id_nacionalidad' => $data['id_nacionalidad'][$index],
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
            'condicion' => 'en_stock'
        ];



        Moto::create($motoData); 
    }
}

 private function ActualizarCompra(array $data) {
    DB::transaction(function () use ($data) {
        // 1. Eliminar motos existentes relacionadas
        $this->moto()->delete();

        // 2. Actualizar compra principal
        $this->update([
            'id_proveedor' => $data['id_proveedor'],
            'fecha_compra' => $data['fecha_compra'],
            'numero_remito' => $data['numero_remito'] ?? null,
            'numero_factura' => $data['numero_factura'],
            'total_compra' => $data['total_compra'],
            'estado_compra' => 1,
        ]);

        // 3. Validar que los arrays existen y tienen la misma longitud
        if (!isset($data['id_marca']) || !is_array($data['id_marca'])) {
            throw new \Exception("Datos de motos no válidos");
        }

        // 4. Crear nuevas motos
        foreach ($data['id_marca'] as $index => $marca) {
            // Validar que todos los campos requeridos existen
            $requiredFields = [
                'id_nacionalidad', 'id_deposito', 'modelo_moto', 'dominio',
                'cilindrada_moto', 'color_moto', 'anio_moto', 'km_moto',
                'es_usada', 'precio_compra', 'precio_venta'
            ];

            foreach ($requiredFields as $field) {
                if (!isset($data[$field][$index])) {
                    throw new \Exception("Falta el campo {$field} para la moto {$index}");
                }
            }

            $motoData = [
                'id_nacionalidad' => $data['id_nacionalidad'][$index],
                'id_compra' => $this->id,
                'id_deposito' => $data['id_deposito'][$index],
                'id_marca' => $data['id_marca'][$index],
                'modelo_moto' => $data['modelo_moto'][$index],
                'dominio' => $data['dominio'][$index],
                'cilindrada_moto' => $data['cilindrada_moto'][$index],
                'color_moto' => $data['color_moto'][$index],
                'anio_moto' => $data['anio_moto'][$index],
                'km_moto' => $data['km_moto'][$index],
                'es_usada' => $data['es_usada'][$index] ?? false,
                'nr_certificado' => $data['nr_certificado'][$index] ?? null,
                'dnrpa' => $data['dnrpa'][$index] ?? null,
                'nr_motor' => $data['nr_motor'][$index] ?? null,
                'nr_chasis' => $data['nr_chasis'][$index] ?? null,
                'fecha_compra_moto' => $data['fecha_compra'],
                'fecha_venta_moto' => null,
                'precio_compra' => $data['precio_compra'][$index],
                'precio_venta' => $data['precio_venta'][$index],
                'estado_moto' => 'En_stock',
                'imagen_moto' => $data['imagen_moto'][$index] ?? null,
                'condicion' => 'en_stock'
            ];

            // Crear la moto y verificar si hubo error
            $moto = Moto::create($motoData);

            if (!$moto) {
                throw new \Exception("Error al crear la moto {$index}");
            }
        }
    });
}



}
