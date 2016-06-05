<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;

class pending_feed extends Model
{

    protected $table = 'pending_feed';
    //
    protected $fillable = ['feed_title', 'feed_url', 'feed_category',
        'feed_description', 'feed_content', 'feed_source_date'
        , 'content_source', 'image_url', 'music_url', 'video_url', 'site_url'
    ];

    //
}
