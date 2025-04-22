<?php

namespace Modules\Bibliotheque\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bibliotheque\Database\factories\RemiseLivreFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemiseLivre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): RemiseLivreFactory
    // {
    //     //return RemiseLivreFactory::new();
    // }

    public function empruntlivre()
    {
        return $this->belongsTo(EmpruntLivre::class,'emprunt_id','id');
    }

    public function livre()
    {
        return $this->belongsTo(Livre::class,'livre_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
