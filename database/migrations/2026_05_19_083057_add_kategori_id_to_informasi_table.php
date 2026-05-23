<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            // Only add if it doesn't exist, handled by later migration
            if (!Schema::hasColumn('informasi', 'kategori_id')) {
                $table->foreignId('kategori_id')
                      ->nullable()
                      ->constrained('kategori')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {

            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');

        });
    }
};