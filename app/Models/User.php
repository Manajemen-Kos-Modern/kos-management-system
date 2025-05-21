<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'foto_profile',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi user ke kontrak aktif (1:1)
    public function kontrak()
    {
        return $this->hasOne(Kontrak::class)->where('status', 'aktif');
    }
    
    // Relasi user ke kamar melalui kontrak
    public function kamar()
    {
        return $this->hasOneThrough(Kamar::class, Kontrak::class, 'user_id', 'id', 'id', 'kamar_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    // public function kamar()
    // {
    //     return $this->hasOne(Kamar::class);
    // }
}