<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table ='pegawai';
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->belongsTo(Units::class);
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class);
    }

    public function bukti()
    {
        return $this->hasMany(Bukti::class);
    }
    
    
}
