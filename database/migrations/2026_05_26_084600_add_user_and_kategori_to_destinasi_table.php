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
            if (!Schema::hasColumn('destinasi', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('url_gambar');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('destinasi', 'kategori_id')) {
                $table->unsignedBigInteger('kategori_id')->nullable()->after('kategori');
                $table->index('kategori_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            if (Schema::hasColumn('destinasi', 'user_id')) {
                $table->dropIndex(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('destinasi', 'kategori_id')) {
                $table->dropIndex(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
        });
    }
};
