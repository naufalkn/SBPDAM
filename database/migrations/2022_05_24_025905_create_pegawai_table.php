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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_identitas')->required();
            $table->unsignedBigInteger('role_id')->default(3);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('kd_unit');
            $table->foreign('kd_unit')->references('kd_unit')->on('munit');
            $table->string('nm_unit')->references('nm_unit')->on('munit');
            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->string('foto_ktp')->default('default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
