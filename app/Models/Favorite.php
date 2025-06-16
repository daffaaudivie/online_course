<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'id_favorite';
    protected $fillable = ['user_id', 'id_online_course'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Online_course::class, 'id_online_course');
    }
}
