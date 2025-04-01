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
        Schema::create('motos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nacionalidad');
            $table->foreign('id_nacionalidad')->references('id')->on('nacionalidades')->onDelete('cascade');
            $table->unsignedBigInteger('id_compra');
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
            $table->unsignedBigInteger('id_deposito');
            $table->foreign('id_deposito')->references('id')->on('depositos')->onDelete('cascade');
            $table->string('marca_moto');
            $table->string('modelo_moto');
            $table->string('dominio');
            $table->integer('cilindrada_moto');
            $table->string('color_moto');
            $table->string('anio_moto');
            $table->integer('km_moto');
            $table->integer('es_usada');
            $table->string('nr_certificado');
            $table->string('dnrpa');
            $table->string('nr_motor');
            $table->string('nr_chasis');
            $table->date('fecha_compra_moto');
            $table->date('fecha_venta_moto')->nullable();
            $table->decimal('precio_compra',10,2);
            $table->decimal('precio_venta',10,2);
            $table->string('estado_moto');
            $table->string('imagen_moto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos');
    }
};


