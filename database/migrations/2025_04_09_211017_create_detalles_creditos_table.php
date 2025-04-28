<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detalles_creditos', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_credito');
            $table->foreign(columns:'id_credito')->references('id')->on(table: 'creditos');
            
            $table->integer('numero_cuota');
            $table->decimal('valor_cuota', 12, 2);
            $table->date('fecha_vencimiento');
            $table->date('fecha_pago')->nullable();
            $table->string('estado_cuota')->default('Pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_creditos');
    }
};

