<?php

namespace newsbook\autopost_models;

use Illuminate\Database\Eloquent\Model;

class subscriber_facebook extends Model
{
    //
    //
    protected $table = 'autopost_subscribers_facebook_account';
    //
    protected $fillable = ['name','token','refresh_token','email','facebook_id','token_expiry','subscriber_id'];
}
