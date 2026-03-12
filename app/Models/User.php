<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

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

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function scoreHistory()
    {
        return $this->hasMany(ScoreHistory::class);
    }

    public function totalPoints()
    {
        return $this->scoreHistory()->sum('points');
    }
}
