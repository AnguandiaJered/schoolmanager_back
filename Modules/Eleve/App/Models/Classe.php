<?php

namespace Modules\Eleve\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Eleve\Database\factories\ClasseFactory;
use Modules\Frais\App\Models\Prevision;
use Modules\Personnel\App\Models\Affectation;

class Classe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','designation'];

    // protected static function newFactory(): ClasseFactory
    // {
    //     //return ClasseFactory::new();
    // }

    public function inscription()
    {
        return $this->hasMany(Inscription::class, 'classe_id','id');
    }

    public function affectation()
    {
        return $this->hasMany(Affectation::class, 'classe_id','id');
    }

    public function prevision()
    {
        return $this->hasMany(Prevision::class, 'classe_id','id');
    }
}
