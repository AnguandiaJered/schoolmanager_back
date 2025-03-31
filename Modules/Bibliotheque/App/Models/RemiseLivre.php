<?php

namespace Modules\Bibliotheque\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\RemiseLivreFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemiseLivre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): RemiseLivreFactory
    {
        //return RemiseLivreFactory::new();
    }
}
