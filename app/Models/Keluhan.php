<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $fillable = [
        'user_id',
        'kamar_id',
        'keterangan',
        'status',
        'jenis_keluhan',
        'created_at',
        'updated_at'
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
