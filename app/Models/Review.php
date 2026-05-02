<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id_review';
    
    protected $fillable = [
        'id_kos', 'id_penghuni', 'id_kontrak', 'rating', 'komentar', 'foto_review'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($review) {
            if ($review->rating < 1 || $review->rating > 5) {
                throw new \Exception('Rating harus antara 1 dan 5');
            }
        });
        
        static::updating(function ($review) {
            if ($review->rating < 1 || $review->rating > 5) {
                throw new \Exception('Rating harus antara 1 dan 5');
            }
        });
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni');
    }

    public function kontrak()
    {
        return $this->belongsTo(KontrakSewa::class, 'id_kontrak');
    }

    public function scopeRatingTertinggi($query)
    {
        return $query->orderBy('rating', 'desc');
    }
}