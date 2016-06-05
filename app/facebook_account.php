<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class facebook_account extends Model
{
    protected $table = 'facebook_accounts';
    //
    protected $fillable = ['token','refresh_token','name','email','facebook_id','availability'];

    public function edge()
    {
        return $this->hasMany('newsbook\facebook_edge','facebook_account_owner');
    }
}
