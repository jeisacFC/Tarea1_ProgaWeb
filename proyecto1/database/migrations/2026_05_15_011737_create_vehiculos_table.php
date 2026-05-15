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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id_vehiculo');
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->integer('anio');
            $table->decimal('precio', 10, 2);
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('id_vendedor');
            $table->unsignedInteger('id_ubicacion')->nullable();
            $table->enum('estado', ['disponible', 'vendido'])->default('disponible');
            $table->dateTime('fecha_publicacion')->nullable();
            $table->timestamps();

            $table->foreign('id_vendedor')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('id_ubicacion')
                ->references('id_ubicacion')
                ->on('ubicaciones')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
