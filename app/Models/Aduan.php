<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;

    protected $table = 'aduan';
    protected $primaryKey = 'id_aduan';

    protected $fillable = [
        'id_pengirim',
        'pengirim_role',
        'judul',
        'kategori',
        'deskripsi',
        'lampiran',
        'status_aduan',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }

    public function komentar()
    {
        return $this->hasMany(AduanKomentar::class, 'id_aduan');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status_aduan', $status);
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeByPengirimRole($query, $role)
    {
        return $query->where('pengirim_role', $role);
    }
}
