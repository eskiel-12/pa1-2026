<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('banners', 'user_id')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')
                      ->nullable()
                      ->after('url_gambar')
                      ->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('banners', 'user_id')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
