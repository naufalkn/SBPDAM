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
        'bukti_pemasangan',
        'bukti_pencabutan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
