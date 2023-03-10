<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::Class, 'post_tag')->withTimestamps();
    }
}
