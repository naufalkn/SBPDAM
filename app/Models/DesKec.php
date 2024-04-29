<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesKec extends Model
{
    use HasFactory;
    protected $table = 'deskec';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
