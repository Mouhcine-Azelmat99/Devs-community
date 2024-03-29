<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ressource;
use App\Models\User;


class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lien_site',
        'lien_youtub',
        'ressource_id',
        'user_id',
    ];
    public function ressource(){
        return $this->belongsTo(Ressource::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
