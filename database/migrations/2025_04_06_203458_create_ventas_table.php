<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            
            $table->unsignedBigInteger('id_cliente');
            $table->foreign(columns:'id_cliente')->references('id')->on(table: 'clientes');

            $table->unsignedBigInteger('id_moto');
            $table->foreign(columns:'id_moto')->references('id')->on(table: 'motos');

            $table->date('fecha_venta');
            $table->decimal('precio_venta', 10, 2);
            $table->enum('forma_pago', ['Contado', 'Credito','Tarjeta','Otro']);
            $table->decimal('total_pago', 12, 2);
            $table->enum('estado_venta', ['Pendiente', 'Pagado', 'Cancelado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
