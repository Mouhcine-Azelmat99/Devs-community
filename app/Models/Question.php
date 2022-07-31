<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'slug',
        'img',
        'title',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
