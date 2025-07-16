<?php

namespace App\Models;

use App\Models\Organisasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';
    protected $guarded = ['id'];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksiDonasi()
    {
        return $this->hasMany(transaksi_donasi::class);
    }
}
