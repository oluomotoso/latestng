<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Latestng.com- Latest news and grooves.</title>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta property="fb:pages" content="1450381468590171"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Latestng.com- Latest news and grooves."/>
    <meta property="og:site_name" content="LATESTNG.COM"/>
    <meta name="keywords"
          content="latest.com, latestng.com,latestng,latest, latest grooves, grooves, news and grooves,Nigeria, Lagos, Abuja, Port Harcourt, breaking news in Nigeria, Boko Haram, PDP, ACN,Buhari, Goodluck Jonathan, Ebola, Quarantine, Shekau, Boko Haram, Chibok, Kunduga, Sambisa, tinubu, nigeria"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
    <meta name="theme-color" content="#3B5999">
    <meta property="og:description"
          content="Best aggregator for the best news and entertainments. for news and grooves."/>
    <meta name="author" content="Olumide Omotoso">
    <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,400italic,500,700,700italic,900"
          rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic" rel="stylesheet"
          type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet" type="text/css">

    <!-- Icon Font -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS -->

    <!-- Theme CSS -->
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            var leaderboard = googletag.sizeMapping().
                addSize([1280, 800], [
                    [970, 90],
                    [728, 90]

                ]).
                addSize([600, 800], [
                    [428, 60]
                ]).
                addSize([800, 600], [
                    [728, 90],
                    [468, 60]
                    ]).
                addSize([0, 0], [
                    [300, 250],
                    [240, 400]
                ]).build();
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
            googletag.defineSlot('/32742566/latesng-001', [
                [970, 90],
                [728, 90],
                [320, 50],
                [468, 60],
                [300, 250]
            ], 'div-gpt-ad-1462518072619-0').defineSizeMapping(leaderboard).addService(googletag.pubads());
            googletag.defineSlot('/32742566/latestng-bottom-leaderboard', [[300, 250], [728, 90], [970, 90], [320, 50], [468, 60]], 'div-gpt-ad-1468910251219-0').defineSizeMapping(leaderboard).addService(googletag.pubads());
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
<div class="sticky-sidebar" id="sticky-sidebar">
    <div class="sticky-sidebar-wrapper">

        <div class="widget tab-widget sticky-content">
            <ul class="nav nav-tabs" role="tablist" id="widget-tab">
                <li role="presentation" class="active"><a href="#latest" aria-controls="latest" role="tab"
                                                          data-toggle="tab">Latest</a></li>
                <li role="presentation"><a href="#popular" aria-controls="popular" role="tab"
                                           data-toggle="tab">Popular</a></li>
                <li role="presentation"><a href="#trending" aria-controls="trending" role="tab"
                                           data-toggle="tab">Rising</a>
                </li>
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active animated fadeIn" id="latest">
                    <div class="sticky-scroll">
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

                        <div class="load-more">
                            {{ $latest->links() }}
                        </div>
                    </div>
                </div>
                <!-- Recent Posts -->

                <div role="tabpanel" class="tab-pane animated fadeIn" id="popular">

                    <div class="sticky-scroll">
                        @foreach($popular as $lat)
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

                        <div class="load-more">
                            {{ $popular->links() }}
                        </div>

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane animated fadeIn" id="trending">
                    <div class="sticky-scroll">
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
                        <!-- /32742566/latestng-003 -->


                        <div class="load-more">
                            {{ $trending->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget adwidget">
            <div id='div-gpt-ad-1468910906855-0'>
                <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1468910906855-0'); });
                </script>
            </div>
        </div>
    </div>
</div>

<div class="fixed-main">
    <div class="fixed-main-wrapper main-wrapper">
        <div class="mag-content clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="ad728-wrapper">
                        <div id='div-gpt-ad-1462518072619-0'>
                            <script type='text/javascript'>
                                googletag.cmd.push(function () {
                                    googletag.display('div-gpt-ad-1462518072619-0');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Banner -->
        <div class="row blog-content visible-xs">
            <div class="col-md-12">
        <div class="widget tab-widget sticky-content">
            <ul class="nav nav-tabs" role="tablist" id="widget-tab">
                <li role="presentation" class="active"><a href="#latest" aria-controls="latest" role="tab"
                                                          data-toggle="tab">Latest</a></li>
                <li role="presentation"><a href="#popular" aria-controls="popular" role="tab"
                                           data-toggle="tab">Popular</a></li>
                <li role="presentation"><a href="#trending" aria-controls="trending" role="tab"
                                           data-toggle="tab">Rising</a>
                </li>
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active animated fadeIn" id="latest">
                    <div class="sticky-scroll">
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

                        <div class="load-more">
                            {{ $latest->links() }}
                        </div>
                    </div>
                </div>
                <!-- Recent Posts -->

                <div role="tabpanel" class="tab-pane animated fadeIn" id="popular">

                    <div class="sticky-scroll">
                        @foreach($popular as $lat)
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

                        <div class="load-more">
                            {{ $popular->links() }}
                        </div>

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane animated fadeIn" id="trending">
                    <div class="sticky-scroll">
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
                    <!-- /32742566/latestng-003 -->


                        <div class="load-more">
                            {{ $trending->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div></div></div>
        <!-- End Main Banner -->
        <div class="main-content mag-content clearfix visible-lg visible-md visible-sm">

            <div class="row blog-content">
                <div class="col-md-12">
                    <div class="flexslider slider-one">
                        <div class="featured-slider">

                            <div class="slider-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <article class="featured-big box-news box-big">
                                            <a href="{{$entertainments[0]->newsfeed->id}}/{{$entertainments[0]->newsfeed->perm_url}}">
                                                <img src="{{$entertainments[0]->newsfeed->image_url}}" alt="">
                                            </a>
                                            <header class="featured-header">
                                                <a class="category bgcolor3" href="{{url('/category/entertainment')}}">Entertainment</a>

                                                <h2>
                                                    <a href="{{$entertainments[0]->newsfeed->id}}/{{$entertainments[0]->newsfeed->perm_url}}">{{$entertainments[0]->newsfeed->feed_title}}</a>
                                                </h2>

                                                <p class="simple-share">
                                                    by <a href="#"><b>Olumide Omotoso</b></a> -
                                                    <span class="article-date">{{human_time_diff($entertainments[0]->newsfeed->created_at)}}</span>
                                                </p>
                                            </header>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <!-- .slider-item -->


                            <!-- .slider-item -->

                        </div>
                        <!-- .featured-slider -->
                    </div>
                    <!-- .flexslider .slider-one -->          </div>
            </div>

            <div class="row">
                @foreach($categories as $category)

                <div class="col-md-6">
                    <article class="news-block small-block">
                        <a href="{{$category[0]->newsfeed->id}}/{{$category[0]->newsfeed->perm_url}}"
                           class="overlay-link">
                            <figure class="image-overlay">
                                <img src="{{$category[0]->newsfeed->image_url}}" alt="">
                            </figure>
                        </a>
                        <a href="/category/{{$category[0]->category->category}}" class="category">
                            {{$category[0]->category->category}}
                        </a>
                        <header class="news-details">
                            <h3 class="news-title">
                                <a href="{{$category[0]->newsfeed->id}}/{{$category[0]->newsfeed->perm_url}}">
                                    {{$category[0]->newsfeed->feed_title}}
                                </a>
                            </h3>

                            <p class="simple-share">
                                @if(count($category[0]->newsfeed->editor) >0)
                                by <a href="#"><b>{{$category[0]->newsfeed->editor->username}}</b></a>@endif -
                                <span class="article-date"><i class="fa fa-clock-o"></i> {{human_time_diff($category[0]->newsfeed->created_at)}}</span>
                            </p>
                        </header>
                    </article>
                    <!-- News block -->
                </div>

                @endforeach

            </div>


        </div>
        <!-- .main-content -->

        <!-- End Main Banner -->
        <div class="mag-content clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="ad728-wrapper">
                        <div id='div-gpt-ad-1468910251219-0'>
                            <script type='text/javascript'>
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1468910251219-0'); });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Banner -->
    </div>
    <!-- .main-wrapper -->

    <!-- Footer -->

    <!-- End Footer -->

</div>
<!-- .fixed-main -->

</div>
<!-- End Main -->

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