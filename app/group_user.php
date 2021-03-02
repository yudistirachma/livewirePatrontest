<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group_user extends Model
{
    protected $table = 'group_user';

    protected $primaryKey = ['group_id', 'user_id'];

    protected $fillable = [
        "user_id", "group_id"
    ];

    public $timestamps = true;
}
