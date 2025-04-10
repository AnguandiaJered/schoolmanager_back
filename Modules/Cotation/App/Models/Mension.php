<?php

namespace Modules\Cotation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\MensionFactory;

class Mension extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): MensionFactory
    // {
    //     //return MensionFactory::new();
    // }
}
