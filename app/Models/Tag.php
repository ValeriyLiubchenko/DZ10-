<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsToMany(Post::Class , 'post_tag')->withTimestamps();
    }
}