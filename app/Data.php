<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $guarded  = [];

    protected $table = 'data';

    public function content()
    {
        return $this->belongsTo('App\Content');
    }
}
