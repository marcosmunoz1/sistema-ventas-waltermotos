<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('total_compra', 14, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('total_compra', 10, 2)->change();
        });
    }
};
