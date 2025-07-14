<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['tv_show_id', 'title', 'description', 'duration', 'airing_time', 'thumbnail', 'video'];

    public function tvShow()
    {
        return $this->belongsTo(TVShow::class, 'tv_show_id');
    }
    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function isLikedByAuthUser()
    {
        if ($this->relationLoaded('likers')) {
            return $this->likes->where('user_id', auth()->id())->count() > 0;
        }

        // fallback direct DB query if likes not loaded
        return $this->likers()->where('user_id', auth()->id())->exists();
    }
}
