<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
