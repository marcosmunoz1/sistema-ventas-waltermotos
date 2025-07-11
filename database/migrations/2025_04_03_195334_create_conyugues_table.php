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
        Schema::create('conyugues', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_conyugue', 50);
            $table->string('nombre_apellido', 20);
            $table->string('dni_conyugue', 11)->unique();
            $table->date('fecha_nacimiento_conyugue');
            $table->string('celular_conyugue', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conyugues');
    }
};
