<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('kontak', 'user_id')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')
                      ->nullable()
                      ->after('maps_url')
                      ->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('kontak', 'user_id')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
