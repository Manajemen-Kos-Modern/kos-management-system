<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    protected $fillable = [
        'kamar_id',
        'status',
        'keterangan',
        'created_at',
        'updated_at'
    ];
    public function Kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
