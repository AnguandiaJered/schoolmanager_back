<?php

namespace Modules\Frais\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Frais\Database\factories\FraisFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frais extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','designation'];

    // protected static function newFactory(): FraisFactory
    // {
    //     //return FraisFactory::new();
    // }

    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'frais_id','id');
    }
}
