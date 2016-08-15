<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{!!$content->feed_title!!}</title>
    <meta name="description" content="{!!$content->feed_description!!}"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:url" content="https://www.latestng.com/{!!$content->id!!}/{!!$content->perm_url!!}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{!!$content->feed_title!!}"/>
    <meta property="og:description" content="{!!$content->feed_description!!}"/>
    <meta property="og:image" content="{!!$content->image_url!!}"/>
    <meta property="og:site_name" content="Latestng.com"/>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="article:author" content="https://www.facebook.com/latestng"/>
    <meta property="article:publisher" content="https://www.facebook.com/latestng"/>
    <meta name="theme-color" content="#3B5999">
    <meta name="keywords"
          content="@if($content->tagged !== null)@foreach($content->tagged as $keyword){{$keyword->tags->tag}},@endforeach @endif"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@latestngcom">
    <meta name="twitter:creator" content="@latestngcom">
    <meta name="twitter:title" content="{!!$content->feed_title!!}">
    <meta name="twitter:description" content="{!!$content->feed_description!!}">
    <meta name="twitter:image" content="{!!$content->image_url!!}">
    <link rel="shortcut icon" href="http://latestng.com/public/images/favicon.ico">

    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,400italic,500,700,700italic,900"
          rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic" rel="stylesheet"
          type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet" type="text/css">

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS -->

    <!-- Theme CSS -->
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">var switchTo5x = true;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script
        type="text/javascript">stLight.options({publisher: "c653dddc-e16d-453e-a904-8ab2756a1365", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
    <script type='text/javascript'>
        (function () {
            var useSSL = 'https:' == document.location.protocol;
            var src = (useSSL ? 'https:' : 'http:') +
                '//www.googletagservices.com/tag/js/gpt.js';
            document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
        })();
    </script>

    <script type='text/javascript'>
        googletag.cmd.push(function () {
            var sidebarad = googletag.sizeMapping().
                addSize([1280, 800], [
                    [160, 600],
                    [120, 600],
                    [336, 280]

                ]).
                addSize([600, 800], [
                    [160, 600],
                    [120, 600],
                    [336, 280]
                ]).
                addSize([800, 600], [
                    [160, 600],
                    [120, 600],
                    [336, 280]
                ]).
                addSize([0, 0], [
                    [240, 400],
                    [300, 250]

                ]).build();
            googletag.defineSlot('/32742566/latestng-003', [[120, 240], [120, 600], [240, 400],[336, 280], [160, 600], [300, 250]], 'div-gpt-ad-1468910906855-0').defineSizeMapping(sidebarad).addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.pubads().enableSyncRendering();
            googletag.enableServices();
        });
    </script>
</head>

<body>

@include('front.header')
<?php
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
    $from = strtotime($from);
    if (empty($to))
        $to = time();
    $diff = (int)abs($to - $from);
    if ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        /* translators: min=minute */
        $since = formatCount($mins, 'min', 'mins');
    } else if (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $since = formatCount($hours, 'hour', 'hours');
    } elseif ($diff >= 86400) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
        }
        $since = formatCount($days, 'day', 'days');
    }
    $formatted = (($to - $from) < 0) ? ("in " . $since) : ($since . " ago");
    return $formatted;
}

?>
<div class="container main-wrapper">

<!-- End Main Banner -->
<div class="mag-content clearfix visible-lg visible-md visible-sm">
    <div class="row">
        <div class="col-md-12">
            <div class="ad728-wrapper">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Latestng Top -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9946990192994306"
                     data-ad-slot="8946838158"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>
</div>
<div class="mag-content clearfix visible-xs">
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
</div>
<!-- End Main Banner -->
<div class="main-content mag-content clearfix">

