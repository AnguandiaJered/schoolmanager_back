<?php

namespace Modules\Frais\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Frais\Database\factories\PrevisionFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Annee;
use Modules\Eleve\App\Models\Classe;

class Prevision extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): PrevisionFactory
    // {
    //     //return PrevisionFactory::new();
    // }

    public function annee()
    {
        return $this->belongsTo(Annee::class,'annee_id','id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'classe_id','id');
    }

    public function frais()
    {
        return $this->belongsTo(Frais::class,'frais_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
