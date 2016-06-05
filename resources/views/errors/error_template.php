<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Error Page</title>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Latestng.com-Breaking News in Nigeria, News Headlines in Nigeria, Africa and Worldwide"/>
    <meta property="og:description" content="LATESTNG.COM is the ➨ TOP Nigerian News Aggregation portal, providing comprehensive up-to-date NEWS coverage ➨ Breaking news ➨ Top news headlines from Nigeria, Africa and worldwide."/>
    <meta property="og:site_name" content="LATESTNG.COM"/>
    <meta name="keywords" content="latest.com, latestng.com,latestng,latest, Punch, punchng, naij,Nigeria, Lagos, Abuja, Port Harcourt, breaking news in Nigeria, Boko Haram, PDP, ACN,Buhari, Goodluck Jonathan, Ebola, Quarantine, Adadevoh, Sawyer, First consultant, Shekau, Boko Haram, Chibok, Kunduga, Sambisa" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

</head>

<body>
<div class="wrapper">


    <!-- sidebar -->
    <!-- /sidebar -->

    <!-- main right col -->
    <div class="col-sm-12 col-xs-12" id="main">

        <!-- top nav -->
        <div class="navbar navbar-blue navbar-fixed-top">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand logo">Latestng.com</a>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
                <form class="navbar-form navbar-left">
                    <div class="input-group input-group-sm" style="max-width:360px;">
                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">

                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                </ul>

            </nav>
        </div>
        <!-- /top nav -->

        <div>
            <div class="full col-sm-9">
                @yield('content')
                <!-- content -->
                <!--/row-->

                <div class="row">
                    <div class="col-sm-6">
                        <a href="https://twitter.com/latestngcom">Twitter</a>
                        <small class="text-muted">|</small>
                        <a href="https://facebook.com/latestng">Facebook</a>
                        <small class="text-muted">|</small>
                        <a href="https://plus.google.com/+latestng">Google+</a>
                    </div>
                </div>

                <div class="row" id="footer">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <p>
                            <a href="#" class="pull-right">©Copyright 2015</a>
                        </p>
                    </div>
                </div>

            </div>
            <!-- /col-9 -->
        </div>
        <!-- /padding -->
    </div>
    <!-- /main -->

</div>
<!--post modal-->
<!-- script references -->
<script>
    $.ajax({
            url: "http://localhost:8000/content",
            cache: false
        },
        success(function( html ) {
                $( "#results" ).append( html );
                alert('loaded')
            },
            error:function(exception){alert('Exeption:'+exception);
    })
</script>
<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
@stack('scripts')
</body>
</html>