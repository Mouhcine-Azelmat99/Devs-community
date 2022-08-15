<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Save;
use App\Models\Like;
use App\Models\Solution;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Source;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'facebook_id',
        'google_id'
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
    public function source(){
        return $this->hasMany(Source::class);
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
    public function question(){
        return $this->hasMany(Question::class);
    }
    public function solution(){
        return $this->hasMany(Solution::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
