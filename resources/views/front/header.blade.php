<!-- Google Tag Manager -->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-5FJ36N"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5FJ36N');</script>
<!-- End Google Tag Manager -->
<div id="main" class="fixed-sidebar fixed-left-sidebar">

<header class="header fixed-sidebar-header" id="header">
<div class="container">
<div class="mag-content">
<div class="row">
<div class="col-sm-12">
<!-- Mobile Menu Button -->
<a class="navbar-toggle collapsed" id="nav-button" href="#mobile-nav">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a><!-- .navbar-toggle -->

<!-- Main Nav Wrapper -->
<nav class="navbar mega-menu">
<a class="logo" href="{{url('/')}}" title="Latestng.com - Latest news and grooves" rel="home">
    <span>latestng</span>
</a><!-- .logo -->

<!-- Navigation Menu -->
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li class="dropdown menu-color1">
    <a href="{{url('/')}}" role="button" aria-expanded="false">Home</a>
</li>
<!-- .dropdown .menu-color1 -->

<!-- Fullwith Mega Menu -->
<!-- Mega Menu -->
<li class="dropdown mega-full menu-color5">
    <a href="{{url('/category/entertainment')}}" class="dropdown-toggle" data-toggle="dropdown" role="button"
       aria-expanded="false">Entertainment</a>
    <ul class="dropdown-menu fullwidth">
        <li>
            <!-- 5 block news in Mega Menu -->
            <div class="mega-menu-5block">
                @foreach($entertainments as $entertainment)
                @if($entertainment->newsfeed->image_url == null)
                <div class="mega-menu-news">
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @else
                <div class="mega-menu-news">
                    <div class="mega-menu-img">
                        <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">
                            <img class="entry-thumb" src="{{$entertainment->newsfeed->image_url}}" alt="">
                        </a>
                    </div>
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- .mega-menu-news -->

                <!-- .mega-menu-news -->

            </div>
            <!-- .mega-menu-5block -->
        </li>
    </ul>
    <!-- .dropdown-menu .fullwidth -->
</li>
<!-- .dropdown .mega-full .menu-color5 -->
<!-- End Mega Menu -->

<!-- Dropdown List Menu -->
<!-- List Menu -->
<li class="dropdown mega-full menu-color4">
    <a href="{{url('/category/business')}}" class="dropdown-toggle" data-toggle="dropdown" role="button"
       aria-expanded="false">Business</a>
    <ul class="dropdown-menu fullwidth">
        <li>
            <!-- 5 block news in Mega Menu -->
            <div class="mega-menu-5block">
                @foreach($business as $entertainment)
                @if($entertainment->newsfeed->image_url == null)
                <div class="mega-menu-news">
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @else
                <div class="mega-menu-news">
                    <div class="mega-menu-img">
                        <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">
                            <img class="entry-thumb" src="{{$entertainment->newsfeed->image_url}}" alt="">
                        </a>
                    </div>
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- .mega-menu-news -->

                <!-- .mega-menu-news -->

            </div>
            <!-- .mega-menu-5block -->
        </li>
    </ul>
    <!-- .dropdown-menu .fullwidth -->
</li>
<!-- List Menu -->
<li class="dropdown mega-full menu-color4">
    <a href="{{url('/category/politics')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Politics</a>
    <ul class="dropdown-menu fullwidth">
        <li>
            <!-- 5 block news in Mega Menu -->
            <div class="mega-menu-5block">
                @foreach($politics as $entertainment)
                @if($entertainment->newsfeed->image_url == null)
                <div class="mega-menu-news">
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @else
                <div class="mega-menu-news">
                    <div class="mega-menu-img">
                        <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">
                            <img class="entry-thumb" src="{{$entertainment->newsfeed->image_url}}" alt="">
                        </a>
                    </div>
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- .mega-menu-news -->

                <!-- .mega-menu-news -->

            </div>
            <!-- .mega-menu-5block -->
        </li>
    </ul>
    <!-- .dropdown-menu .fullwidth -->
