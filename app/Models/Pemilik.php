<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'id_pemilik';

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'email',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'foto_profil',
        'status_pemilik',
        'nama_bank',
        'nomor_rekening'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_pemilik');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function scopeAktif($query)
    {
        return $query->where('status_pemilik', 'aktif');
    }

    public function scopeNonaktif($query)
    {
        return $query->where('status_pemilik', 'nonaktif');
    }

    public function scopeDibatasi($query)
    {
        return $query->where('status_pemilik', 'dibatasi');
    }

    public function scopeDiblokir($query)
    {
        return $query->where('status_pemilik', 'diblokir');
    }

    public function isAktif()
    {
        return $this->status_pemilik === 'aktif';
    }

    public function isDibatasi()
    {
        return $this->status_pemilik === 'dibatasi';
    }

    public function isDiblokir()
    {
        return $this->status_pemilik === 'diblokir';
    }
}