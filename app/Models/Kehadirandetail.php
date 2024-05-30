<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadirandetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kehadiran_id',
        'kehadiran',
        'user_id'
    ];
}
