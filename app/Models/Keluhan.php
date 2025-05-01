<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'keterangan',
        'status',
        'jenis_keluhan'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
