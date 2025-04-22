<?php

namespace Modules\Eleve\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Eleve\Database\factories\EleveFactory;
use Modules\Bibliotheque\App\Models\EmpruntLivre;
use Modules\Cotation\App\Models\Cotation;
use Modules\Cotation\App\Models\Discipline;
use Modules\Frais\App\Models\Paiement;
use Modules\Presence\App\Models\Presence;

class Eleve extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): EleveFactory
    // {
    //     //return EleveFactory::new();
    // }

    public function inscription()
    {
        return $this->hasMany(Inscription::class, 'eleve_id','id');
    }

    public function empruntlivre()
    {
        return $this->hasMany(EmpruntLivre::class, 'eleve_id','id');
    }

    public function cotation()
    {
        return $this->hasMany(Cotation::class, 'eleve_id','id');
    }

    public function discipline()
    {
        return $this->hasMany(Discipline::class, 'eleve_id','id');
    }

    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'eleve_id','id');
    }

    public function presence()
    {
        return $this->hasMany(Presence::class, 'eleve_id','id');
    }
}
