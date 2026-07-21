<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanKomentar extends Model
{
    use HasFactory;

    protected $table = 'aduan_komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_aduan',
        'id_pengirim',
        'isi',
        'lampiran',
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class, 'id_aduan');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }
}
