<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id_pago');
            $table->unsignedInteger('id_compra');
            $table->string('metodo_pago', 50);
            $table->decimal('monto', 10, 2);
            $table->dateTime('fecha_pago')->nullable();
            $table->string('estado', 50)->default('pendiente');
            $table->timestamps();

            $table->foreign('id_compra')
                ->references('id_compra')
                ->on('compras')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
