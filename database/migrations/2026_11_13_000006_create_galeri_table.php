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
        // Tabel untuk halaman Galeri 
        Schema::create('galeri', function (Blueprint $table) {
            $table->increments('id_galeri');
            $table->string('judul', 100);
            $table->string('kategori', 50);
            $table->string('foto');
            $table->enum('status', ['tampil', 'disembunyikan'])->default('tampil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
