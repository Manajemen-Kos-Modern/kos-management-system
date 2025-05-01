<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kontrak_id',
        'user_id',
        'harga',
        'metode_pembayaran',
        'status'
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
