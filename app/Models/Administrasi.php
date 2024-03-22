<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tahunpelajaran_id',
        'dokumenkurikulum_id',
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
    
    public function Dokumenkurikulum()
    {
        return $this->belongsTo(Dokumenkurikulum::class);
    }
    
    public function Pembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class);
    }
}
