<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('akomodasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kontak')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->index('lokasi');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('akomodasis');
    }
};
