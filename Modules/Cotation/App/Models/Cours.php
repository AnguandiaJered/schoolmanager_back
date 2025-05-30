<?php

namespace Modules\Cotation\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cotation\Database\factories\CoursFactory;

class Cours extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id','designation'];

    // protected static function newFactory(): CoursFactory
    // {
    //     //return CoursFactory::new();
    // }

    public function cotation()
    {
        return $this->hasMany(Cotation::class, 'cours_id','id');
    }
}
