<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class tagged extends Model
{
    //

    protected $table = 'tagged';
    public $timestamps = false;
    protected $fillable = ['tags_id', 'news_feed_id'];

    public function tags()
    {
        return $this->belongsTo('newsbook\tag','tags_id');
    }
    public function newsfeed()
    {
        return $this->belongsTo('newsbook\news_feed','news_feed_id');
    }
}
