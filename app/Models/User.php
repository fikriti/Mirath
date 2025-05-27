<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'user_add_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',
        'active' => 'integer',
    ];

    /**
     * علاقة: المستخدم أُضيف بواسطة مستخدم تاني.
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'user_add_id');
    }

    /**
     * علاقة: المستخدمين اللي أنا ضايفهم.
     */
    public function addedUsers()
    {
        return $this->hasMany(User::class, 'user_add_id');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }

    /**
     * Check if user is active.
     */
   


}
