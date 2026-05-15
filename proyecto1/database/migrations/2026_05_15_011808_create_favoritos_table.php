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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->increments('id_favorito');
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_vehiculo');
            $table->dateTime('fecha_agregado')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('nota', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('id_vehiculo')
                ->references('id_vehiculo')
                ->on('vehiculos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
