<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'titre', 'text','photo','categorie','langue','region','user_id'
    ];

    public function commentaires()
    {
        return $this->hasMany('App\Commentaire','post_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
