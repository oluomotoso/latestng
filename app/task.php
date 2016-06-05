<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //
    protected $table = 'tasks';
    protected $fillable = ['name'];
}
