<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->char('codigo', 2)->unique(); // ej: "04"
            $table->string('nombre', 120);
            $table->timestamps();
        });

        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnUpdate()->restrictOnDelete();
            $table->char('codigo', 4)->unique(); // ej: "0401" (dep+prov)
            $table->string('nombre', 120);
            $table->timestamps();

            $table->index(['departamento_id', 'nombre']);
        });

        Schema::create('distritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provincia_id')->constrained('provincias')->cascadeOnUpdate()->restrictOnDelete();
            $table->char('codigo', 6)->unique(); // ej: "040101" (dep+prov+dist)
            $table->string('nombre', 120);
            $table->timestamps();

            $table->index(['provincia_id', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distritos');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('departamentos');
    }
};
