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
            $table->string('email')->unique();
            $table->text('pekerjaan');
            $table->bigInteger('no_identitas')->unique();
            $table->string('no_telepon', 15);
            $table->string('foto_identitas')->required();
            $table->date('tgl_daftar')->required();
            $table->date('tgl_aktif')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->date('tgl_nonaktif')->nullable();

            // Detail Alamat
            // $table->text('dukuh')->requaired();
            $table->unsignedBigInteger('dukuh');
            $table->foreign('dukuh')->references('id')->on('dukuh')->onUpdate('cascade');
            $table->integer('rt');
            $table->integer('rw');
            $table->unsignedBigInteger('desa');
            $table->foreign('desa')->references('id')->on('villages')->onUpdate('cascade');
            // $table->text('kelurahan');
            // $table->text('kecamatan');
            $table->integer('kode_pos');
            $table->text('nama_jalan');
            $table->integer('jmlh_penghuni');
            $table->string('nm_unit');
            $table->string('kd_unit', 2);
            $table->string('latitude');
            $table->string('longitude');

            $table->foreign('kd_unit')->references('kd_unit')->on('munit');
            $table->string('foto_rumah')->nullable();
            $table->string('nm_sambungan')->nullable();
            $table->bigInteger('no_sambungan')->nullable();
            $table->enum('jenis', ['pendaftaran', 'pengajuan']);
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('pegawai_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')->onUpdate('cascade');

            // $table->tinyInteger('status')->default(0);
            // $table->integer('is_pelanggan')->default(0);
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
