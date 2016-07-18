<?php



namespace newsbook\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Flysystem\Exception;
use newsbook\content_categories;
use newsbook\FeedCategory;
use newsbook\Http\Requests;
use newsbook\news_feed;
use newsbook\tagged;
use Slynova\Commentable\Models\Comment;


class content_controller extends Controller
{
    public function FetchContent()
    {
        $content = news_feed::all();
        return $content;
    }

    public function Content()
    {

    }

    Public function DisplayFullNewsContent($id)
    {

        try {
            $request = new Request();
            DB::table('news_feed')->where('id', $id)->increment('read_counter');
            $content = news_feed::with('feed_category.Category', 'tagged.tags', 'editor')->find($id);

            if (isset($_GET['p'])) {
                $page = $_GET['p'];
                header("Location: http://old.latestng.com?p=$page");
                exit;
            }
            if ($content == null) {
                abort(404);
            }


            $newContent = $this->AdsDisplayWithinContents($content->feed_content);

            $value = $request->cookie('visited');

            $response = new Response();
            $pub_time = $content->created_at;
            $value .= $value . ',' . $id;
            $mydate = strtotime($pub_time);
            $thedate = $this->human_time_diff($mydate);
            //$thedate = date('l jS \of F Y h:i A', $mydate);
            $response->withCookie(cookie()->forever('loftysms.com', $value));
            $entertainment = FeedCategory::with('Newsfeed')->where('categories_id', 25)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
            $business = FeedCategory::with('Newsfeed')->where('categories_id', 6)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
            $politics = FeedCategory::with('Newsfeed')->where('categories_id', 1)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
            $health = FeedCategory::with('Newsfeed')->where('categories_id', 14)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
            $tech = FeedCategory::with('Newsfeed')->where('categories_id', 18)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
            $others = FeedCategory::with('Category')->whereNotIn('categories_id', [6, 14, 25])->SelectRaw('categories_id,COUNT(*) as count')->groupBy('categories_id')->distinct('categories_id')->orderBy('count', 'desc')->limit(10)->get();
            $previous_id = news_feed::where('id', '<', $id)->max('id');;
            $next_id = news_feed::where('id', '>', $id)->min('id');
            $next = news_feed::find($next_id);
            $previous = news_feed::find($previous_id);
            $related = $this->RelatedPost($id);
            $popular_cate = FeedCategory::with('Category')->SelectRaw('categories_id,COUNT(*) as count')->groupBy('categories_id')->distinct('categories_id')->orderBy('count', 'desc')->limit(10)->get();


            return view('front.content', ['response' => $response, 'content' => $content, 'new_content' => $newContent, 'pub_time' => $thedate, 'latest' => $this->Latest(), 'trending' => $this->RisingFeeds(), 'popular' => $this->FeaturedFeeds(), 'entertainments' => $entertainment, 'business' => $business, 'health' => $health, 'techs' => $tech, 'politics' => $politics, 'others' => $others, 'next' => $next, 'previous' => $previous, 'related' => $related, 'categories' => $popular_cate]);
        } catch (Exception $ec) {
            $ec->getMessage();
        }
    }

    function RelatedPost($id)
    {
        $tags = tagged::where('news_feed_id', $id)->get();
        $alltag = '';
        foreach ($tags as $tag) {
            $alltag .= $tag->id . ',';
        }
        $related = tagged::with('newsfeed.feed_category.Category')->whereIn('tags_id', [$alltag])->whereNotIn('news_feed_id', [$id])->orderBy('id', 'desc')->paginate(4);
        return $related;
    }

    function formatCount($n, $singular, $plural, $none = '0')
    {
        if ($n == 0) {
            return "{$none}&nbsp;{$plural}";
        } elseif ($n == 1) {
            return "{$n}&nbsp;{$singular}";
        } else {
            return "{$n}&nbsp;{$plural}";
        }
    }

