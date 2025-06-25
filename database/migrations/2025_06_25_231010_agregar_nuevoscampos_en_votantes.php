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
        Schema::table('votantes', function (Blueprint $table) {
            $table->foreignId('genero_id')->nullable(true)->constrained('generos')->onDelete('set null');
            $table->string('altitud');
            $table->string('longitud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('votantes', function (Blueprint $table) {
            $table->dropColumn('genero_id');
            $table->dropColumn('altitud');
            $table->dropColumn('longitud');
        });
    }
};
