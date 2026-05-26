<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->foreignId('destinasi_id')->nullable()->constrained('destinasi')->onDelete('cascade');
            $table->string('tipe')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropForeign(['destinasi_id']);
            $table->dropColumn(['destinasi_id', 'tipe']);
        });
    }
};