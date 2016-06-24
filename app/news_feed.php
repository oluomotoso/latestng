<?php

namespace newsbook;

use Illuminate\Database\Eloquent\Model;
use Slynova\Commentable\Traits\Commentable;

class news_feed extends Model
{
    protected $table = 'news_feed';
    //
    protected $fillable = ['feed_title', 'feed_url', 'feed_category',
        'feed_description', 'feed_content', 'feed_source_date'
        , 'content_source', 'image_url', 'music_url', 'video_url', 'site_url', 'approved_by', 'publish_status', 'image_upload_url', 'thumb_image', 'perm_url', 'affliated_regions', 'fb_id','metrics','fb_group'

    ];

    public function feed_category()
    {
        return $this->hasMany('newsbook\FeedCategory');
    }

}
