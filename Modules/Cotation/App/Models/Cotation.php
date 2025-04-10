<?php

namespace Modules\Cotation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\CotationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): CotationFactory
    // {
    //     //return CotationFactory::new();
    // }
}
