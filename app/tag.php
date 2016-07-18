<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
    protected $fillable = ['tag'];

    public function tagged()
    {
        return $this->hasMany('newsbook\tagged','tags_id');
    }
}
