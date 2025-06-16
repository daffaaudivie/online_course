<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Online_course extends Model
{
    use HasFactory;
    protected $table = 'online_course';
    protected $primaryKey = 'id_online_course';

   protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'harga',
        'rating',
        'jumlah_viewers',
        'bahasa',
        'tipe',
        'durasi',
        'level',
        'platform',
        'link',
    ];

    protected $casts = [
        'rating' => 'float',
        'jumlah_viewers' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Accessors
    public function getFormattedRatingAttribute()
    {
        return $this->rating ? number_format($this->rating, 1) : '-';
    }

    public function getFormattedViewersAttribute()
    {
        if (!$this->jumlah_viewers) return '-';
        
        if ($this->jumlah_viewers >= 1000000) {
            return number_format($this->jumlah_viewers / 1000000, 1) . 'M';
        } elseif ($this->jumlah_viewers >= 1000) {
            return number_format($this->jumlah_viewers / 1000, 1) . 'K';
        }
        
        return number_format($this->jumlah_viewers);
    }

    public function getHargaBadgeAttribute()
    {
        return strtolower($this->harga) === 'gratis' ? 'success' : 'warning';
    }

    public function getLevelBadgeAttribute()
    {
        switch (strtolower($this->level)) {
            case 'pemula':
                return 'success';
            case 'menengah':
                return 'warning';
            case 'lanjutan':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    // Scopes
    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', 'like', '%' . $category . '%');
    }

    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeByLanguage($query, $language)
    {
        return $query->where('bahasa', $language);
    }

    public function scopeFree($query)
    {
        return $query->where('harga', 'like', '%gratis%');
    }

    public function scopePaid($query)
    {
        return $query->where('harga', 'like', '%berbayar%');
    }

    public function scopeHighRated($query, $minRating = 4.0)
    {
        return $query->where('rating', '>=', $minRating);
    }

    public function scopePopular($query, $minViewers = 1000)
    {
        return $query->where('jumlah_viewers', '>=', $minViewers);
    }

    // Static methods for statistics
    public static function getTotalCourses()
    {
        return self::count();
    }

    public static function getAverageRating()
    {
        return self::whereNotNull('rating')->avg('rating');
    }

    public static function getCategoriesCount()
    {
        return self::select('kategori')
            ->groupBy('kategori')
            ->selectRaw('kategori, count(*) as total')
            ->orderBy('total', 'desc')
            ->get();
    }

    public static function getPlatformsCount()
    {
        return self::select('platform')
            ->groupBy('platform')
            ->selectRaw('platform, count(*) as total')
            ->orderBy('total', 'desc')
            ->get();
    }
}