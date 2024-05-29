<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'diskusi_id',
        'tanggapan',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
