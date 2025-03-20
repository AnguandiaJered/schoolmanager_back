<?php

namespace Modules\Bibliotheque\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\RemiseLivreFactory;

class RemiseLivre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): RemiseLivreFactory
    {
        //return RemiseLivreFactory::new();
    }
}
