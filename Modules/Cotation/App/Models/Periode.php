<?php

namespace Modules\Cotation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\PeriodeFactory;

class Periode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','designation'];

    // protected static function newFactory(): PeriodeFactory
    // {
    //     //return PeriodeFactory::new();
    // }

    public function cotation()
    {
        return $this->hasMany(Cotation::class, 'period_id','id');
    }

    public function discipline()
    {
        return $this->hasMany(Discipline::class, 'period_id','id');
    }
}
