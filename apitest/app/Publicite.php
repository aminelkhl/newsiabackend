<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Publicite extends Model
{
    protected $table = "publicites";
    protected $fillable = [
        'titre', 'text','photo'
    ];
}
