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
            $table->string('nama');
            $table->foreignId('user_id')->constrained('users');
            $table->string('email')->nullable();
            $table->text('pekerjaan');
            $table->bigInteger('no_identitas');
            $table->bigInteger('no_telepon');

            // Detail Alamat
            $table->text('dukuh');
            $table->integer('rt');
            $table->integer('rw');
            $table->text('kelurahan');
            $table->text('kecamatan');
            $table->integer('kode_pos');
            $table->text('nama_jalan');
            $table->integer('jmlh_penghuni');
            $table->string('nm_unit')->nullable();
            $table->string('kd_unit')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->text('keterangan')->nullable();
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
