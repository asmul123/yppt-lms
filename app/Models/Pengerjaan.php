<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'penugasan_id',
        'rekaman',
        'status',
        'user_id'
    ];

    
    public function Penugasan()
    {
        return $this->belongsTo(Penugasan::class);
    }
}
