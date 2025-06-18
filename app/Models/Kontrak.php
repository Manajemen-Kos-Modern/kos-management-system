<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // app/Models/Kontrak.php
// app/Models/Kontrak.php
public function kamar()
{
    return $this->belongsTo(Kamar::class, 'kamar_id');
}


}
