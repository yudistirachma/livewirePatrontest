<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [];

    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }
}
