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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente', 50);
            $table->string('apellido_cliente', 20);
            $table->string('cuit_cliente', 20);
            $table->string('dni_cliente', 11);
            $table->date('fecha_nacimiento_cliente');
            $table->string('celular_cliente', 20);
            $table->string('email_cliente', 200);
            $table->enum('estado_civil_cliente', ['Soltero', 'Casado', 'En concubinato']);

            $table->unsignedBigInteger('id_conyugue_cliente');
            $table->foreign('id_conyugue_cliente')
            ->references('id')
            ->on('conyugues')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
