<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detalles_creditos', function (Blueprint $table) {
            $table->decimal('interes_mora', 10, 2)->default(0)->after('valor_cuota');
        });

        Schema::table('creditos', function (Blueprint $table) {
            $table->decimal('total_interes', 10, 2)->default(0)->after('saldo_credito');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->decimal('total_interes', 10, 2)->default(0)->after('total_pago');
        });
    }

    public function down()
    {
        Schema::table('detalles_creditos', function (Blueprint $table) {
            $table->dropColumn('interes_mora');
        });

        Schema::table('creditos', function (Blueprint $table) {
            $table->dropColumn('total_interes');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('total_interes');
        });
    }
};
