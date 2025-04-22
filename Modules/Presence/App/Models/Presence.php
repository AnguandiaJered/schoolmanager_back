<?php

namespace Modules\Presence\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Presence\Database\factories\PresenceFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Eleve;

class Presence extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): PresenceFactory
    // {
    //     //return PresenceFactory::new();
    // }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
