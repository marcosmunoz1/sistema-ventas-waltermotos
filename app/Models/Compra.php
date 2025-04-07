<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Compra extends Model
{
    public function proveedor(){
        return $this->belongsTo(Proveedores::class);
    }

    protected $table = 'compras';

    protected $fillable = [
        'fecha',
        'remito',
        'factura',
        'total',
        'empresa_id',
        'proveedor_id',
        'cancelada'
    ];

    //Registrar nueva compra
    public static function registrarCompra(array $data)
    {
        return DB::transaction(function () use ($data) {
            $compra = self::create([
                'id_proveedor' => $data['id_proveedor'],
                'fecha_compra' => $data['fecha_comprda'],
                'nemero_compra' => $data['nemero_compra'],
                'numero_factura' => $data['numero_factura'] ?? '',
                'total_compra' => $data['total_compra'],
                'estado_compra' => $data['estado_compra'],
            ]);

            $compra->actualizarDetalles($data);

            return $compra;
        });
    }

}
