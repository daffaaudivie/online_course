<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiDetail extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_detail';
    
     public $timestamps = false;

    protected $fillable = [
        'rekomendasi_history_id',
        'online_course_id',
        'skor',
    ];

    public function history()
    {
        return $this->belongsTo(RekomendasiHistory::class, 'rekomendasi_history_id');
    }

    public function course()
    {
        return $this->belongsTo(Online_course::class, 'online_course_id');
    }
}
