<?php

namespace App\Models;

use App\Models\kegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kegiatan_relawan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_relawan';
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo(kegiatan::class, 'id_kegiatan');
    }

    public function relawan()
    {
        return $this->belongsTo(User::class, 'id_relawan');
    }
}
