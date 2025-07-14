<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TVShow extends Model
{
   use HasFactory;

    protected $fillable = ['title', 'description', 'airing_time'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
