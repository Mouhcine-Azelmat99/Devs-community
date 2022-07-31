<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ressource;


class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lien_site',
        'lien_youtub',
        'ressource_id',
    ];
    public function ressource(){
        return $this->belongsTo(Ressource::class);
    }
}
