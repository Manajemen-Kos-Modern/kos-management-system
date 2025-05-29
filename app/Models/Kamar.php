<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars'; // pastikan ini benar

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'fasilitas',
        'gambar',
        'status',
        'user_id',
    ];
     public function kontrak() {
        return $this->hasMany(Kontrak::class);
    }

    public function pemeliharaan() {
        return $this->hasMany(Pemeliharaan::class);
    }

    public function keluhan() {
        return $this->hasMany(Keluhan::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
