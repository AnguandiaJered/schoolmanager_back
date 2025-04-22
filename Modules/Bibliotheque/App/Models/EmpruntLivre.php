<?php

namespace Modules\Bibliotheque\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\EmpruntLivreFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Eleve\App\Models\Eleve;

class EmpruntLivre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): EmpruntLivreFactory
    // {
    //     //return EmpruntLivreFactory::new();
    // }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function livre()
    {
        return $this->belongsTo(Livre::class,'livre_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }

    public function remiselivre()
    {
        return $this->hasMany(RemiseLivre::class, 'emprunt_id','id');
    }
}
