<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode_barang',
        'tahun',
        'satuan',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'kondisi'
    ];
    
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }

    public function pemeliharaanAsets()
    {
        return $this->hasMany(PemeliharaanAset::class);
    }
}
