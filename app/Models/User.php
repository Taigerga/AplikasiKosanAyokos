<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Hubungan relasi sudah benar
    public function pemilik() { return $this->hasOne(Pemilik::class, 'user_id'); }
    public function penghuni() { return $this->hasOne(Penghuni::class, 'user_id'); }
    public function admin() { return $this->hasOne(Admin::class, 'user_id'); }
    
    
    public function username()
    {
        return 'username';
    }
    public function getAuthIdentifier()
    {
        return $this->getKey(); 
    }
}