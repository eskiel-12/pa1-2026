<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['galeri', 'umkms', 'banners', 'kontak', 'destinasi', 'berita', 'informasi'];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'user_id')) {
                continue;
            }

            // Desired constraint name
            $desired = $table . '_user_id_foreign';

            // Check if a FK already exists referencing users
            $rows = DB::select("SELECT CONSTRAINT_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = 'user_id' AND REFERENCED_TABLE_NAME = 'users'", [$table]);

            if (!empty($rows)) {
                $existing = $rows[0]->CONSTRAINT_NAME;
                // If constraint exists but with different name, drop it first
                if ($existing !== $desired) {
                    DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$existing}`");
                    // add with desired name
                    DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `{$desired}` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL");
                }
                // if existing has desired name, nothing to do
            } else {
                // No existing FK -> add
                DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `{$desired}` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['galeri', 'umkms', 'banners', 'kontak', 'destinasi', 'berita', 'informasi'];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'user_id')) {
                continue;
            }

            $desired = $table . '_user_id_foreign';

            $rows = DB::select("SELECT CONSTRAINT_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = 'user_id' AND REFERENCED_TABLE_NAME = 'users'", [$table]);

            if (!empty($rows)) {
                $existing = $rows[0]->CONSTRAINT_NAME;
                // Drop FK if found
                DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$existing}`");
            }
        }
    }
};
