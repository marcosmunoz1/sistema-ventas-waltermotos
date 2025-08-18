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
        Schema::create('tmp_motos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nacionalidad');
            $table->unsignedBigInteger('id_deposito');
            $table->string('marca_moto');
            $table->string('modelo_moto');
            $table->string('dominio')->nullable();
            $table->integer('cilindrada_moto');
            $table->string('color_moto');
            $table->string('anio_moto');
            $table->integer('km_moto');
            $table->boolean('es_usada');
            $table->string('nr_certificado')->nullable();
            $table->string('dnrpa')->nullable();
            $table->string('nr_motor');
            $table->string('nr_chasis');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->string('estado_moto')->nullable();
            $table->string('imagen_moto')->nullable();
            $table->enum('condicion', ['vendida', 'en_stock', 'garantia', 'devuelta'])->default('en_stock');
            $table->string('session_id'); // para asociar a la sesión actual
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_motos');
    }
};
