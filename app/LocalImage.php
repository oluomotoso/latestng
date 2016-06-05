<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class LocalImage extends Model
{
    //
    public $timestamps = false;
    protected $table = 'images';
    protected $fillable = ['source', 'latestng'];
}
