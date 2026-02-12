<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documento_tag', function (Blueprint $table) {
            $table->foreignId('documento_id')->constrained('documentos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['documento_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_tag');
    }
};
