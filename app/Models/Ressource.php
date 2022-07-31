<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Source;


class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function source(){
        return $this->hasMany(Source::class);
    }
}
