<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('sectores')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('distrito_id')->constrained('distritos')->cascadeOnUpdate()->restrictOnDelete();

            $table->string('nombre', 160);
            $table->string('codigo', 50)->nullable()->index(); // opcional para ordenar/filtrar
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');

            // opcional
            $table->text('descripcion')->nullable();

            $table->timestamps();

            $table->index(['sector_id', 'distrito_id']);
            $table->unique(['sector_id', 'nombre']); // evita duplicado dentro del mismo sector
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
