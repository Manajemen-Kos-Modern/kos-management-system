<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{   
    protected $table = 'kontraks';

    protected $fillable = [
        'user_id',
        'kamar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}