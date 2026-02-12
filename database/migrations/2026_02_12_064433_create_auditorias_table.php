<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();

            $table->string('accion', 30);  // UPLOAD, UPDATE, DELETE, DOWNLOAD, LOGIN...
            $table->string('entidad', 30); // DOCUMENTO, PROYECTO, SECTOR...
            $table->unsignedBigInteger('entidad_id')->nullable();

            $table->json('meta')->nullable();
            $table->string('ip', 45)->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['usuario_id', 'created_at']);
            $table->index(['entidad', 'entidad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditorias');
    }
};
