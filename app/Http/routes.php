<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['domain' => 'news.latestng.com'], function () {

    Route::get('/content', 'content_controller@ViewHomePageFeeds');
    Route::get('/content', 'content_controller@ViewHomePageFeeds');
    Route::get('/', 'content_controller@ViewHomePage');
    Route::get('/new', 'content_controller@ViewHomePage');
    Route::get('/test', 'fetch_controller@Test');
    Route::get('/home', 'content_controller@ViewHomePage');
//Authentication Routes
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('autopost_to_facebook', 'facebook_controller@PostToFacebookEdge');
    Route::get('/{id}/{title?}', 'content_controller@DisplayFullNewsContent')->name('articles.show');
    Route::post('{id}/comments', 'content_controller@PostComment')->name('articles.comment');
    Route::post('comments/{id}/reply', 'content_controller@PostCommentReply')->name('comments.reply');
    Route::get('us/{id}/{title?}', 'content_controller@DisplayFullNewsContent');
    Route::get('ng/{id}/{title?}', 'content_controller@DisplayFullNewsContent');
    Route::get('feeds.php', 'content_controller@RedirectOldestRoute');
    Route::get('sitemap', function () {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled

        // check if there is cached sitemap and build new only if is not

        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('https://www.latestng.com'), date('Y m d H:i:s', time()), '1.0', 'hourly');
        // get all posts from db
        $posts = DB::table('news_feed')->orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($posts as $post) {
            $sitemap->add('https://www.latestng.com/' . $post->id . '/' . $post->perm_url, $post->updated_at, 0.9, 'monthly');
        }


        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');

    });

});
Route::group(['domain' => 'autopost.latestng.com'], function () {
    Route::get('/', 'Auth\AuthController@GetCreateUser');
    Route::post('/register', 'Auth\AuthController@AutopostReg');
    Route::get('/dashboard', 'autoposter\autoposter@Dashboard');
    Route::get('add-facebook', 'autoposter\autoposter@redirectToProvider');
    Route::get('add-facebook2', 'autoposter\autoposter@redirectToFacebook2');
    Route::get('add-facebook/callback', 'autoposter\autoposter@handleProviderCallback');

});
Route::get('/content', 'content_controller@ViewHomePageFeeds');
Route::get('/', 'content_controller@ViewHomePage');
Route::get('/new', 'content_controller@ViewHomePage');
Route::get('/search', 'content_controller@DoSearch');
Route::get('/test', 'fetch_controller@Test');
Route::get('/home', 'content_controller@ViewHomePage');
//Authentication Routes
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('autopost_to_facebook', 'facebook_controller@PostToFacebookEdge');
Route::get('sitemap', function () {

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled

    // check if there is cached sitemap and build new only if is not

    // add item to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('https://www.latestng.com'), date('Y m d H:i:s', time()), '1.0', 'hourly');
    // get all posts from db
    $posts = DB::table('news_feed')->orderBy('created_at', 'desc')->get();

    // add every post to the sitemap
    foreach ($posts as $post) {
        $sitemap->add('https://www.latestng.com/' . $post->id . '/' . $post->perm_url, $post->updated_at, 0.9, 'monthly');
    }


    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

//Administrator
Route::get('admin', [
    'middleware' => 'auth',
    'uses' => 'admin_controller@index'
]);

Route::post('admin/add_user_role',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@CreateUserRole']);
Route::get('admin/add_user_role',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@AddRole']);

//Registration routes...
Route::get('admin/add_user',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetCreateUser']);
Route::post('admin/add_user',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostCreateUser']);

//Channels Routes
Route::get('admin/create_channel',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetCreateChannel']);
Route::post('admin/create_channel',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostCreateChannel']);
//Facebook Links
Route::get('admin/add_facebook_link',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetFacebookLink']);
Route::post('admin/add_facebook_link',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostFacebookLink']);

//Create Post
Route::get('admin/create_post',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetCreatePost']);

Route::post('admin/create_post',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostCreatePost']);
Route::post('admin/edit_html',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetHtmlContentsFromUrl']);
Route::get('admin/edit_html',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@HtmlContentsFromUrl']);

Route::post('admin/create_facebook_edge',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostFacebookEdge']);

//Manage Pending Post
Route::get('admin/manage_pending_post',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@GetIndex']
);
Route::get('admin/manage_facebook_accounts',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetFacebookAccounts']
);
Route::post('admin/manage_facebook_accounts',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@ManageFacebookAccounts']
);
Route::get('admin/manage-sources',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@ContentSource']
);
Route::post('admin/manage-sources',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostContentSources']
);
Route::post('admin/manage-source',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostContentSource']
);
//Manage Published post
Route::get('admin/manage_published_post',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@GetPublishedIndex']
);
Route::get('admin/response_data',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@CheckEdgeResponseData']
);
Route::get('admin/pending_data',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@PendingData']
);
Route::get('admin/published_data',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@PublishedData']
);
Route::get('admin/check_edge_response',
    ['middleware' => 'auth',
        'uses' => 'DatatablesController@GetResponseInfo']
);
/*Route::post('admin/create_post',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostManagePendingCreatePost']);
*/

Route::get('admin/create_category',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetCreateCategory']);

Route::post('admin/create_category',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostCreateCategory']);

Route::get('fetch', 'fetch_controller@FetchAll');
Route::get('publish', 'fetch_controller@PublishContentAutomatically');
Route::get('update_edges', 'facebook_controller@UpdateGroupInformation');

Route::get('admin/edit_facebook_edge/{id}',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetEditFacebookEdge'
    ]);
Route::get('admin/manage_facebook_edge',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@ManageFacebookEdge'
    ]);
Route::get('admin/facebook_accounts',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@ManageFacebook'
    ]);
Route::post('admin/edit_facebook_edge',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PostEditFacebookEdge'
    ]);

Route::get('admin/edit_pending_post/{id}',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetEditPendingPost'
    ]);

Route::get('admin/edit_published_post/{id}',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@GetEditPublishedPost'
    ]);

Route::post('admin/edit_pending_post',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@UpdateEditedPost'
    ]);
Route::post('admin/edit_published_post',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@UpdatePublishedPost'
    ]);
Route::post('admin/publish',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@PublishPendingPost'
    ]);
Route::post('admin/approve_facebook_user',
    ['middleware' => 'auth',
        'uses' => 'admin_controller@ApproveFacebookUser'
    ]);
Route::group(['prefix' => 'category'], function () {

    Route::get('/{category}', 'content_controller@DisplayCategory');
});
Route::group(['prefix' => 'tags'], function () {

    Route::get('/{category}', 'content_controller@DisplayTags');
});
Route::get('facebook_login', 'facebook_controller@FacebookLogin');
Route::get('facebook', 'facebook_controller@FacebookRedirectLogin');
Route::get('/{id}/{title?}', 'content_controller@DisplayFullNewsContent');






