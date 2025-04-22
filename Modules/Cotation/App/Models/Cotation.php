<?php

namespace Modules\Cotation\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\CotationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Eleve;

class Cotation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): CotationFactory
    // {
    //     //return CotationFactory::new();
    // }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function period()
    {
        return $this->belongsTo(Periode::class,'period_id','id');
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class,'cours_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
