<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiHistory extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_history'; 
    protected $fillable = [
        'user_id', // Ubah dari 'id_user' ke 'user_id'
        'filter',
    ];

    protected $casts = [
        'filter' => 'array',
    ];

    // Tambahkan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(RekomendasiDetail::class, 'rekomendasi_history_id');
    }
}