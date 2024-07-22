<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    use HasFactory;

    protected $table = 'bukti';

    protected $fillable = [
        'pelanggan_id',
        'pegawai_id',
        'bukti_pemasangan',
        'bukti_pencabutan',
        'bukti_pembayaran',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
