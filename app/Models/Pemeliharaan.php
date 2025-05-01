<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeliharaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id',
        'status',
        'keterangan'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
