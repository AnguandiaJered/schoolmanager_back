<?php

namespace Modules\Eleve\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Eleve\Database\factories\ClasseFactory;

class Classe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): ClasseFactory
    {
        //return ClasseFactory::new();
    }
}
