<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('destinasi')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->foreignId('kategori_id')->nullable()->after('kategori')
                    ->constrained('kategori')->nullOnDelete()->index();
            });
        }

        if (Schema::hasTable('galeri')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->foreignId('kategori_id')->nullable()->after('kategori')
                    ->constrained('kategori')->nullOnDelete()->index();
            });
        }

        if (Schema::hasTable('informasi')) {
            Schema::table('informasi', function (Blueprint $table) {
                $table->foreignId('kategori_id')->nullable()->after('kategori')
                    ->constrained('kategori')->nullOnDelete()->index();
            });
        }

        if (Schema::hasTable('umkms')) {
            Schema::table('umkms', function (Blueprint $table) {
                $table->foreignId('kategori_id')->nullable()->after('kontak')
                    ->constrained('kategori')->nullOnDelete()->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destinasi')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }

        if (Schema::hasTable('galeri')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }

        if (Schema::hasTable('informasi')) {
            Schema::table('informasi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }

        if (Schema::hasTable('umkms')) {
            Schema::table('umkms', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }
    }
};
