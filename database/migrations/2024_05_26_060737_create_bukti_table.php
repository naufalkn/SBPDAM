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
        Schema::create('bukti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai');
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->string('bukti_pemasangan')->nullable();
            $table->date('tgl_pemasangan')->nullable();
            $table->string('bukti_pencabutan')->nullable();
            $table->date('tgl_pencabutan')->nullable();
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti');
    }
};
