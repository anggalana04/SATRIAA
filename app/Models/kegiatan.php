<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $fillable = [
        'nama',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_relawan_dibutuhkan',
        'jumlah_relawan_terdaftar',
        'kategori',
        'lokasi',
        'status',
        'kontak',
        'organisasi_id',
        'foto'
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function daftar_kegiatan()
    {
        return $this->hasMany(PendaftarKegiatan::class);
    }

    public function kegiatan_detail()
    {
        return $this->hasMany(kegiatan_relawan::class);
    }
}
