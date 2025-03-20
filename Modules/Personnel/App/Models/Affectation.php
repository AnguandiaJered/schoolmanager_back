<?php

namespace Modules\Personnel\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Personnel\Database\factories\AffectationFactory;

class Affectation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): AffectationFactory
    {
        //return AffectationFactory::new();
    }
}
