<?php

namespace Modules\Personnel\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Personnel\Database\factories\EnseignantFactory;

class Enseignant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = [];

    protected static function newFactory(): EnseignantFactory
    {
        //return EnseignantFactory::new();
    }
}
