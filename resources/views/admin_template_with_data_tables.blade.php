<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Latestng.com-Breaking News in Nigeria, News Headlines in Nigeria, Africa and Worldwide</title>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Latestng.com-Breaking News in Nigeria, News Headlines in Nigeria, Africa and Worldwide"/>
    <meta property="og:description" content="LATESTNG.COM is the ➨ TOP Nigerian News Aggregation portal, providing comprehensive up-to-date NEWS coverage ➨ Breaking news ➨ Top news headlines from Nigeria, Africa and worldwide."/>
    <meta property="og:site_name" content="LATESTNG.COM"/>
    <meta name="_TOKEN" content="{{csrf_token()}}">
    <meta name="keywords" content="latest.com, latestng.com,latestng,latest, Punch, punchng, naij,Nigeria, Lagos, Abuja, Port Harcourt, breaking news in Nigeria, Boko Haram, PDP, ACN,Buhari, Goodluck Jonathan, Ebola, Quarantine, Adadevoh, Sawyer, First consultant, Shekau, Boko Haram, Chibok, Kunduga, Sambisa" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="{{asset('css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('css/buttons.bootstrap.min.css')}}"/>


</head>
<body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">


            <!-- sidebar -->
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">

                <ul class="nav">
                    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i
                                class="glyphicon glyphicon-chevron-right"></i></a></li>
                </ul>

                <ul class="nav hidden-xs" id="lg-menu">
                    <h4>Article Management</h4>
                    <li class="nav-divider"></li>
                    <li><a href="{{url('admin/create_post')}}"><i class="glyphicon glyphicon-list-alt"></i> Create Post</a>
                    </li>
                    <li><a href="{{url('admin/edit_html')}}"><i class="glyphicon glyphicon-list-alt"></i> Fetch Post</a>
                    </li>

                    <li><a href="{{url('admin/manage_pending_post')}}"><i class="glyphicon glyphicon-list"></i> Manage Pending Post</a></li>
                    <li><a href="{{url('admin/manage_published_post')}}"><i class="glyphicon glyphicon-paperclip"></i> Manage Published Post</a></li>
                    <li><a href="{{url('admin/create_category')}}"><i class="glyphicon glyphicon-arrow-right"></i> Create Category</a></li>
                    <li><a href="{{url('admin/check_edge_response')}}"><i class="glyphicon glyphicon-arrow-right"></i>Manage Facebook Edge</a></li>
                    <li><a href="{{url('admin/manage-sources')}}"><i class="glyphicon glyphicon-arrow-right"></i>Manage Sources</a></li>
                    <li><a href="{{url('admin/manage_facebook_accounts')}}"><i class="glyphicon glyphicon-arrow-right"></i>Manage Facebook Accounts</a></li>

                    <h4>User Management</h4>
                    <li class="nav-divider"></li>
                    <li><a href="{{('admin/add_user')}}"><i class="glyphicon glyphicon-list-alt"></i> Add User</a>
                    </li>
                    <li><a href="{{('admin/manage_users')}}"><i class="glyphicon glyphicon-list"></i> Manage Users</a></li>
                    <li><a href="{{('admin/add_user_role')}}"><i class="glyphicon glyphicon-paperclip"></i> Manage User Roles</a></li>
                    <h4>Channels Management</h4>
                    <li class="nav-divider"></li>
                    <li><a href="{{('admin/create_channel')}}"><i class="glyphicon glyphicon-list-alt"></i>Create New Channel</a>
                    </li>
                    <li><a href="{{('admin/manage_channels')}}"><i class="glyphicon glyphicon-list"></i> Manage Channels</a></li>
                </ul>
                <!-- tiny only nav-->
                <ul class="nav visible-xs" id="xs-menu">
                    <li><a href="{{('admin/create_post')}}" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                    <li><a href="{{('admin/manage_pending_post')}}" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                    <li><a href="{{('admin/manage_published_post')}}" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                </ul>

            </div>
            <!-- /sidebar -->

            <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">

                <!-- top nav -->
                <div class="navbar navbar-blue navbar-static-top">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="{{url('/')}}" class="navbar-brand logo">Latestng.com</a>
                    </div>
                    <nav class="collapse navbar-collapse" role="navigation">
                        <form class="navbar-form navbar-left">
                            <div class="input-group input-group-sm" style="max-width:360px;">
                                <input type="text" class="form-control" placeholder="Search" name="srch-term"
                                       id="srch-term">

                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i
                                            class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{url('/')}}"><i class="glyphicon glyphicon-home"></i> Home</a>
                            </li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="glyphicon glyphicon-user"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('#')}}">Settings</a></li>
                                    <li><a href="{{url('logout')}}">Logout</a></li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- /top nav -->

                <div class="padding">
                    @yield('content')
                    <div class="full col-sm-9">

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

                        <div class="row" id="footer"></div>
                        <div class="col-sm-6">
                            <p>
                                <a href="https://www.femtosh.com" class="pull-right">Femtosh Global Solutions ©Copyright 2015</a>
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
</div>


<!--post modal-->

<!-- script references -->
<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/buttons.bootstrap.min.js')}}"></script>
<script
@stack('scripts')
</body>
</html>