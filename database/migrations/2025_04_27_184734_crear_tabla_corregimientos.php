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
        //
        Schema::Create('corregimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(false);
            $table->foreignId('municipio_id')->nullable(true)->constrained('municipios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('corregimientos');
    }
};
