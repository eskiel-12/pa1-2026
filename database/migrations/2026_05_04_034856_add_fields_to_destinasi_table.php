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
        Schema::table('destinasi', function (Blueprint $table) {
            // Columns already exist in create table migration, only add url_gambar if needed
            if (!Schema::hasColumn('destinasi', 'url_gambar')) {
                $table->string('url_gambar')->nullable()->after('gambar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            if (Schema::hasColumn('destinasi', 'url_gambar')) {
                $table->dropColumn('url_gambar');
            }
        });
    }
};
