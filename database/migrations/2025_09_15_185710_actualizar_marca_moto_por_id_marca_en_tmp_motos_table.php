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
        Schema::table('tmp_motos', function (Blueprint $table) {
       
            $table->dropColumn('marca_moto');
            $table->unsignedBigInteger('id_marca')->after('id'); 
            $table->foreign('id_marca')
                  ->references('id')
                  ->on('marcas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmp_motos', function (Blueprint $table) {
           
            $table->dropForeign(['id_marca']);
            $table->dropColumn('id_marca');

            $table->string('marca_moto')->nullable();
        });
    }
};