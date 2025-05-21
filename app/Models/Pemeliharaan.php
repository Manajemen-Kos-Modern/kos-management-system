<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    protected $fillable = [
        'kamar_id',
        'status',
        'keterangan',
        'jadwal',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'jadwal' => 'datetime',
    ];
    
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}