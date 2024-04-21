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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            // Data Diri
            $table->string('nama')->required();
            $table->foreignId('user_id')->constrained('users')->required();
            $table->string('email')->required();
            $table->text('pekerjaan')->required();
            $table->bigInteger('no_identitas')->required();
            $table->bigInteger('no_telepon')->required();

            // Detail Alamat
            $table->text('dukuh')->required();
            $table->integer('rt')->required();
            $table->integer('rw')->required();
            $table->text('kelurahan')->required();
            $table->text('kecamatan')->required();
            $table->integer('kode_pos')->required();
            $table->text('nama_jalan')->required();
            $table->integer('jmlh_penghuni')->required();
            $table->string('unit')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
