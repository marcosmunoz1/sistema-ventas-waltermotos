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
        Schema::table('motos', function (Blueprint $table) {
            // eliminar columna anterior
            if (Schema::hasColumn('motos', 'marca_moto')) {
                $table->dropColumn('marca_moto');
            }

            // agregar nueva columna id_marca
            $table->unsignedBigInteger('id_marca')->nullable()->after('id');

            // definir foreign key
            $table->foreign('id_marca')
                ->references('id')
                ->on('marcas')
                ->onDelete('set null'); // o cascade según necesidad
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motos', function (Blueprint $table) {
            $table->dropForeign(['id_marca']);
            $table->dropColumn('id_marca');

            $table->string('marca_moto')->nullable();
        });
    }
};
