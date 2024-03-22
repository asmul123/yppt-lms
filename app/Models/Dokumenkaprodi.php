<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenkaprodi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tahunpelajaran_id',
        'juduldokumen',
        'jenisdokumen',
        'ukurandokumen'
    ];
    
    public function Tahunpelajaran()
    {
        return $this->belongsTo(Tahunpelajaran::class);
    }
}
