<?php

namespace newsbook\Http\Controllers;

use DB;
use League\Flysystem\Exception;
use newsbook\content_categories;
use newsbook\content_source;
use newsbook\Http\Requests;
use newsbook\jobs_feed;
use newsbook\latestng\latestng;
use newsbook\latestng\LatestngFacebook;
use newsbook\news_feed;
use newsbook\pending_feed;
use newsbook\region;
use SimpleXMLElement;

class fetch_controller extends Controller
{

    public $latestng;

    function __construct()
    {
        $this->latestng = new latestng();
    }

    public function FetchFeedUpdateUplishQuery()
    {

    }

    public function FetchFeedPendingQuery($title, $url, $category, $description, $content, $importDate, $channelId, $imageUrl, $music, $video, $site_url)
    {
        pending_feed::create([
            'feed_title' => $title,
            'feed_url' => $url,
            'feed_category' => $category,
            'feed_description' => $description,
            'feed_content' => $content,
            'feed_source_date' => $importDate,
            'content_source' => $channelId,
            'image_url' => $imageUrl,
            'music_url' => $music,
            'videourl' => $video,
            'site_url' => $site_url
        ]);
    }

    public function UpdatePendingFeedQuery($title, $url, $category, $description, $content, $importDate, $channelId, $imageUrl, $music, $video, $site_url)
    {
        pending_feed::where('feed_url', $url)->update([

            'feed_title' => $title,
            'feed_category' => $category,
            'feed_description' => $description,
            'feed_content' => $content,
            'feed_source_date' => $importDate,
            'image_url' => $imageUrl,
            'music_url' => $music,
            'video_url' => $video,
            'site_url' => $site_url]);
    }

    public function UpdateSourceLastFetch($url)
    {
        pending_feed::where('id', 1)->update([

            'url' => $url,
        ]);

    }

    public function AddCategory($title, $category)
    {
        $stringCheck = $title . $category;
        $new_category = '';
        $category = content_categories::all();
        foreach ($category as $cate) {
            $tags = $cate->tags;
            $tag = explode(',', $tags);
            foreach ($tag as $tagged) {
                if (stripos($stringCheck, $tagged)) {
                    if (stripos($new_category, $tagged)) {

                    } else {
                        $new_category .= $cate->category . ',';

                    }
                }
            }

        }
        if ($new_category == '') {
            return 'Uncategorized';
        } else {
            $list_category = '';
            $new_category = explode(',', $new_category);
            $new_category = array_unique($new_category);
            foreach ($new_category as $new_categor) {
                $list_category .= $new_categor . ',';
            }
            return $list_category;
        }
    }

    public function PublishJobsQuery($title, $url, $industry, $description, $content, $importDate, $expiry_date, $position, $company, $location, $content_source)
    {
        jobs_feed::create([

            'feed_title' => $title,
            'feed_url' => $url,
            'industry' => $industry,
            'feed_description' => $description,
            'feed_content' => $content,
            'published_date' => $importDate,
            'expiry_date' => $expiry_date,
            'position' => $position,
            'company' => $company,
            'location' => $location,
            'content_source' => $content_source
        ]);
    }

    public function UpdateJobsQuery($title, $url, $category, $description, $content, $importDate, $channelId, $imageUrl, $music, $video, $site_url)
    {
        jobs_feed::where('feed_url', $url)->update([

            'feed_title' => $title,
            'industry' => $category,
            'feed_description' => $description,
            'feed_content' => $content,
            'published_date' => $importDate,
            'expiry_date' => $imageUrl,
            'position' => $music,
            'company' => $video,
            'location' => $site_url
        ]);
    }


