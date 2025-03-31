<?php

namespace Modules\Eleve\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Eleve\Database\factories\EleveFactory;

class Eleve extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): EleveFactory
    {
        //return EleveFactory::new();
    }

    public function inscription()
    {
        return $this->hasMany(Inscription::class, 'eleve_id','id');
    }
}
