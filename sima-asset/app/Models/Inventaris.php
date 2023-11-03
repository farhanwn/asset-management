<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_inventaris',
        'aset_id',
        'ruangan_id',
        'kondisi'
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
