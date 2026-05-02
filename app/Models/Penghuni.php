<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $table = 'penghuni';
    protected $primaryKey = 'id_penghuni';
    
    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'email',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'foto_profil',
        'status_penghuni'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class, 'id_penghuni');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_penghuni');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_penghuni');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}