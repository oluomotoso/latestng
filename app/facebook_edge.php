<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class facebook_edge extends Model
{
    //
    protected $table = 'facebook_edges';
    protected $fillable = ['name', 'facebook_id', 'facebook_account_owner','edge_type','response'

    ];


}
