<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dukuh extends Model
{
    use HasFactory;
    protected $table = 'dukuh';
    protected $fillable = ['nmdukuh'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
