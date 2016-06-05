<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 9/18/15
 * Time: 9:42 PM
 */

namespace newsbook\latestng;

use League\Flysystem\Exception;
use newsbook\news_feed;
use SimpleXMLElement;

class latestng
{

    public function FetchFeed($url) // used by function fetch1()
    {
        $content = file_get_contents($url);
        $xml = new SimpleXMLElement($content);
        return $xml;
    }

    public function FetchUrl($url)
    {
        return file_get_contents($url);
    }

    public function GetMultipleImageUrl($content)
    {
        preg_match_all('/src="(.*?)"/', $content, $matches);
        return ($matches[1]);

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

    function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        $truncate .= $ending;
        if ($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
        return $truncate;
    }

    public function TruncateStringLength($text, $length)
    {
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return ($text);
    }

    function rip_tags($string) {

        // ----- remove HTML TAGs -----
        $string = preg_replace ('/<[^>]*>/', ' ', $string);

        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $this->TruncateStringLength($string,200);

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