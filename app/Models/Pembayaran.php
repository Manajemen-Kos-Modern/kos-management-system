<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'kontrak_id',
        'user_id',
        'harga',
        'metode_pembayaran',
        'bukti_transfer',
        'status',
        'created_at',
        'updated_at'
    ];

    
    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}