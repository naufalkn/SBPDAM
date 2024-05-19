<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;
    protected $table = 'munit';
    // protected $primaryKey = 'kd_unit';
    protected $fillable = [
        'kd_unit',
        'nm_unit',
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function adminunit()
    {
        return $this->belongsTo(AdminUnit::class);
    }
}
