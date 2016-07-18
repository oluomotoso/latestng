<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Latestng.com {{$category[0]->category}} channel.</title>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta property="fb:pages" content="1450381468590171"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Latestng.com {{$category[0]->category}} channel"/>
    <meta property="og:site_name" content="LATESTNG.COM"/>
    <meta name="keywords" content="{{$category[0]->tags}}"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
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
                    [300, 250]
                ]).build();
            googletag.defineSlot('/32742566/latesng-001', [
                [970, 90],
                [728, 90],
                [320, 50],
                [468, 60],
                [300, 250]
            ], 'div-gpt-ad-1462518072619-0').defineSizeMapping(leaderboard).addService(googletag.pubads());
            googletag.defineSlot('/32742566/latestng-002', [
                [970, 90],
                [728, 90],
                [320, 50],
                [468, 60],
                [300, 250]
            ], 'div-gpt-ad-1443992445377-1').defineSizeMapping(leaderboard).addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().enableAsyncRendering();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
        });
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-9946990192994306",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
@include('front.header')
<!-- .header-wrapper -->
<div class="container main-wrapper">

<!-- End Main Banner -->
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
<div class="main-content mag-content clearfix" data-stickyparent>

<div class="row blog-content">
<div class="col-md-8">
    <h3 class="block-title"><span>Latest</span></h3>
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
        $from=strtotime($from);
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
    @foreach($contents as $content)
    @if($content->newsfeed->image_url == null)
    <article class="simple-post simple-big clearfix">
        <header>
            <p class="simple-share">
                <span><i class="fa fa-clock-o"></i> {{human_time_diff($content->newsfeed->created_at)}}</span>
            </p>

            <h3>
                <a href="/{{$content->newsfeed->id}}/{{$content->newsfeed->perm_url}}">{{$content->newsfeed->feed_title}}</a>
            </h3>

            <p class="excerpt">
                {{$content->newsfeed->feed_description}}
            </p>
        </header>
    </article>
    @else
    <article class="simple-post simple-big clearfix">
        <div class="simple-thumb">

            <a href="/{{$content->newsfeed->id}}/{{$content->newsfeed->perm_url}}">
                <img src="{{$content->newsfeed->image_url}}" alt="">
            </a>
        </div>
        <header>
            <p class="simple-share">
                <span><i class="fa fa-clock-o"></i> {{human_time_diff($content->newsfeed->created_at)}}</span>
            </p>

            <h3>
                <a href="/{{$content->newsfeed->id}}/{{$content->newsfeed->perm_url}}">{{$content->newsfeed->feed_title}}</a>
            </h3>

            <p class="excerpt">
                {{$content->newsfeed->feed_description}}
            </p>
        </header>
    </article>
    @endif
    @endforeach

    <div class="load-more">
        <button type="button" class="btn btn-lg btn-block">Load more</button>
    </div>

</div>
<!-- End Left big column -->

<div class="col-md-4" data-stickycolumn>
<aside class="sidebar clearfix">


<div class="mag-content clearfix">
    <div class="row">
        <div class="col-md-12">
            <div class="ad728-wrapper">
                ADS
            </div>
        </div>
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

<div class="widget tagwidget">
    <h3 class="block-title"><span>Tags</span></h3>
    <ul class="tags-widget">
        @foreach($tags as $tag)
        <li><a href="/tag/{{$tag}}">{{$tag}}</a></li>
        @endforeach
    </ul>
</div>


<!-- End review widget -->

<div class="widget categorywidget">
    <h3 class="block-title"><span>Categories</span></h3>
    <ul>
        @foreach($categories as $categorie)
        <li>
            <a href="category/{{$categorie->category->category}}">{{$categorie->category->category}} <span class="count">{{$categorie->count}}</span></a>
        </li>
        @endforeach
    </ul>
</div>
</aside>
</div>
<!-- End last column -->
</div>
<!-- .main-body -->

</div>
<!-- .main-content -->

<!-- End Main Banner -->

<!-- End Main Banner -->
<!-- End Footer -->
<!-- /32742566/latesng-001 -->
<div class="mag-content clearfix">
    <div class="row">
        <div class="col-md-12">
            <div class="ad728-wrapper">
                <div id='div-gpt-ad-1443992445377-1'>
                    <script type='text/javascript'>
                        googletag.cmd.push(function () {
                            googletag.display('div-gpt-ad-1443992445377-1');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- .main-wrapper -->



</div>
<!-- End Main -->

@include('front.mobilemenu')
<!-- / Mobile Menu -->
<div id="go-top-button" class="fa fa-angle-up" title="Scroll To Top"></div>

<div class="mobile-overlay" id="mobile-overlay"></div>


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


<!-- Mirrored from digitaltheme.co/html/admag/demo/blog_modern.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2016 11:35:01 GMT -->
</html>