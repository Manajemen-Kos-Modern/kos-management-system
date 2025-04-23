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
        'status',
        'created_at',
        'updated_at'
    ];
    public function Kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
