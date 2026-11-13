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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->increments('id_reservasi');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_layanan');
            $table->string('kode_reservasi', 30)->unique();
            $table->date('tanggal_reservasi');
            $table->time('jam_reservasi');
            $table->text('catatan')->nullable();
            $table->enum('status_reservasi', ['menunggu', 'dikonfirmasi', 'selesai', 'dibatalkan'])
                  ->default('menunggu');
            $table->timestamps();

            // Foreign key ke tabel users dan layanan
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
