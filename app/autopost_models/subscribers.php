<?php

namespace newsbook\autopost_models;

use Illuminate\Database\Eloquent\Model;

class subscribers extends Model
{
    //
    protected $table = 'autopost_subscribers';
    //
    protected $fillable = ['user_id'];
}