<div class="row blog-content" data-stickyparent>
<div class="col-md-8" data-stickycolumn>

    <article class="post-wrapper clearfix">

        <header class="post-header">

            <h1 class="post-title">
                {!!$content->feed_title!!}
            </h1><!-- .post-title -->

            <a href="@if(count($content->feed_category) > 0)/category/{{$content->feed_category[0]->category->category}}@else /category/uncategorized @endif"
               class="category bgcolor2">
                @if(count($content->feed_category) > 0){{$content->feed_category[0]->category->category}}@else
                uncategorized
                @endif
            </a>

            <p class="simple-share">
            <span>by <a href="@if(count($content->editor) > 0){{$content->editor->username}}@else oluomotoso
                        @endif"><b>@if(count($content->editor) > 0){{$content->editor->username}}@else oluomotoso
                        @endif</b></a></span>
                <span><span class="article-date"><i class="fa fa-clock-o"></i> {!!$pub_time!!}</span></span>
                <span><i class="fa fa-eye"></i> {{$content->read_counter}} views</span>
            </p>
            <!-- .post-header -->

            <div class="post-content clearfix">
                {!!$new_content!!}
            </div>
            <!-- .post-content -->
            <div>
                <span class='st_facebook_hcount' displayText='Facebook'></span>
                <span class='st_twitter_hcount' displayText='Tweet'></span>
                <span class='st_whatsapp_hcount' displayText='WhatsApp'></span>
            </div>
            <footer class="post-meta">
                <div class="tags-wrapper">
                    <ul class="tags-widget clearfix">
                        <li class="trending">TAGS:</li>
                        @if($content->tagged !== null)@foreach($content->tagged as $keyword)
                        <li><a href="/tags/{{$keyword->tags->tag}}">{{$keyword->tags->tag}}</a></li>
                        @endforeach @endif
                    </ul>
                </div>


                <div class="row">
                    <div class="post-nav-wrapper clearfix">
                        <div class="col-md-6 omega">
                            <div class="previous-post">
                                <div class="post-nav-label">
                                    <i class="fa fa-angle-left"></i>
                                    Previous post
                                </div>
                                <a href="/{{$previous->id}}/{{$previous->perm_url}}" class="post-nav-title">{{$previous->feed_title}}</a>
                            </div>
                        </div>
                        @if(count($next)>0)
                        <div class="col-md-6 alpha">
                            <div class="next-post">
                                <div class="post-nav-label">
                                    Next post
                                    <i class="fa fa-angle-right"></i>
                                </div>
                                <a href="/{{$next->id}}/{{$next->perm_url}}"
                                   class="post-nav-title">{{$next->feed_title}}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- .post-nav-wrapper -->
                </div>

            </footer>

    </article>
    <!-- .post-wrapper -->

    @if(count($related) > 0)
    <div class="related-posts clearfix">

        <h3 class="block-title"><span>Suggestions for you</span></h3>

        <div class="row">
            @foreach($related as $relate)

            <div class="col-md-6">
                <article class="news-block small-block">
                    @if($relate->newsfeed->image_url !== null)
                    <a href="/{{$relate->newsfeed->id}}/{{$relate->newsfeed->perm_url}}" class="overlay-link">
                        <figure class="image-overlay">
                            <img src="{{$relate->newsfeed->image_url}}" alt="">
                        </figure>
                    </a>
                    @else
                    @endif
                    @if(count($relate->newsfeed->feed_category) > 0)
                    <a href="/category/{{$relate->newsfeed->feed_category[0]->category->category}}" class="category">
                        {{$relate->newsfeed->feed_category[0]->category->category}}
                    </a>
                    @else
                    <a href="/category/uncategorized" class="category">
                        uncategorized
                    </a>
                    @endif
                    <header class="news-details">
                        <h3 class="news-title">
                            <a href="/{{$relate->newsfeed->id}}/{{$relate->newsfeed->perm_url}}">
                                {{$relate->newsfeed->feed_title}}
                            </a>
                        </h3>

                        <p class="simple-share">
                            <span class="article-date"><i class="fa fa-clock-o"></i>{{human_time_diff($relate->newsfeed->created_at)}}</span>
                        </p>
                    </header>
                </article>
            </div>
            @endforeach


        </div>
        <!-- .row -->

    </div>
    @endif
    <!-- .related-post -->
    <!-- Mid ad -->
    <div class="row">
        <div class="col-md-12">
            <div class="ad728-wrapper mid-wrapper">
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
    <!-- End Mid ad -->
    <!-- Comment List -->
    <div>
        <div id="disqus_thread"></div>
        <script>
            /**
             * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
             */

            var disqus_config = function () {
                this.page.url = "http://latestng.com/{!!$content->id!!}/{!!$content->perm_url!!}" // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = "latestng/{!!$content->id!!}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            (function () { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = '//latestng.disqus.com/embed.js';

                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript"
                                                          rel="nofollow"></a></noscript>
    </div>

</div>
<!-- End Left big column -->

<div class="col-md-4" data-stickycolumn>
    <aside class="sidebar clearfix">

        <div class="widget adwidget">
            <div id='div-gpt-ad-1468910906855-0'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1468910906855-0'); });
                </script>
            </div>
        </div>

        <div class="widget searchwidget">
            <form class="searchwidget-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
                </div>
            </form>
        </div>

        <div class="widget tabwidget">
            <ul class="nav nav-tabs" role="tablist" id="widget-tab">
                <li role="presentation" class="active"><a href="#tab-popular" aria-controls="tab-popular" role="tab"
                                                          data-toggle="tab">Popular</a></li>
                <li role="presentation"><a href="#tab-recent" aria-controls="tab-recent" role="tab" data-toggle="tab">Recent</a>
                </li>
                <li role="presentation"><a href="#tab-comments" aria-controls="tab-comments" role="tab"
                                           data-toggle="tab">Trending</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab-popular">

                    @foreach($popular as $lat)
                    @if($lat->image_url == null)
                    <article class="widget-post clearfix">
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-eye"></i> {{$lat->read_counter}}</span>
                            </p>
                        </header>
                    </article>
                    @else
                    <article class="widget-post clearfix">
                        <div class="simple-thumb">
                            <a href="#">
                                <img src="{{$lat->image_url}}" alt="">
                            </a>
                        </div>
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-eye"></i> {{$lat->read_counter}} views</span></p>
                        </header>
                    </article>
                    @endif
                    @endforeach

                </div>
                <!-- Popular posts -->
                <div role="tabpanel" class="tab-pane" id="tab-recent">

                    @foreach($latest as $lat)
                    @if($lat->image_url == null)
                    <article class="widget-post clearfix">
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-clock-o"></i> {{human_time_diff($lat->created_at)}}</span>
                            </p>
                        </header>
                    </article>
                    @else
                    <article class="widget-post clearfix">
                        <div class="simple-thumb">
                            <a href="#">
                                <img src="{{$lat->image_url}}" alt="">
                            </a>
                        </div>
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-clock-o"></i> {{human_time_diff($lat->created_at)}}</span>
                            </p>
                        </header>
                    </article>
                    @endif
                    @endforeach

                </div>
                <!-- Recent Posts -->

                <div role="tabpanel" class="tab-pane" id="tab-comments">
                    @foreach($trending as $lat)
                    @if($lat->image_url == null)
                    <article class="widget-post clearfix">
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-clock-o"></i> {{human_time_diff($lat->created_at)}}</span>
                            </p>
                        </header>
                    </article>
                    @else
                    <article class="widget-post clearfix">
                        <div class="simple-thumb">
                            <a href="#">
                                <img src="{{$lat->image_url}}" alt="">
                            </a>
                        </div>
                        <header>
                            <h3>
                                <a href="/{{$lat->id}}/{{$lat->perm_url}}">{{$lat->feed_title}}</a>
                            </h3>

                            <p class="simple-share">
                                <span><i class="fa fa-clock-o"></i> {{human_time_diff($lat->created_at)}}</span>
                            </p>
                        </header>
                    </article>
                    @endif
                    @endforeach
                </div>
                <!-- Comments -->
            </div>
        </div>

        <!-- End review widget -->

        <div class="widget categorywidget">
            <h3 class="block-title"><span>Categories</span></h3>
            <ul>
                @foreach($categories as $categorie)
                <li>
                    <a href="/category/{{$categorie->category->category}}">{{$categorie->category->category}} <span
                            class="count">{{$categorie->count}}</span></a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="widget adwidget subscribewidget">
            <h3 class="block-title"><span>Subscribe</span></h3>

            <p>The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>

            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter your email">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Subscribe</button>
          </span>
                </div>
            </form>
        </div>

    </aside>
</div>
<!-- End last column -->
</div>
<!-- .blog-content -->

</div>
<!-- .main-content -->

<!-- End Main Banner -->
<!-- End Main Banner -->
</div>
<!-- .main-wrapper -->

<!-- Footer -->
<footer class="footer source-org vcard copyright clearfix" id="footer" role="contentinfo">
    <div class="footer-bottom clearfix">
        <div class="fixed-main">
            <div class="container">
                <div class="mag-content">
                    <div class="row">
                        <div class="social-icons">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-rss"></i></a>
                        </div>
                        <p>Copyright Latestng.com © {{date('Y')}}. All Rights Reserved. Powered by <a
                                href="http://www.femtosh.com/"
                                target="_blank"> Femtosh Solutions Limited</p>


                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

</div><!-- End Main -->

<!-- Mobile Menu -->
@include('front.mobilemenu')
<!-- / Mobile Menu -->
<div id="go-top-button" class="fa fa-angle-up" title="Scroll To Top"></div>

<div class="mobile-overlay" id="mobile-overlay"></div>


<!-- Style Customizer -->


<!-- Jquery js -->

<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>


<!-- Modernizr -->

<script src="{{asset('js/modernizr.min.js')}}"></script>


<!-- Bootstrap js -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Google map api -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>


<!-- Theme js -->
<script src="{{asset('js/script.min.js')}}"></script>

</body>


</html>