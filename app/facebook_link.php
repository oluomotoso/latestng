<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class facebook_link extends Model
{
    protected $table = 'facebook_links';
    protected $fillable = ['link', 'facebook','title'];
}
