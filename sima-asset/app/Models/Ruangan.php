<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'kode_ruangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventarises()
    {
        return $this->hasMany(Inventaris::class, 'ruangan_id');
    }

    public function pemeliharaanAsets()
    {
        return $this->hasMany(PemeliharaanAset::class);
    }
}
