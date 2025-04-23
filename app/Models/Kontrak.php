<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $fillable = [
        'user_id',
        'kamar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'created_at',
        'updated_at'
    ];
    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Kamars()
    {
        return $this->belongsTo(Kamar::class);
    }
}
