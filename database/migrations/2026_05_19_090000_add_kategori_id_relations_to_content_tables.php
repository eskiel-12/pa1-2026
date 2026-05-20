<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->ensureKategoriRelation('destinasi', 'kategori', 'kategori_id', 'destinasi_kategori_id_foreign', 'kategori');
        $this->ensureKategoriRelation('galeri', 'kategori', 'kategori_id', 'galeri_kategori_id_foreign', 'kategori');
        $this->ensureKategoriRelation('informasi', 'kategori', 'kategori_id', 'informasi_kategori_id_foreign', 'kategori');
        $this->ensureKategoriRelation('umkms', 'kontak', 'kategori_id', 'umkms_kategori_id_foreign', 'kategori');
    }

    public function down(): void
    {
        $this->dropKategoriRelation('destinasi');
        $this->dropKategoriRelation('galeri');
        $this->dropKategoriRelation('informasi');
        $this->dropKategoriRelation('umkms');
    }

    private function ensureKategoriRelation(string $tableName, string $afterColumn, string $column, string $constraintName, string $referencedTable): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        $hasColumn = Schema::hasColumn($tableName, $column);
        $hasForeign = $this->hasForeignKey($tableName, $column, $referencedTable);

        if (! $hasColumn) {
            Schema::table($tableName, function (Blueprint $table) use ($column, $afterColumn, $referencedTable, $constraintName, $tableName) {
                $table->foreignId($column)->nullable()->after($afterColumn);
                $table->foreign($column, $constraintName)
                    ->references('id')
                    ->on($referencedTable)
                    ->nullOnDelete();
                $table->index($column, $tableName.'_'.$column.'_index');
            });
            return;
        }

        if (! $hasForeign) {
            Schema::table($tableName, function (Blueprint $table) use ($column, $referencedTable, $constraintName) {
                $table->foreign($column, $constraintName)
                    ->references('id')
                    ->on($referencedTable)
                    ->nullOnDelete();
            });
        }
    }

    private function hasForeignKey(string $table, string $column, string $referencedTable): bool
    {
        $database = DB::getDatabaseName();

        $foreign = DB::table('information_schema.key_column_usage')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('column_name', $column)
            ->where('referenced_table_name', $referencedTable)
            ->where('referenced_column_name', 'id')
            ->first();

        return (bool) $foreign;
    }

    private function dropKategoriRelation(string $table): void
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'kategori_id')) {
            return;
        }

        Schema::table($table, function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_id');
        });
    }
};
