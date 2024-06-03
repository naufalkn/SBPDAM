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
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->string('kd_unit', 2);
            $table->foreign('kd_unit')->references('kd_unit')->on('munit');
            $table->string('bukti_pemasangan');
            $table->string('bukti_pencabutan');
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