    function human_time_diff($from)
    {
        if (empty($to))
            $to = time();
        $diff = (int)abs($to - $from);
        if ($diff <= 3600) {
            $mins = round($diff / 60);
            if ($mins <= 1) {
                $mins = 1;
            }
            /* translators: min=minute */
            $since = $this->formatCount($mins, 'min', 'mins');
        } else if (($diff <= 86400) && ($diff > 3600)) {
            $hours = round($diff / 3600);
            if ($hours <= 1) {
                $hours = 1;
            }
            $since = $this->formatCount($hours, 'hour', 'hours');
        } elseif ($diff >= 86400) {
            $days = round($diff / 86400);
            if ($days <= 1) {
                $days = 1;
            }
            $since = $this->formatCount($days, 'day', 'days');
        }
        $formatted = (($to - $from) < 0) ? ("in " . $since) : ($since . " ago");
        return $formatted;
    }

    public function ViewFullContent()
    {

    }

    function findParas($content)
    {
        $content = strtolower($content); // not using stripos() for PHP4 compatibility
        $paras = array();
        $lastpos = -1;
        $paraMarker = "<p";
        if (strpos($content, "<p") === false) {
            $paraMarker = "<br";
        }

        while (strpos($content, $paraMarker, $lastpos + 1) !== false) {
            $lastpos = strpos($content, $paraMarker, $lastpos + 1);
            $paras[] = $lastpos;
        }
        return $paras;
    }

    public function AdsDisplayWithinContents($content)
    {
        $paras = $this->findParas($content);
        $half = sizeof($paras);
        while (sizeof($paras) > $half) {
            array_pop($paras);
        }
        $split = 0;

        if (!empty($paras)) {
            $split = $paras[floor(sizeof($paras) / 2)];
        }
        $content = substr($content, 0, $split) . '<div class="mag-content clearfix">
    <div class="row">
        <div class="col-md-12">
            <div class="ad728-wrapper">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- latestng -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-9946990192994306"
     data-ad-slot="4074850159"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
        </div>
    </div>
</div>' . substr($content, $split);
        return $content;
    }

    public function Entertainment()
    {
        return FeedCategory::with('Newsfeed')->where('categories_id', 25)->orWhere('categories_id', 9)->orWhere('categories_id', 12)->orWhere('categories_id', 27)->orWhere('categories_id', 31)->orWhere('categories_id', 32)->get();

    }

    public function DisplayCategory($category)
    {
        $category_id = content_categories::where('category', $category)->get();

        $entertainment = FeedCategory::with('Newsfeed')->where('categories_id', 25)->orWhere('categories_id', 27)->orWhere('categories_id', 31)->orWhere('categories_id', 32)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $business = FeedCategory::with('Newsfeed')->where('categories_id', 6)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $politics = FeedCategory::with('Newsfeed')->where('categories_id', 1)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $health = FeedCategory::with('Newsfeed')->where('categories_id', 14)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $tech = FeedCategory::with('Newsfeed')->where('categories_id', 18)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $others = FeedCategory::with('Category')->whereNotIn('categories_id', [1, 6, 14, 18, 25])->SelectRaw('categories_id,COUNT(*) as count')->groupBy('categories_id')->distinct('categories_id')->orderBy('count', 'desc')->limit(10)->get();
        $popular_cate = FeedCategory::with('Category')->SelectRaw('categories_id,COUNT(*) as count')->groupBy('categories_id')->distinct('categories_id')->orderBy('count', 'desc')->limit(10)->get();
        $tags = explode(',', $category_id[0]->tags);
        $tags = array_unique($tags);
        $tags = array_filter($tags);
        $tags = array_values($tags);
        $contents = FeedCategory::with('Newsfeed')->where('categories_id', $category_id[0]->id)->distinct('news_feed_id')->orderBy('id', 'desc')->paginate(10);

        return view('front.category', ['contents' => $contents, 'entertainments' => $entertainment, 'category' => $category_id, 'tags' => $tags, 'categories' => $popular_cate, 'business' => $business, 'health' => $health, 'techs' => $tech, 'politics' => $politics, 'others' => $others]);

    }

