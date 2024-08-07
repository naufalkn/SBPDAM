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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->string('nama');
            $table->string('email');
            $table->string('no_telepon', 15);
            $table->bigInteger('total_bayar');
            $table->string('order_id');
            $table->string('channel');
            $table->enum('status', ['PENDING', 'SUCCESS', 'FAILED']);
            $table->string('snap_token')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
