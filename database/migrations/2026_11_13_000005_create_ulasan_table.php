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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->increments('id_ulasan');
            $table->unsignedInteger('id_user');
            // unique() karena satu reservasi hanya boleh punya satu ulasan
            $table->unsignedInteger('id_reservasi')->unique();
            $table->unsignedTinyInteger('rating'); // 1 sampai 5
            $table->text('komentar');
            $table->string('foto_ulasan')->nullable();
            $table->date('tanggal_ulasan');
            $table->enum('status', ['menunggu', 'tampil', 'disembunyikan'])->default('menunggu');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
