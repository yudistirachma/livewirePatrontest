<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_tag extends Model
{
    protected $table = 'content_tag';

    protected $primaryKey = ['content_id', 'tag_id'];

    protected $fillable = [];

    public $timestamps = true;
}
