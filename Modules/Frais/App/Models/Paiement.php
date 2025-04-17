<?php

namespace Modules\Frais\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Frais\Database\factories\PaiementFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Inscription;
use Modules\Eleve\App\Models\Eleve;

class Paiement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): PaiementFactory
    // {
    //     //return PaiementFactory::new();
    // }

    public function inscription()
    {
        return $this->hasMany(Inscription::class, 'paiement_id','id');
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function frais()
    {
        return $this->belongsTo(Frais::class,'frais_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
