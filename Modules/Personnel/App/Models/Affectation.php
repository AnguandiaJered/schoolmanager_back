<?php

namespace Modules\Personnel\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Personnel\Database\factories\AffectationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Annee;
use Modules\Eleve\App\Models\Classe;

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

    public function annee()
    {
        return $this->belongsTo(Annee::class,'annee_id','id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'classe_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