    public function ViewHomePage()
    {
        $entertainment = FeedCategory::with('Newsfeed')->where('categories_id', 25)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $business = FeedCategory::with('Newsfeed')->where('categories_id', 6)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $politics = FeedCategory::with('Newsfeed')->where('categories_id', 1)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $health = FeedCategory::with('Newsfeed')->where('categories_id', 14)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $tech = FeedCategory::with('Newsfeed')->where('categories_id', 18)->distinct('news_feed_id')->limit(5)->orderBy('id', 'desc')->get();
        $others = FeedCategory::with('Category')->whereNotIn('categories_id', [6, 14, 25])->SelectRaw('categories_id,COUNT(*) as count')->groupBy('categories_id')->distinct('categories_id')->orderBy('count', 'desc')->limit(10)->get();
        $allcate = content_categories::all();
        $allcateg = '';
        foreach ($allcate as $cate) {
            $newscate = FeedCategory::with('Newsfeed.editor', 'Category')->where('categories_id', $cate->id)->orderBy('id', 'desc')->limit(1)->get();

            if (count($newscate) == 0) {

            } else {
                $allcateg[] = $newscate;
            }
        }

        $content = $this->Latest();
        $rising = $this->RisingFeeds();
        $featured = $this->FeaturedFeeds();

        //echo($content);
        return view('front.homepage', ['latest' => $content, 'trending' => $rising, 'popular' => $featured, 'entertainments' => $entertainment, 'categories' => $allcateg, 'business' => $business, 'health' => $health, 'techs' => $tech, 'politics' => $politics, 'others' => $others]);
    }

    public function FeaturedFeeds()
    {
        return news_feed::where('publish_status', 1)->orderBy('read_counter', 'desc')->paginate(5);
    }

    public function RisingFeeds()
    {
        $today = new \DateTime();
        return news_feed::where('publish_status', 1)->where('created_at', '>', $today->modify('-2 days'))->orderBy('read_counter', 'desc')->paginate(5);
    }

    public function Latest()
    {
        return news_feed::where('publish_status', 1)->orderBy('id', 'desc')->paginate(5);

    }

    public function HomePageContents()
    {
        $content = DB::table('news_feed')
            ->where('publish_status', 1)
            ->orderBy('id', 'desc')->get();
        $feed = array();
        for ($i = 0; $i < count($content); $i++) {
            $pub_time = $content[$i]->created_at;
            $mydate = strtotime($pub_time);
            $thedate = date('l jS \of F Y h:i A', $mydate);
            /*$feed_content = '<div class="panel panel-default post">
                           <div class="panel-body">
                           <strong>
                    <a href="/' . $content[$i]->id . '/' . $content[$i]->perm_url . '">' . $content[$i]->feed_title . '</a></strong><br><span id=pub_date>' . $thedate . '</span><br>' . $content[$i]->feed_description . '
                    [<a href="/' . $content[$i]->id . '/' . $content[$i]->perm_url . '">READ MORE</a>]
</div>
            </div>';*/
            $feed_content = '<div class="col-lg-4">
            <div class="card">
                <div class="card-image">
                   <a href="/' . $content[$i]->id . '/' . $content[$i]->perm_url . '"><img src="' . $content[$i]->image_url . '"></a>

                </div><!-- card image -->

                <div class="card-content">
                    <span class="card-title"><a href="/' . $content[$i]->id . '/' . $content[$i]->perm_url . '">' . $content[$i]->feed_title . '</a></span>
                </div><!-- card content -->

            </div>
        </div>
    </div>
</div>';
            //$feed_content='<div class="col-md-3" id="hero-three"><a href="' . $content[$i]->id . '/' . $content[$i]->perm_url . '" class="inner"><figure style="background-image:url(' . $content[$i]->image_url . ')"></figure><footer><figcaption><h2>' . $content[$i]->feed_title . '</h2><p>' . $content[$i]->feed_description . '.</p></figcaption></footer></a></div>';


            $feed[] = array($feed_content);

        }
        return $feed;

    }

    public function ViewHomePageFeeds()
    {
        $content = $this->HomePageContents();

        $ads = $this->FetchAds();
        $crack = round((count($content) / count($ads)), 0);
        $combo2 = array();
        $ct = 0;
        $ct2 = 0;
        for ($i = 0; $i < (count($content) + count($ads)) + 1; $i++) {
            if (($i % $crack) == 0) {
                if ($ct < count($ads))
                    $combo2 [$i] = $ads[$ct++];
            } else {
                $combo2[$i] = $content[$ct2++];
            }

        }
        return $combo2;
    }

    public function PostComment($id, Request $request)
    {
        $article = news_feed::findOrFail($id);

        // Correct way to do it.
        // $article->comments()->create($request->all());
        $comment = new Comment;
        $comment->user_name = $request->input('user_name');
        $comment->body = $request->input('body');

        $article->comments()->save($comment);

        return redirect()->route('articles.show', [$article->id]);

    }

