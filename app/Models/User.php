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
    public function aduan() { return $this->hasMany(Aduan::class, 'id_pengirim'); }
    public function aduanKomentar() { return $this->hasMany(AduanKomentar::class, 'id_pengirim'); }

    public function profile()
    {
        return $this->pemilik ?? $this->penghuni;
    }

    public function statusAktif(): bool
    {
        if ($this->role === 'admin') return true;
        $profile = $this->profile();
        if (!$profile) return false;
        return $profile->isAktif();
    }

    public function isDibatasi(): bool
    {
        if ($this->role === 'admin') return false;
        $profile = $this->profile();
        if (!$profile) return false;
        return $profile->isDibatasi();
    }

    public function isDiblokir(): bool
    {
        if ($this->role === 'admin') return false;
        $profile = $this->profile();
        if (!$profile) return false;
        return $profile->isDiblokir();
    }

    public function getStatusAkunAttribute()
    {
        if ($this->role === 'admin') return 'aktif';
        $profile = $this->profile();
        if (!$profile) return null;
        return $this->role === 'pemilik' ? $profile->status_pemilik : $profile->status_penghuni;
    }

    public function username()
    {
        return 'username';
    }
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}