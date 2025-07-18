<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tv_show_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tvShow()
    {
        return $this->belongsTo(TVShow::class);
    }
}
