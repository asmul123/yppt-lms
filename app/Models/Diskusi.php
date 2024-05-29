<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembelajaran_id',
        'diskusi',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
