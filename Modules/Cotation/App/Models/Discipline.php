<?php

namespace Modules\Cotation\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\DisciplineFactory;
use Modules\Eleve\App\Models\Eleve;

class Discipline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    // protected static function newFactory(): DisciplineFactory
    // {
    //     //return DisciplineFactory::new();
    // }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class,'eleve_id','id');
    }

    public function period()
    {
        return $this->belongsTo(Periode::class,'period_id','id');
    }

    public function mention()
    {
        return $this->belongsTo(Mension::class,'mention_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'author','id');
    }
}
