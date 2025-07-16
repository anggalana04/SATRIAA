<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\donasi;
use App\Models\kegiatan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'jenis',
    ];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function donasi()
    {
        return $this->hasMany(donasi::class);
    }

    public function profil()
    {
        return $this->hasOne(profil_relawan::class);
    }

    public function organiasi()
    {
        return $this->hasOne(organisasi::class);
    }

    public function daftar_kegiatan()
    {
        return $this->hasMany(PendaftarKegiatan::class);
    }

    public function daftar_donasi()
    {
        return $this->hasMany(transaksi_donasi::class);
    }

    public function kegiatan_relawan()
    {
        return $this->hasMany(kegiatan_relawan::class);
    }
    public function transaksiDonasi()
    {
        return $this->hasMany(transaksi_donasi::class);
    }
}

