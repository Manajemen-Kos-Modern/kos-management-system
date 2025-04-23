<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Keluhans()
    {
        return $this->hasMany(Keluhan::class);
    }
}
