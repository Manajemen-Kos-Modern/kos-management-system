<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [
        'user_id',
        'pesan',
        'status',
        'waktu_kirim',
        'created_at',
        'updated_at'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
