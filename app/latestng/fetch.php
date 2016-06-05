<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 4/27/16
 * Time: 11:09 PM
 */

namespace newsbook\latestng;

use GuzzleHttp\Client;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;
use Mockery\CountValidator\Exception;
use newsbook\content_categories;
use newsbook\content_source;
use newsbook\FeedCategory;
use newsbook\LocalImage;
use newsbook\news_feed;
use newsbook\pending_feed;
use PicoFeed\PicoFeedException;
use PicoFeed\Reader\Reader;

class fetch
{
    protected $latestng;

    public function __construct()
    {
        $this->latestng = new latestng();
    }

    public function FetchPosts()
    {
        ini_set('max_execution_time', 1300);
        try {
            $reader = new Reader;
            $sources = content_source::where('status', 1)->get();
            $item = '';
            // Return a resource
            foreach ($sources as $source) {


                $resource = $reader->download($source->url, $source->last_modified, $source->etag);
                if ($resource->isModified()) {
                    // Return the right parser instance according to the feed format
                    $parser = $reader->getParser(
                        $resource->getUrl(),
                        $resource->getContent(),
                        $resource->getEncoding()
                    );

                    // Return a Feed object
                    $feed = $parser->execute();
                    $etag = $resource->getEtag();
                    $last_modified = $resource->getLastModified();
                    // Print the feed properties with the magic method __toString()
                    $site_url = $feed->getSiteUrl();
                    $feed_title = $feed->getTitle();
                    $feed_items = $feed->getItems();
                    //$items->getDate()->format('Y-m-d H:i:s')
                    foreach ($feed_items as $items) {
                        $title = $items->getTitle();
                        $contents = $items->getContent();
                        $url = $items->getUrl();
                        $format = '<p>The post <a href="' . $url . '" rel="noreferrer" target="_blank">' . $title . '</a> appeared first on <a href="' . $site_url . '" rel="noreferrer" target="_blank">' . $feed_title . '</a>.</p>';
                        $contents = str_ireplace($format, null, $contents);
                        $description = $this->latestng->rip_tags($contents);
                        $source_date = $items->getDate()->format('Y-m-d H:i:s');
                        $images = $this->latestng->GetMultipleImageUrl($contents);
                        $perm = $this->Perm($title);
                        $category = $items->getTag('category');
                        $tagged = explode(',', $source->title_param);
                        for ($i = 0; $i < count($tagged); $i++) {
                            if (stripos($title, $tagged[$i]) !== false) {
                                if (!empty($images)) {
                                    $content = $this->MyContents($contents, $images);
                                    $newImage = $images[0];
                                } else {
                                    $content = $contents;
                                    $newImage = null;
                                }
                                if (news_feed::where('feed_url', $url)->count() > 0) {
                                    break;
                                } else {
                                    $publish = $this->PublishContents($title, $description, $content, $source_date, $newImage, $source->id, $perm, $url);
                                    $this->UpdateCategory($category, $publish->id, $title);
                                    break;
                                }

                            }
                            if ($i == count($tagged) - 1) {
                                for ($j = 0; $j < count($category); $j++) {
                                    $categorys = explode(',', $source->categories_param);
                                    foreach ($categorys as $caterr) {


                                        if (stripos($category[$j], $caterr) !== false) {
                                            if (!empty($images)) {
                                                $content = $this->MyContents($contents, $images);
                                                $newImage = $images[0];
                                            } else {
                                                $content = $contents;
                                                $newImage = null;
                                            }
                                            if (news_feed::where('feed_url', $url)->count() > 0) {
                                                break 2;
                                            } else {
                                                $publish = $this->PublishContents($title, $description, $content, $source_date, $newImage, $source->id, $perm, $url);
                                                $this->UpdateCategory($category, $publish->id, $title);
                                                break 2;
                                            }

                                        }
                                    }
                                }
                            }

                        }

                        if (news_feed::where('feed_url', $url)->count() > 0) {

                        } else {
                            if (pending_feed::where('feed_url', $url)->count() > 0) {

                            } else {
                                $mycategory = '';
                                foreach ($category as $cate) {
                                    $mycategory .= $cate . ',';
                                }
                                $this->PendingContents($title, $description, $contents, $source_date, $source->id, $perm, $url, $mycategory);
                            }
                        }
                    }
                    content_source::where('id', $source->id)->update([
                        'last_modified' => $last_modified,
                        'etag' => $etag
                    ]);
                }
            }
            return ('operation done');
        } catch (PicoFeedException $e) {
            return ($e->getMessage());
            // Do Something...
        }
    }

    public function PublishContents($title, $description, $content, $source_date, $image_url, $content_source, $perm, $source_url)
    {
        return news_feed::create(
            [
                'feed_title' => $title, 'feed_description' => $description, 'feed_content' => $content, 'feed_source_date' => $source_date, 'image_url' => $image_url, 'content_source' => $content_source, 'perm_url' => $perm, 'feed_url' => $source_url
            ]
        );
    }

    public function PendingContents($title, $description, $content, $source_date, $content_source, $perm, $url, $category)
    {
        return pending_feed::create(
            [
                'feed_title' => $title, 'feed_description' => $description, 'feed_content' => $content, 'feed_source_date' => $source_date, 'content_source' => $content_source, 'perm_url' => $perm, 'feed_category' => $category, 'feed_url' => $url
            ]
        );
    }

