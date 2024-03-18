<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahunpelajaran_id',
        'rombonganbelajar_id',
        'matapelajaran',
        'user_id',
    ];
    
    public function Rombonganbelajar()
    {
        return $this->belongsTo(Rombonganbelajar::class);
    }
}