</li>
<li class="dropdown mega-full menu-color4">
    <a href="{{url('/category/health')}}" class="dropdown-toggle" data-toggle="dropdown" role="button"
       aria-expanded="false">Health</a>
    <ul class="dropdown-menu fullwidth">
        <li>
            <!-- 5 block news in Mega Menu -->
            <div class="mega-menu-5block">
                @foreach($health as $entertainment)
                @if($entertainment->newsfeed->image_url == null)
                <div class="mega-menu-news">
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @else
                <div class="mega-menu-news">
                    <div class="mega-menu-img">
                        <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">
                            <img class="entry-thumb" src="{{$entertainment->newsfeed->image_url}}" alt="">
                        </a>
                    </div>
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- .mega-menu-news -->

                <!-- .mega-menu-news -->

            </div>
            <!-- .mega-menu-5block -->
        </li>
    </ul>
    <!-- .dropdown-menu .fullwidth -->
</li>
<!-- .dropdown .mega-full .menu-color4 -->
<li class="dropdown mega-full menu-color4">
    <a href="{{url('/category/science')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Science
        & Tech</a>
    <ul class="dropdown-menu fullwidth">
        <li>
            <!-- 5 block news in Mega Menu -->
            <div class="mega-menu-5block">
                @foreach($techs as $entertainment)
                @if($entertainment->newsfeed->image_url == null)
                <div class="mega-menu-news">
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @else
                <div class="mega-menu-news">
                    <div class="mega-menu-img">
                        <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">
                            <img class="entry-thumb" src="{{$entertainment->newsfeed->image_url}}" alt="">
                        </a>
                    </div>
                    <div class="mega-menu-detail">
                        <h4 class="entry-title">
                            <a href="/{{$entertainment->newsfeed->id}}/{{$entertainment->newsfeed->perm_url}}">{{$entertainment->newsfeed->feed_title}}</a>
                        </h4>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- .mega-menu-news -->

                <!-- .mega-menu-news -->

            </div>
            <!-- .mega-menu-5block -->
        </li>
    </ul>
    <!-- .dropdown-menu .fullwidth -->
</li>
<!-- .dropdown .mega-full .menu-color4 -->
<li class="dropdown menu-color1">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Others</a>
    <ul class="dropdown-menu">
        @foreach($others as $other)
        <li>
            <a href="category/{{$other->category->category}}">{{$other->category->category}}</a>
        </li>
        @endforeach
    </ul>
    <!-- dropdown-menu -->
</li>
<!-- .dropdown .menu-color1 -->
<!-- End Dropdown List Menu -->

</ul>
<!-- .nav .navbar-nav -->
</div>
<!-- .navbar-collapse -->              <!-- End Navigation Menu -->

<div class="header-right">
    <div class="social-icons">
        <a href="http://fb.com/latestng" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook fa-lg"></i></a>
        <a href="http://twitter.com/latestngcom" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                class="fa fa-twitter fa-lg"></i></a>
        <a href="http://instagram.com/latestngcom" data-toggle="tooltip" data-placement="bottom" title="Instagram+"><i
                class="fa fa-instagram fa-lg"></i></a>
        <!-- Only for Fixed Sidebar Layout -->
        <a href="#" class="fixed-button navbar-toggle" id="fixed-button">
            <i></i>
            <i></i>
            <i></i>
            <i></i>
        </a><!-- .fixed-button -->
    </div>
    <!-- .social-icons -->
</div>
<!-- .header-right -->

</nav>
<!-- .navbar -->

<div id="sb-search" class="sb-search">
    <form>
        <input class="sb-search-input" placeholder="Enter your search text..." type="text" value="" name="search"
               id="search">
        <input class="sb-search-submit" type="submit" value="">
        <span class="sb-icon-search fa fa-search" data-toggle="tooltip" data-placement="bottom" title="Search"></span>
    </form>
</div>
<!-- .sb-search -->          </div>
</div>
</div>
</div>
</header>
<!-- .header -->