<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{   
    use HasFactory;
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'status',
        'user_id',
        'gambar_kamar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function keluhan()
    {
        return $this->hasMany(Keluhan::class);
    }

    public function kontraks()
    {
        return $this->hasMany(Kontrak::class);
    }
}