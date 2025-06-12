<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'tanggal_mulai',
        'durasi_sewa', // <- ini harus ada
        'tanggal_selesai',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(\App\Models\Pembayaran::class, 'kontrak_id');
    }
}
