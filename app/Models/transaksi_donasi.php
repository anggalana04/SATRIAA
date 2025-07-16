<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_donasi extends Model
{
    use HasFactory;
    protected $table = 'transaksi_donasi';
    protected $guarded = ['id'];

    public function donatur()
    {
        return $this->belongsTo(User::class);
    }

    public function donasi()
    {
        return $this->belongsTo(donasi::class);
    }
}
