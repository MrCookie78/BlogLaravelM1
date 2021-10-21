<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	protected $table = "posts";
	protected $fillable = ['title', 'description', 'extrait', 'picture'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post', 'id');
    }

    public function countComments()
    {
        return sizeof($this->comments);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts-categories', 'post', 'category');
    }
}
