<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table ='pelanggans';
    protected $guarded = ['id'];
    // protected $with = ['unit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->belongsTo(Units::class);
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function bukti()
    {
        return $this->hasMany(Bukti::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'desa');
    }

    
}
