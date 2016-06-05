<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 9/18/15
 * Time: 9:42 PM
 */

namespace newsbook\Http\Controllers;

use League\Flysystem\Exception;
use SimpleXMLElement;

class latestng
{

    public function FetchFeed($url) // used by function fetch1()
    {
        $content = file_get_contents($url);
        $xml = new SimpleXMLElement($content);
        return $xml;
    }

    public function FetchUrl($url){
        return file_get_contents($url);
    }

    public function GetImageUrl($content)
    {
        if (preg_match('/src="(.*?)"/', $content, $matches)) {
            $src = $matches[1];
            return $src;
        } else {
            return NULL;
        }
    }

    public function FormatFeedDate($feed_date)
    {
        $date = strtotime($feed_date);
        return date('Y-m-d H:i:s', $date);

    }

    public function GetEncodedContent($item)
    {
        try {
            $namespaces = $item->getNamespaces(true);
            $mycontent = $item->children($namespaces['content']);
            $encoded = $mycontent->encoded;
            return $encoded;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function RemoveImageFromContent($item, $feed)
    {
        $img = $this->GetMediaProperties($item);
        $src = $img['url'];
        $width = $img['width'];
        $height = $img['height'];
        $remove = '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" />';
        $remove2 = '<img src="' . $src . '" width="' . $width . '" />';
        $removal = str_replace($remove, '', $feed);
        $removal = str_replace($remove2, '', $removal);
        return $removal;
    }

    public function GetMediaProperties($item)
    {
        $namespaces = $item->getNamespaces(true);
        $mymedia = $item->children($namespaces['media']);
        return $mymedia->thumbnail->attributes();
    }

    public function RemovePunchTag($content)
    {

        $remove = array('This material, and other digital content on this website, may not be reproduced, published, broadcast, rewritten or redistributed in whole or in part without prior express written permission from PUNCH', 'Copyright PUNCH', 'All rights reserved', 'mailto:editor@punchng.com');
        $contented = '';
        foreach ($remove as $removed) {
            $contented = str_ireplace($removed, null, $content);
        }
        return $contented;
    }

    public function RemoveNoFollowTag($content, $site_url, $title, $channel_title, $channel_link)
    {
        $remove = array('The post <a', $site_url, $channel_title, $channel_link);
        foreach ($remove as $removal) {
            $content = str_ireplace($removal, null, $content);
        }
        return $content;

    }

    public function TruncateStringLength($text, $length)
    {
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return ($text);
    }

    public function ChannelTitle()
    {

    }

    function GetTimeDifference($feed_date, $content_check)
    {
        $lastdate = strtotime($content_check);
        $d3 = strtotime($feed_date);
        return $d3 - $lastdate;

    }

    function GetMultipleCategory($feeds)
    {
        $category = '';
        foreach ($feeds as $feed) {
            $cate = $feed->category;
            $category .= $cate . ',';
        }
        return $category;
    }


}