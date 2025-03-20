<?php

namespace Modules\Cotation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\PeriodeFactory;

class Periode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): PeriodeFactory
    {
        //return PeriodeFactory::new();
    }
}
