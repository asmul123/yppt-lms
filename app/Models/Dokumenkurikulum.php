<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenkurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahunpelajaran_id',
        'kurikulum_id',
        'juduldokumen',
        'jenisdokumen',
        'ukurandokumen'
    ];
    
    public function Tahunpelajaran()
    {
        return $this->belongsTo(Tahunpelajaran::class);
    }
}
