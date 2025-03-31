<?php

namespace Modules\Eleve\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Eleve\Database\factories\InscriptionFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Frais\App\Models\Paiement;

class Inscription extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): InscriptionFactory
    {
        //return InscriptionFactory::new();
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'classe_id','id');
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class,'annee_id','id');
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class,'paiement_id','id');
    }
}
