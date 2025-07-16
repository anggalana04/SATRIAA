<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profil_relawan extends Model
{
    use HasFactory;

    // Define the table name if different from the pluralized form
    protected $table = 'profil_relawan';

    // Fillable fields for mass assignment
    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'keahlian',
        'pengalaman',
        'pendidikan',
        'foto',
        'user_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
