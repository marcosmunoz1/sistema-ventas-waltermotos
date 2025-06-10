<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('calle')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('profesion')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('calle');
            $table->dropColumn('ciudad');
            $table->dropColumn('provincia');
            $table->dropColumn('profesion');
        });
    }
};