    public function PostCommentReply($id, Request $request)
    {
        $comment = Comment::findOrFail($id);

        // Correct way to do it.
        // $newComment = Comment::create($request->all());
        $newComment = new Comment;
        $newComment->user_name = $request->input('user_name');
        $newComment->body = $request->input('body');
        $newComment->save();

        $newComment->makeChildOf($comment);

        return redirect()->back();

    }

    public function HomePage()
    {
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
            header("Location: http://old.latestng.com?p=$page");
            exit;
        }

        $combo2 = $this->HomePageBreakingNews();
        $MostRead = $this->MostReadPost();
        return view('welcome', ['content' => $combo2, 'most_read' => $MostRead]);
    }


    public function RedirectOldestRoute()
    {
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
            header("Location: http://old.latestng.com?p=$page");
            exit;
        } else {
            $combo2 = $this->HomePageBreakingNews();
            $MostRead = $this->MostReadPost();
            return view('welcome', ['content' => $combo2, 'most_read' => $MostRead]);

        }
    }

    public function FetchAds()
    {
        $content = $this->HomePageContents();
        $size = count($content);
        $AdsNo = 0.2 * $size;
        $AdSlots = array();
        $AdsArray = array();
        $counter = $AdsNo / 4;

        for ($i = 0; $i < $counter + 2; $i++) {
            for ($x = 0; $x < 4; $x++) {
                $AdsArray[] = array('<div class="col-lg-4"><div id="div-gpt-ad-1443992445377-' . $x . '" class="card text-center" style="margin-top:10px">
                        <script type="text/javascript">
                            googletag.cmd.push(function () {
                                googletag.display("div-gpt-ad-1443992445377-' . $x . '");
                            });
                        </script>
                    </div></div>');
            }

        }
        for ($i = 0; $i < $AdsNo; $i++) {
            $AdSlots[] = $AdsArray[$i];

        }

        return $AdSlots;
    }


    public function RealHomePageContents()
    {
        $feeds = [];
        $request = new Request();
        $value = $request->cookie('visited');
        if ($value == null) {
            $content = news_feed::all()->orderBy('id', 'desc');
            return $content;
        } else {
            $cookie = explode(',', $value);
            $categories = '';
            foreach ($cookie as $id) {
                $category = news_feed::find($id)->feed_category;
                $categories .= $category . ',';
                $indi_category = explode(',', $categories);
                $feeds[] = news_feed::where('feed_category', 'like', $indi_category);

            }

        }

    }

    public function HomePageBreakingNews()
    {
        $yourDataArray = $this->ViewHomePageFeeds();
        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = count($yourDataArray); //total items in array
        $limit = 20; //per page
        $totalPages = ceil($total / $limit); //calculate total pages
        $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
        $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
        $offset = ($page - 1) * $limit;
        if ($offset < 0) $offset = 0;

        $yourDataArray = array_slice($yourDataArray, $offset, $limit);
        $link = '?page=%d';
        $data2 = '';
        $data = '';
        $data3 = '';
        foreach ($yourDataArray as $data2) {
            //$data2 .= $data2 . ',';
            foreach ($data2 as $data) {
                $data3 .= $data . '';
            }
        }

        $pagerContainer = '<div>' . $data3 . '<div class="pagination clearfix">
                <ul class="page-numbers clearfix">';

        if ($totalPages != 0) {
            if ($page == 1) {
                $pagerContainer .= '';
            } else {
                $pagerContainer .= sprintf('<li><a href="' . $link . '" class="prev page-numbers">Previous</a></li>', $page - 1);
            }
            $pagerContainer .= ' <li>Page <span><strong>' . $page . '</strong> of ' . $totalPages . '</span></li>';
            if ($page == $totalPages) {
                $pagerContainer .= '';
            } else {
                $pagerContainer .= sprintf('<li><a class="next page-numbers" href="' . $link . '">Next</a></li>', $page + 1);
            }
        }
        $pagerContainer .= '</ul><!--page-numbers-->
            </div>' . '</div>';

        return $pagerContainer;
    }

    function MostReadPost()
    {
        $content = DB::table('news_feed')
            ->orderBy('read_counter', 'desc')->take(5)->get();

        return $content;
    }


}
