<?php

namespace Modules\Bibliotheque\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\EmpruntLivreFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpruntLivre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): EmpruntLivreFactory
    {
        //return EmpruntLivreFactory::new();
    }
}
