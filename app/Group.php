<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        "segment", "desc", "user_id", "status"
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
