<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TVShow extends Model
{
    use HasFactory;
    protected $table = 'tv_shows';
    protected $fillable = ['title', 'description', 'airing_time'];

    public function episodes()
{
    return $this->hasMany(Episode::class, 'tv_show_id');
}

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows');
    }
}
