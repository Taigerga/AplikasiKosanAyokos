<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    
    protected $fillable = [
        'id_kos', 'nomor_kamar', 'tipe_kamar', 'harga', 'luas_kamar',
        'kapasitas', 'fasilitas_kamar', 'foto_kamar', 'status_kamar'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    // Relationships
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }

    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class, 'id_kamar');
    }

    public function penghuni()
    {
        return $this->hasManyThrough(
            Penghuni::class,
            KontrakSewa::class,
            'id_kamar',
            'id_penghuni',
            'id_kamar',
            'id_penghuni'
        )->where('kontrak_sewa.status_kontrak', 'aktif');
    }
}