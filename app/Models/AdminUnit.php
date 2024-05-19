<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUnit extends Model
{
    use HasFactory;

    protected $table ='admin_units';
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->belongsTo(Units::class);
    }
    // public function pelanggan()
    // {
    //     return $this->belongsTo(Pelanggan::class);
    // }
}
