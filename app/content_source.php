<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class content_source extends Model
{
    protected $table = 'content_source';
    protected $fillable = ['title', 'url', 'created_by','last_modified','etag','title','title_param','categories_param','status'];


    //
}
