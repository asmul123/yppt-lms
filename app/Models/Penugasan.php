<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembelajaran_id',
        'jenispenugasan_id',
        'judultugas',
        'deskripsitugas',
        'banksoal_id',
        'acaksoal',
        'acakjawaban',
        'durasi',
        'waktumulai',
        'waktuselesai',
        'terlambat',
        'token',
        'user_id'
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
