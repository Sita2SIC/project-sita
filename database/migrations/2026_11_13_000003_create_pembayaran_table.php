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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            // unique() karena satu reservasi hanya punya satu data pembayaran (One-to-One)
            $table->unsignedInteger('id_reservasi')->unique();
            $table->unsignedInteger('total_bayar');
            $table->unsignedInteger('nominal_dp')->default(0);
            $table->unsignedInteger('sisa_bayar')->default(0);
            $table->enum('jenis_pembayaran', ['dp', 'lunas'])->default('dp');
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_konfirmasi', 'dp', 'lunas'])
                  ->default('belum_bayar');
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
