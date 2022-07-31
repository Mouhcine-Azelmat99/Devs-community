<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Save;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'img',
        'user_id',
        'cat',
        'category_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function savePost(){
        return $this->hasMany(Save::class);
    }
}
