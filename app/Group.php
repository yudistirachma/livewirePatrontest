<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        "name", "segment", "desc", "user_id", "status"
    ];
    

    public function users()
    {
        return $this->belongsToMany('App\User');

    }
}
