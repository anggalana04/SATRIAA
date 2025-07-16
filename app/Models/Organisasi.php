<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;
    protected $table = 'organisasi';
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'ketua',
        'kategori',
        'visi',
        'misi',
        'id_sertifikasi',
        'id_npwp',
        'foto',
        'rating',
        'tiktok',
        'instagram',
        'email',
        'wa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
