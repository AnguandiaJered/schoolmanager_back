<?php

namespace Modules\Presence\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Presence\Database\factories\PresenceFactory;

class Presence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): PresenceFactory
    {
        //return PresenceFactory::new();
    }
}
