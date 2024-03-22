<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasikaprodi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tahunpelajaran_id',
        'dokumenkaprodi_id',
        'file_administrasi',
        'keterangan',
        'pembelajaran_id',
        'status',
        'user_id'
    ];

    public function Tahunpelajaran()
    {
        return $this->belongsTo(Tahunpelajaran::class);
    }
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    
    public function Dokumenkaprodi()
    {
        return $this->belongsTo(Dokumenkaprodi::class);
    }
}