    function FetchPunch()
    {
        $pending_source = 1;
        $source_url = content_source::find($pending_source)->url;
        $source_updated_at = content_source::find($pending_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->channel->item as $feed) {
            $title = $feed->title;
            $url = $feed->guid;
            $category = $feed->category;
            $category = $this->AddCategory($title, $category);
            $importDate = $feed->pubDate;
            $description = $feed->description;
            $imageUrl = $this->latestng->GetMediaProperties($feed)['url'];
            $description = $this->latestng->RemoveImageFromContent($feed, $description);
            $description = $this->latestng->RemovePunchTag($description);
            $description = strip_tags($description);
            $description = str_ireplace('read more', '', $description);
            $specificDate = $this->latestng->FormatFeedDate($importDate);
            $content = $this->latestng->GetEncodedContent($feed);
            $content = $this->latestng->RemovePunchTag($content);
            if ($imageUrl == 'http://punch.cdn.ng/wp-content/uploads/2014/02/App-logo.png' || $imageUrl == 'http://punch.cdn.ng/wp-content/uploads/2013/07/punch90x90.png') {
                $content = $this->latestng->RemoveImageFromContent($feed, $content);
                $imageUrl = null;
            }
            $site_url = $feed->link;

            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $category, $description, $content, $specificDate, $pending_source, $imageUrl, null, null, $site_url);
                } elseif (pending_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $category, $description, $content, $specificDate, $pending_source, $imageUrl, null, null, $site_url);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $category, $description, $content, $specificDate, $pending_source, $imageUrl, null, null, $site_url);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find(1)->touch();
    }


    function FetchMyJobMag()
    {
        $pending_source = 12;
        $source_url = content_source::find($pending_source)->url;
        $source_updated_at = content_source::find($pending_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->channel->item as $feed) {
            $title = $feed->title;
            $url = $feed->guid;
            $industry = $feed->industry;
            $published_date = $feed->pubDate;
            $content = $feed->description;
            $expiryDate = $feed->expiry;
            $company = $feed->company;
            $position = $feed->position;
            $description = $this->latestng->TruncateStringLength($content, 100);
            $specificDate = $this->latestng->FormatFeedDate($published_date);
            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $industry, $description, $content, $specificDate, $pending_source, null, null);
                } elseif (pending_feed::where('site_url', $url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $industry, $description, $content, $specificDate, $pending_source, null, null);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $industry, $description, $content, $specificDate, $pending_source, null, null);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find(1)->touch();
    }

    function FetchBusinessDay()
    {
        $content_source = 2;
        $source_url = content_source::find($content_source)->url;
        $source_updated_at = content_source::find($content_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->channel->item as $feed) {
            $title = $feed->title;
            $url = $feed->guid;
            $category = $feed->category;
            $category = $this->AddCategory($title, $category);
            $importDate = $feed->pubDate;
            $description = $feed->description;
            $specificDate = $this->latestng->FormatFeedDate($importDate);
            $content = $this->latestng->GetEncodedContent($feed);
            $site_url = $feed->link;
            $imageUrl = $this->latestng->GetImageUrl($content);
            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } elseif (pending_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find($content_source)->touch();
    }


    function FetchTrentOnLine()
    {
        $content_source = 10;
        $source_url = content_source::find($content_source)->url;
        $source_updated_at = content_source::find($content_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->channel->item as $feed) {
            $title = $feed->title;
            $url = $feed->guid;
            $category = $this->latestng->GetMultipleCategory($feed);
            $category = $this->AddCategory($title, $category);
            $importDate = $feed->pubDate;
            $site_url = $feed->link;
            $description = $feed->description;
            $description = $this->latestng->RemoveNoFollowTag($description, $site_url, $title, content_source::find($content_source)->title, content_source::find($content_source)->website);
            $description = $this->latestng->TruncateStringLength($description, 100);
            $specificDate = $this->latestng->FormatFeedDate($importDate);
            $content = $this->latestng->GetEncodedContent($feed);
            //$content = $this->latestng->RemoveNoFollowTag($content, $site_url, $title, content_source::find($content_source)->title, content_source::find($content_source)->website);
            $imageUrl = $this->latestng->GetImageUrl($content);
            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } elseif (pending_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find($content_source)->touch();
    }

    function FetchLindaIkejiBlog()
    {
        $content_source = 8;
        $source_url = content_source::find($content_source)->url;
        $source_updated_at = content_source::find($content_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->entry as $feed) {
            $title = $feed->title;
            $url = $feed->link[4]->attributes()->href;
            $category = null;
            $category = $this->AddCategory($title, $category);
            $importDate = $feed->published;
            $specificDate = $this->latestng->FormatFeedDate($importDate);
            $content = $feed->content;
            $description = null;
            $site_url = $url;
            $imageUrl = $this->latestng->GetImageUrl($content);
            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } elseif (pending_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find($content_source)->touch();
    }

    function Fetch2Oceansvibe()
    {
        $content_source = 11;
        $source_url = content_source::find($content_source)->url;
        $source_updated_at = content_source::find($content_source)->updated_at;
        foreach ($this->latestng->FetchFeed($source_url)->channel->item as $feed) {
            $title = $feed->title;
            $url = $feed->guid;
            $category = $feed->category;
            $category = $this->AddCategory($title, $category);
            $importDate = $feed->pubDate;
            $description = $feed->description;
            $specificDate = $this->latestng->FormatFeedDate($importDate);
            $content = $this->latestng->GetEncodedContent($feed);
            $site_url = $feed->link;
            $imageUrl = $this->latestng->GetImageUrl($content);
            if ($this->latestng->GetTimeDifference($specificDate, $source_updated_at) > 0) {
                if (news_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePublishFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } elseif (pending_feed::where('site_url', $site_url)->count() > 0) {
                    $this->UpdatePendingFeedQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                } else {
                    $this->FetchFeedPendingQuery($title, $url, $category, $description, $content, $specificDate, $content_source, $imageUrl, null, null, $site_url);
                }
            }

            //$this->UpdateSourceLastFetch($source_url);
        }
        content_source::find($content_source)->touch();
    }

    public function GetUploadImageFromUploadIm($url)
    {
        try {
            $ch = curl_init();
            curl_setopt_array(
                $ch, array(
                CURLOPT_URL => 'http://uploads.im/api?upload=' . $url . '&format=xml',
                CURLOPT_RETURNTRANSFER => true
            ));
            $return = curl_exec($ch);
            $xml = new SimpleXMLElement($return);
            return $xml;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    function alphanumericAndSpace($string)
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    }

    public function PublishNigerianContents()
    {
        $content = DB::table('pending_feed')
            ->where('content_source', 8)->where('publish_status', 0)
            ->orderBy('id', 'desc')->take(20)->get();
        if ($content == null) {
            exit;
        }
        $region = 1;
        foreach ($content as $feed) {
            $title = $feed->feed_title;
            $keywords = region::find($region)->region_keywords;
            $keywords = explode(',', $keywords);
            foreach ($keywords as $keyword) {
                if ((stripos($title, $keyword) !== false)) {

                    /*if ((stripos($title, 'buhari') !== false) || (stripos($title, 'apc') !== false) || (stripos($title, 'pdp') !== false) || (stripos($title, 'haram') !== false) || (stripos($title, 'bomb') !== false) || (stripos($title, 'terror') !== false) || (stripos($title, 'explosion') !== false) || (stripos($title, 'osinbajo') !== false) || (stripos($title, 'amaechi') !== false)
                        || (stripos($title, 'nabteb') !== false) || (stripos($title, 'election') !== false) || (stripos($title, 'tribunal') !== false) || (stripos($title, 'thiev') !== false) || (stripos($title, 'minister') !== false) || (stripos($title, 'senat') !== false) || (stripos($title, 'tinubu') !== false) || (stripos($title, 'jega') !== false) || (stripos($title, 'house of rep') !== false) || (stripos($title, 'fashola') !== false)
                        || (stripos($title, 'Chief of ') !== false) || (stripos($title, 'nigerian twitter') !== false) || (stripos($title, 'nigerians react') !== false) || (stripos($title, 'utme') !== false) || (stripos($title, 'election') !== false) || (stripos($title, 'abdulsala') !== false)
                        || (stripos($title, 'tribunal') !== false) || (stripos($title, 'saraki') !== false) || (stripos($title, 'dogara') !== false) || (stripos($title, 'ebola') !== false) || (stripos($title, 'jonathan') !== false) || (stripos($title, 'thief') !== false) || (stripos($title, 'gej') !== false) || (stripos($title, 'politic') !== false) || (stripos($title, 'nnpc') !== false) || (stripos($title, 'fayose') !== false)
                        || (stripos($title, 'presid') !== false) || (stripos($title, 'accident') !== false) || (stripos($title, 'robbery') !== false) || (stripos($title, 'guber') !== false)
                    )*/

                    $title_me = $this->alphanumericAndSpace($feed->feed_title);
                    $title_me = strtolower($title_me);
                    $perm = explode(' ', $title_me);
                    $perms = '';
                    $count = count($perm);
                    for ($i = 0; $i < $count - 1; $i++) {
                        $perms .= $perm[$i] . '-';
                    }
                    end($perm);
                    $key = key($perm);
                    $permas = $perms . $perm[$key];
                    if (news_feed::create([
                        'feed_title' => $feed->feed_title,
                        'feed_url' => $feed->feed_url,
                        'feed_category' => $feed->feed_category,
                        'feed_description' => $feed->feed_description,
                        'feed_content' => $feed->feed_content,
                        'feed_source_date' => $feed->feed_source_date,
                        'content_source' => $feed->content_source,
                        'image_url' => $feed->image_url,
                        'music_url' => $feed->music_url,
                        'video_url' => $feed->video_url,
                        'site_url' => $feed->site_url,
                        'approved_by' => 2,
                        'perm_url' => $permas,
                        'affliated_regions' => $region

                    ])
                    ) {

                        pending_feed::where('id', $feed->id)->update([
                            'publish_status' => 1
                        ]);

                    }
                    break;
                }
            }
        }
    }

    public function InsertAutoContent()
    {

    }

    public function UpdateAutoContent()
    {

    }

    public function Test()
    {
        $facebook = new LatestngFacebook();
        $facebook->GetUserFacebookGroupsInfo();

    }

    public function PublishContentAutomatically()
    {
        $content = DB::table('pending_feed')
            ->where('content_source', 8)->where('publish_status', 0)
            ->orderBy('id', 'desc')->take(20)->get();
        if ($content == null) {
            exit;
        }

        foreach ($content as $feed) {
            $title = $feed->feed_title;
            $regions = region::all();
            $region_ids = '';
            foreach ($regions as $regiona) {
                $keywords = explode(',', $regiona->region_keywords);
                /*}
                 $keywords = region::find(1)->region_keywords;
                 $keywords = explode(',', $keywords);*/
                foreach ($keywords as $keyword) {
                    if ((stripos($title, $keyword) !== false)) {
                        /*if ((stripos($title, 'buhari') !== false) || (stripos($title, 'apc') !== false) || (stripos($title, 'pdp') !== false) || (stripos($title, 'haram') !== false) || (stripos($title, 'bomb') !== false) || (stripos($title, 'terror') !== false) || (stripos($title, 'explosion') !== false) || (stripos($title, 'osinbajo') !== false) || (stripos($title, 'amaechi') !== false)
                            || (stripos($title, 'nabteb') !== false) || (stripos($title, 'election') !== false) || (stripos($title, 'tribunal') !== false) || (stripos($title, 'thiev') !== false) || (stripos($title, 'minister') !== false) || (stripos($title, 'senat') !== false) || (stripos($title, 'tinubu') !== false) || (stripos($title, 'jega') !== false) || (stripos($title, 'house of rep') !== false) || (stripos($title, 'fashola') !== false)
                            || (stripos($title, 'Chief of ') !== false) || (stripos($title, 'nigerian twitter') !== false) || (stripos($title, 'nigerians react') !== false) || (stripos($title, 'utme') !== false) || (stripos($title, 'election') !== false) || (stripos($title, 'abdulsala') !== false)
                            || (stripos($title, 'tribunal') !== false) || (stripos($title, 'saraki') !== false) || (stripos($title, 'dogara') !== false) || (stripos($title, 'ebola') !== false) || (stripos($title, 'jonathan') !== false) || (stripos($title, 'thief') !== false) || (stripos($title, 'gej') !== false) || (stripos($title, 'politic') !== false) || (stripos($title, 'nnpc') !== false) || (stripos($title, 'fayose') !== false)
                            || (stripos($title, 'presid') !== false) || (stripos($title, 'accident') !== false) || (stripos($title, 'robbery') !== false) || (stripos($title, 'guber') !== false)
                        )*/

                        $title_me = $this->alphanumericAndSpace($feed->feed_title);
                        $title_me = strtolower($title_me);
                        $perm = explode(' ', $title_me);
                        $perms = '';
                        $count = count($perm);
                        for ($i = 0; $i < $count - 1; $i++) {
                            $perms .= $perm[$i] . '-';
                        }
                        end($perm);
                        $key = key($perm);
                        $permas = $perms . $perm[$key];
                        if (news_feed::create([
                            'feed_title' => $feed->feed_title,
                            'feed_url' => $feed->feed_url,
                            'feed_category' => $feed->feed_category,
                            'feed_description' => $feed->feed_description,
                            'feed_content' => $feed->feed_content,
                            'feed_source_date' => $feed->feed_source_date,
                            'content_source' => $feed->content_source,
                            'image_url' => $feed->image_url,
                            'music_url' => $feed->music_url,
                            'video_url' => $feed->video_url,
                            'site_url' => $feed->site_url,
                            'approved_by' => 2,
                            'perm_url' => $permas,
                            'affliated_regions' => $regiona->id

                        ])
                        ) {

                            pending_feed::where('id', $feed->id)->update([
                                'publish_status' => 1
                            ]);

                        }

                    }
                }
            }
        }
    }

    public function UpdateSiteMap()
    {


        $sitemap = '';
        $content = DB::table('news_feed')
            ->where('publish_status', 1)
            ->orderBy('id', 'desc')->get();
        foreach ($content as $row) {
            $id = $row->id;
            $url = $row->perm_url;
            $feedtime = $row->created_at;
            $date = strtotime($feedtime);
            $dt = date('Y-m-d', $date);
            $sitemap .= '<url>
    <loc><![CDATA[http://www.latestng.com/' . $id . '/' . $url . ']]></loc>


      <lastmod>' . $dt . '</lastmod>
      <priority>0.8</priority>

  </url>';
        }
        $data = array("$sitemap");
        $placeholders = array("{url}");
        $tplfile = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/sitemap_temp.xml');
        $newDocu = str_replace($placeholders, $data, $tplfile);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml', $newDocu);

    }


    public
    function FetchAll()
    {
        try {
            $this->FetchLindaIkejiBlog();
        } catch (Exception $e) {

        }
        try {
            $this->PublishContentAutomatically();
        } catch (Exception $e) {

        }
        try {
            $this->UpdateSiteMap();
        } catch (Exception $e) {

        }
    }

    public function SiteMap()
    {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
            $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

            // add item with translations (url, date, priority, freq, images, title, translations)
            $translations = [
                ['language' => 'fr', 'url' => URL::to('pageFr')],
                ['language' => 'de', 'url' => URL::to('pageDe')],
                ['language' => 'bg', 'url' => URL::to('pageBg')],
            ];
            $sitemap->add(URL::to('pageEn'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', [], null, $translations);

            // add item with images
            $images = [
                ['url' => URL::to('images/pic1.jpg'), 'title' => 'Image title', 'caption' => 'Image caption', 'geo_location' => 'Plovdiv, Bulgaria'],
                ['url' => URL::to('images/pic2.jpg'), 'title' => 'Image title2', 'caption' => 'Image caption2'],
                ['url' => URL::to('images/pic3.jpg'), 'title' => 'Image title3'],
            ];
            $sitemap->add(URL::to('post-with-images'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', $images);

            // get all posts from db
            $posts = DB::table('news_feed')->orderBy('created_at', 'desc')->get();

            // add every post to the sitemap
            foreach ($posts as $post) {
                $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}