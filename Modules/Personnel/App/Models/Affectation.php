<?php

namespace Modules\Personnel\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Personnel\Database\factories\AffectationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affectation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): AffectationFactory
    {
        //return AffectationFactory::new();
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class,'enseignant_id','id');
    }
}
