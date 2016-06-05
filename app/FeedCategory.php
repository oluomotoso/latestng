<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class FeedCategory extends Model
{
    //
    public $timestamps = false;
    protected $table = 'feed_category';
    protected $fillable = ['news_feed_id', 'categories_id'];

    public function Category()
    {
        return $this->belongsTo('newsbook\content_categories');
    }
}
