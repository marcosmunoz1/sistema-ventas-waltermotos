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
            $table->unsignedBigInteger('id_compra')->after('id')->nullable();

            $table->foreign('id_compra')
                  ->references('id')
                  ->on('compras')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmp_motos', function (Blueprint $table) {
            $table->dropForeign(['id_compra']);
            $table->dropColumn('id_compra');
        });
    }
};