    public function AddCategory($title, $feed_id)
    {
        $new_category = '';
        $category = content_categories::all();
        foreach ($category as $cate) {
            $tags = $cate->tags;
            $tag = explode(',', $tags);
            foreach ($tag as $tagged) {
                if (stripos($title, $tagged)) {
                    FeedCategory::create(['news_feed_id' => $feed_id, 'categories_id' => $cate->id]);
                    continue 2;
                }
            }

        }
        $feedcate = FeedCategory::where('news_feed_id', $feed_id)->get();
        if (empty($feedcate)) {
            FeedCategory::create(['news_feed_id' => $feed_id, 'categories_id' => 10]);
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

    function UpdateCategory(array $category, $feed_id, $title)
    {
        $category = array_unique($category);
        $category = array_filter($category);
        $category = array_values($category);
        if (!empty($category)) {
            foreach ($category as $categor) {
                $category_id = content_categories::firstOrCreate(['category' => $categor]);
                FeedCategory::create(['news_feed_id' => $feed_id, 'categories_id' => $category_id->id]);
            }
        } else {
            $this->AddCategory($title, $feed_id);
        }
    }

    public function UploadImage($image)
    {
        try {
            $client = new Client();
            $res = $client->request('GET', 'http://uploads.im/api?upload=' . $image . '');
            $result = json_decode($res->getBody());
            if ($result->status_code == 200) {
                return $result;
            } else {
                return $this->UploadImage($image);
            }
        } catch (\Exception $e) {
            return $this->UploadImage($image);
        }
    }

    public function MyContents($contents, $images)
    {
        for ($i = 0; $i < count($images); $i++) {
            //echo($images[$i]);
            $image = $this->UploadImageLocally($images[$i]);
            $contents = str_replace($images[$i], $image, $contents);
            if (strpos($images[$i], 'blogspot') !== false) {
                $imagehref = str_replace('/s400/', '/s1600/', $images[$i]);
                $contents = str_replace($imagehref, $image, $contents);
            }
        }
        return $contents;
    }

    public function MyContents2($contents, $images)
    {
        for ($i = 0; $i < count($images); $i++) {
            //echo($images[$i]);
            $image = $this->UploadImageLocally2($images[$i]);
            $contents = str_replace($images[$i], $image, $contents);
            if (strpos($images[$i], 'blogspot') !== false) {
                $imagehref = str_replace('/s400/', '/s1600/', $images[$i]);
                $contents = str_replace($imagehref, $image, $contents);
            }
        }
        return $contents;
    }

    function alphanumericAndSpace($string)
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    }

    function Perm($title)
    {
        $title_me = $this->alphanumericAndSpace($title);
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

        return $permas;
    }

    function UploadImageLocally($url)
    {
        try {
            $img = Image::make($url);
            $width = $img->width();
            $height = $img->height();
            /*if ($width <= 200) {
                $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $height = $img->height();
            }
            if ($height <= 200) {
                $img->resize(null, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $width = $img->width();
            }*/

            $file = "images/" . uniqid("latestng") . '.jpg';
            $img->insert('https://www.latestng.com/images/latestng_watermark.png', 'bottom-right');
            $path = public_path($file);
            $img->save($path, 60);
            LocalImage::create([
                'source' => $url,
                'latestng' => 'https://latestng.com/' . $file
            ]);
            return 'https://latestng.com/' . $file;
        } catch (Exception $e) {
            return $url;
        } catch (\Symfony\Component\Debug\Exception\FatalErrorException $e) {
            return $url;
        }
        catch (NotReadableException $e) {
            return $url;
        }
    }

    function UploadImageLocally2($url)
    {
        try {
            $img = Image::make($url);
            $width = $img->width();
            $height = $img->height();
            /*if ($width <= 200) {
                $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $height = $img->height();
            }
            if ($height <= 200) {
                $img->resize(null, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $width = $img->width();
            }*/
            $file = "images/" . uniqid("latestng") . '.jpg';
            $img->insert('https://www.latestng.com/images/latestng_watermark.png', 'bottom-right');
            //$base=base64_decode($request['image']);
            $img->save($file, 60);
            LocalImage::create([
                'source' => $url,
                'latestng' => 'https://latestng.com/' . $file
            ]);
            return 'https://latestng.com/' . $file;
        } catch (Exception $e) {
            return $url;
        } catch (\Symfony\Component\Debug\Exception\FatalErrorException $e) {
            return $url;
        }
        catch (NotReadableException $e) {
            return $url;
        }
    }

    function TestUploadImageLocally($url)
    {
        var_dump($url);
        try {
            $img = Image::make($url);
            $file = "images/" . uniqid("latestng") . '.jpg';
            $img->insert('images/latestng_watermark.png', 'bottom-right');
            $img->save($file, 60);
            LocalImage::create([
                'source' => $url,
                'latestng' => 'https://latestng.com/' . $file
            ]);

            return 'https://latestng.com/' . $file;
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            return $this->UploadImageLocally($url);
        }
    }

    function FindOrFailImage($url)
    {
        $image = image::where('source', $url)->get();
        if (count($image) > 0) {
            return $image[0]->latestng;
        } else {
            return $this->UploadImageLocally($url);
        }
    }
} 