<?php

namespace Modules\Presence\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Presence\Database\factories\PresenceFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PresenceFactory
    {
        //return PresenceFactory::new();
    }
}
