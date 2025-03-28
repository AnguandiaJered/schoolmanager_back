<?php

namespace Modules\Bibliotheque\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\LivreFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): LivreFactory
    {
        //return LivreFactory::new();
    }
}
