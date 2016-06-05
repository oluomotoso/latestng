<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class content_categories extends Model
{
    protected $table = 'content_categories';
    protected $fillable = ['category'];

//

    public function Category()
    {
    return $this->belongsTo('newsbook\FeedCategory');
    }
}
