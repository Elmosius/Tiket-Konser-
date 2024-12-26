<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // sesuain aja sma database
    protected $fillable = [
        'id',
        'username',
        'nama',
        'email',
        'password',
        'nama',
        'telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'role',
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo{
        return $this->belongsTo(Role::class, "id");
    }
}