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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor');
            $table->foreign('id_proveedor')->references('id')->on(table: 'proveedores')->onDelete('cascade');
            $table->date('fecha_compra');
            $table->string('numero_remito');
            $table->string('numero_factura')->nullable();
            $table->decimal('total_compra',10,2);
            $table->string('estado_compra');
            $table->timestamps(); 
            $table->unique(['id_proveedor', 'numero_remito']); // Índice único compuesto
            $table->unique(['id_proveedor', 'numero_factura']); // Índice único compuesto
        });
    }

    /**
     * Reverse the migrations.
     */
        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
