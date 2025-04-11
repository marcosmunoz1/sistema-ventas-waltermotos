<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_venta');
            $table->foreign(columns:'id_venta')->references('id_venta')->on(table: 'ventas')->onDelete('cascade');
            $table->decimal('valor_financiado', 12, 2);
            $table->decimal('saldo_credito', 12, 2);
            $table->integer('cantidad_cuotas');
            $table->decimal('interes', 5, 2);
            $table->decimal('monto_cuota', 12, 2);
            $table->string('estado_credito')->default('Pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
