<?php

namespace Modules\Frais\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Frais\Database\factories\PrevisionFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prevision extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PrevisionFactory
    {
        //return PrevisionFactory::new();
    }
}
