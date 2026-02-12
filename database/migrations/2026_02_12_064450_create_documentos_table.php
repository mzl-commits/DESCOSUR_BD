<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique(); // útil para URLs internas / rastreo
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('subido_por')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();

            $table->foreignId('tipo_documento_id')
                ->nullable()
                ->constrained('tipos_documento')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('nombre_visible', 200);
            $table->string('nombre_original', 220);
            $table->date('fecha_documento');

            $table->text('descripcion')->nullable();

            // storage
            $table->string('storage_disk', 30)->default('local');
            $table->string('storage_path', 500); // ruta interna
            $table->string('mime_type', 120)->nullable();
            $table->string('extension', 12)->nullable();
            $table->unsignedBigInteger('tamano_bytes')->default(0);

            // control
            $table->char('checksum_sha256', 64)->nullable()->index();
            $table->enum('estado', ['ACTIVO', 'ARCHIVADO'])->default('ACTIVO');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['proyecto_id', 'fecha_documento']);
            $table->index(['tipo_documento_id', 'estado']);
            $table->index('nombre_visible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
