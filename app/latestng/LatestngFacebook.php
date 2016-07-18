<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 5/10/16
 * Time: 7:41 AM
 */

namespace newsbook\latestng;

use Carbon\Carbon;
use DateTime;
use DB;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\GraphObject;
use newsbook\facebook_account;
use newsbook\facebook_edge;
use newsbook\news_feed;

class LatestngFacebook
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public $fb;

    public function __construct()
    {
        $this->fb = new Facebook(
            [
                'app_id' => '1397993927197661',
                'app_secret' => 'c6a9ca4c1d3bd3f2b126f6d900fdb236',
                'default_graph_version' => 'v2.6'
            ]
        );

    }


    public function FacebookLogin()
    {
        session_start();
        $helper = $this->fb->getRedirectLoginHelper();
        echo '<a href="' . $helper->getLoginUrl('https://www.latestng.com/facebook', array('email', 'manage_pages', 'publish_actions', 'publish_pages', 'user_groups', 'user_likes', 'user_managed_groups')) . '">Login</a>';
    }

    public function FacebookRedirectLogin()
    {
        session_start();
        $helper = $this->fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        $oAuth2Client = $this->fb->getOAuth2Client();
        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());

        }
        $token = $accessToken->getValue();
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('/me?fields=id,name,email', $token);
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();
        if (isset($user['email'])) {
            $email = $user['email'];
        } else {
            $email = null;
        }
        if (facebook_account::where('facebook_id', $user->getId())->count() == 0) {
            facebook_account::Create([
                'facebook_id' => $user->getId(),
                'name' => $user['name'],
                'email' => $email,
                'token' => $token,
            ]);
        } else {
            facebook_account::where('facebook_id', $user->getId())->update([
                'token' => $token,
            ]);
        }

    }

    public function GetUserFacebookGroupsInfo()

    {
        $facebook = facebook_account::all();
        foreach ($facebook as $user) {
            $token = $user->token;
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $this->fb->get('' . $user->facebook_id . '/groups', $token);
                $data = $response->getGraphEdge();
                $pagesEdge = $data;
                //$Edge=$this->UpdateGroupInformation();
                do {
                    //var_dump($pagesEdge);


                } while ($pagesEdge = $this->fb->next($pagesEdge));
            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }


        }

    }

    public function UserGroupOperations()
    {
        /*$groups = '';
        foreach ($this->GetUserFacebookGroupsInfo() as $user) {
            $groups .= $user['id'] . ',<br>';
        }
        echo $groups;*/

    }

    function UpdateGroupInformation()
    {
        $groups = array(
            array('no' => 1, 'Group_Name' => 'NATIONAL ASSOCIATON OF ONDO STATE STUDENTS (NATIONAL BODY)', 'Group_Id' => '163596983742455', 'Approval' => 'open'),
            array('no' => 2, 'Group_Name' => 'South West All Progress Congress -  Peoples Forum', 'Group_Id' => '216480641836906', 'Approval' => 'closed'),
            array('no' => 3, 'Group_Name' => 'THE FEDERAL POLYTECHNIC, ADO-EKITI.', 'Group_Id' => '213755391984386', 'Approval' => 'open'),
            array('no' => 4, 'Group_Name' => 'BUHARI FOR NIGERIA PRESIDENT COME 2015', 'Group_Id' => '255734004496390', 'Approval' => 'closed'),
            array('no' => 5, 'Group_Name' => 'NIGERIANS ON FACEBOOK', 'Group_Id' => '92232809394', 'Approval' => 'closed'),
            array('no' => 6, 'Group_Name' => 'Akwa Ibom Political Forum', 'Group_Id' => '811715452217959', 'Approval' => 'open'),
            array('no' => 7, 'Group_Name' => 'Dandalin Siyasar Bauchi', 'Group_Id' => '223379717807517', 'Approval' => 'closed'),
            array('no' => 8, 'Group_Name' => 'BORNO PROJECT', 'Group_Id' => '216825971678768', 'Approval' => 'closed'),
            array('no' => 9, 'Group_Name' => 'CROSS RIVER WATCH', 'Group_Id' => '171096912989582', 'Approval' => 'closed'),
            array('no' => 10, 'Group_Name' => 'KOWANNE GAUTA....... Freedom Radio Kano Nigeria', 'Group_Id' => '399054116802673', 'Approval' => 'closed'),
            array('no' => 11, 'Group_Name' => 'The Federal Polytechnic Ado-Ekiti Student On Facebook.', 'Group_Id' => '624385420907190', 'Approval' => 'open'),
            array('no' => 12, 'Group_Name' => 'NIGERIAN PEOPLES PARLIAMENT', 'Group_Id' => '265276593545022', 'Approval' => 'closed'),


        );
        foreach ($groups as $group) {
            //echo $group['id'].'<br>';
            //$user_count = $this->GetTotalGroupMembers($group['id'], $token);
            facebook_edge::Create([
                'facebook_id' => $group['Group_Id'],
                'name' => $group['Group_Name'],
                'facebook_account_owner' => 5,
                'edge_type' => 'group'


            ]);
        }
    }


    function GetTotalGroupMembers($group, $token)
    {

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('' . $group . '/members', $token);
            $data = $response->getGraphEdge();
            return count($data);

        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }

    function isBetween()
    {
        $input = date("H:i");
        $from = "13:00";
        $till = "15:00";

        $f = DateTime::createFromFormat('!H:i', $from);
        $t = DateTime::createFromFormat('!H:i', $till);
        $i = DateTime::createFromFormat('!H:i', $input);
        if ($f > $t) $t->modify('+1 day');
        return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
    }

    function TimeDifference()
    {
        $current = date("d-m-Y H:i:s");
        $current = date_create($current);
        $task = task::find(1);
        $check = $task->updated_at;
        $diff = date_diff($current, $check);
        echo $diff->h;

    }

    function GetTimeDifference()
    {

        $current = strtotime("now");
        $task = task::find(1);
        $check = $task->updated_at;
        $check = strtotime($check);
        $diff = intval((($current - $check) / 3600));

        return $diff;

    }

    function PostToFacebookPages()
    {
        session_start();
        $to_post = news_feed::where('publish_status', 1)->where('facebook', 0)->take(1)->get();
        if ($to_post == null) {
            return 'Nothing to post';

        } else {
            $to_post_content = $to_post[0];
            $linkData = [
                'message' => $to_post_content->feed_description,
                'link' => 'http://www.latestng.com/' . $to_post_content->id . '/' . $to_post_content->perm_url . ''

            ];
            $edgepage = facebook_account::find(1);
            $edge = facebook_edge::find(1);
            $tokency = $this->fb->get('1450381468590171?fields=access_token', $edgepage->token);
            $graphEdge = $tokency->getGraphNode();
            //var_dump($graphEdge);
            //$data = $tokency->getGraphEdge();
            $token = $graphEdge['access_token'];
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $this->fb->post('/1450381468590171/feed', $linkData, $token);
                $graphNode = $response->getGraphNode();
                facebook_edge::where('id', 1)->update([
                    'response' => $graphNode['id']
                ]);
                news_feed::where('id', $to_post_content->id)->update([
                    'fb_id' => $graphNode['id']
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                    'response' => $e->getMessage()
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                    'response' => $e->getMessage()
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            }
            DB::table('news_feed')->where('id', $to_post_content->id)->increment('facebook');
        }

    }

    public function UpdateCheckPostMetrics()
    {
        session_start();
        try {
            $edgepage = facebook_account::find(1);
            $posts = news_feed::where('publish_status', 1)->where('fb_group', 0)->where('facebook', 1)->where('created_at', '>=', Carbon::now()->subHours(24))->orderBy('id', 'desc')->get();
            foreach ($posts as $post) {
                if ($post->fb_id !== null) {
                    $metrics = $this->fb->get('/' . $post->fb_id . '/' . 'insights/post_impressions_unique', $edgepage->token);
                    $impression = $metrics->getGraphEdge()[0]['values'][0]['value'];
                    $metric2 = $this->fb->get('/' . $post->fb_id . '/' . 'insights/post_consumptions_unique', $edgepage->token);
                    $consumption = $metric2->getGraphEdge()[0]['values'][0]['value'];
                    $total = $impression + $consumption;
                    news_feed::where('id', $post->id)->update([
                        'metrics' => $total
                    ]);
                }else{

                }
            }
            return 'updated';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function PostToFacebookGroups()
    {
        session_start();
        $posted = news_feed::where('fb_group', '>=', 1)->where('created_at', '>=', Carbon::now()->subHours(24))->count();
        //echo($posted);
        if ($posted >= 14) {
            return 'posts have exceeded the maximum ' . $posted . '';
        }
        $post = news_feed::where('fb_group', 0)->where('metrics', '>=', 20)->where('created_at', '>=', Carbon::now()->subHours(24))->orderBy('created_at', 'desc')->limit(1)->get();
        if (count($post) == 0) {
            return 'No post to post';
        }
        $LinkId = explode('_', $post[0]->fb_id);
        $LinkId = $LinkId[1];
        $linkData = [
            'message' => $post[0]->feed_description,
            'link' => 'http://www.latestng.com/' . $post[0]->id . '/' . $post[0]->perm_url . ''

        ];
        /* 'link' => 'https://www.facebook.com/latestng/posts/' . $LinkId . ''*/
        $accounts = facebook_account::with(['edge' => function ($query) {
                $query->where('edge_type', 'group');
            }])->where('availability', 1)->get();
        //echo($accounts);
        DB::table('news_feed')->where('id', $post[0]->id)->increment('fb_group');
        foreach ($accounts as $account) {
            foreach ($account->edge as $edge) {
                try {
                    // Returns a `Facebook\FacebookResponse` object
                    $response = $this->fb->post('/' . $edge->facebook_id . '/feed', $linkData, $account->token);
                    $graphNode = $response->getGraphNode();
                    facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                        'response' => $graphNode['id']
                    ]);
                    DB::table('news_feed')->where('id', $post[0]->id)->increment('shares');

                } catch (FacebookResponseException $e) {
                    facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                        'response' => $e->getMessage()
                    ]);
                    echo 'Graph returned an error: ' . $e->getMessage();
                } catch (FacebookSDKException $e) {
                    facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                        'response' => $e->getMessage()
                    ]);
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                }
            }

        }
        return 'groups post done';

    }

    public function PostToFacebookGroups2()
    {

        session_start();
        $edges = facebook_edge::orderBy('id', 'desc')->get();;
        $to_post = news_feed::where('publish_status', 1)->where('fb_group', 0)->take(1)->get();
        if ($to_share == null) {
            echo('nothing to share');
        } else {
            $linkData = [
                'link' => $to_share[0]->link,
            ];

            foreach ($edges as $edge) {
                $edge_owner = facebook_account::find($edge->facebook_account_owner);
                if ($edge->edge_type == 'group' && $edge_owner->availability == 1) {
                    //$tokency = $this->fb()->get('' . $edge->facebook_id . '?fields=access_token', $edge_owner->token);
                    //$graphEdge = $tokency->getGraphNode();
                    //var_dump($graphEdge);
                    //$data = $tokency->getGraphEdge();
                    /*$token = $graphEdge['access_token'];
                    try {
                        // Returns a `Facebook\FacebookResponse` object
                        $response = $this->fb()->post('/' . $edge->facebook_id . '/feed', $linkData, $token);
                        $graphNode = $response->getGraphNode();
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $graphNode
                        ]);

                    } catch (FacebookResponseException $e) {
                        echo 'Graph returned an error: ' . $e->getMessage();
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $e->getMessage()
                        ]);

                    } catch (FacebookSDKException $e) {
                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $e->getMessage()
                        ]);
                        }

*/
                    try {
                        // Returns a `Facebook\FacebookResponse` object
                        $response = $this->fb->post('/' . $edge->facebook_id . '/feed', $linkData, $edge_owner->token);
                        $graphNode = $response->getGraphNode();
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $graphNode
                        ]);

                    } catch (FacebookResponseException $e) {
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $e->getMessage()
                        ]);
                        echo 'Graph returned an error: ' . $e->getMessage();
                    } catch (FacebookSDKException $e) {
                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                            'response' => $e->getMessage()
                        ]);
                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    }

                }
            }
            DB::table('facebook_links')->where('id', $to_share[0]->id)->increment('facebook');

            exit();

        }

        if ($to_post == null) {
            echo('nothing to post');
            exit();
        } else {
            $to_post_content = $to_post[0];
            $linkData = [
                'message' => $to_post_content->feed_title,
                'link' => 'http://www.latestng.com/' . $to_post_content->id . '/' . $to_post_content->perm_url . ''

            ];
            $edgepage = facebook_account::find(1);
            $tokency = $this->fb()->get('1450381468590171?fields=access_token', $edgepage->token);
            $graphEdge = $tokency->getGraphNode();
            //var_dump($graphEdge);
            //$data = $tokency->getGraphEdge();
            $token = $graphEdge['access_token'];
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $this->fb()->post('/1450381468590171/feed', $linkData, $token);
                $graphNode = $response->getGraphNode();
                facebook_edge::where('id', 1)->update([
                    'response' => $graphNode
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                    'response' => $e->getMessage()
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                    'response' => $e->getMessage()
                ]);
                DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

            }
            /*
                        $LinkId = explode('_', $graphNode);
                        $LinkId = $LinkId[1];
                        $linkData = [
                            'link' => 'https://facebook.com/latestng/posts/' . $LinkId . ''
                        ];

                        foreach ($edges as $edge) {
                            $edge_owner = facebook_account::find($edge->facebook_account_owner);
                            if ($edge->edge_type == 'page' && $edge_owner->availability == 1 && $to_post !== null) {
                                $tokency = $this->fb()->get('' . $edge->facebook_id . '?fields=access_token', $edge_owner->token);
                                $graphEdge = $tokency->getGraphNode();
                                //var_dump($graphEdge);
                                //$data = $tokency->getGraphEdge();
                                $token = $graphEdge['access_token'];
                                try {
                                    // Returns a `Facebook\FacebookResponse` object
                                    $response = $this->fb()->post('/'. $edge->facebook_id .'/feed', $linkData, $token);
                                    $graphNode = $response->getGraphNode();
                                    facebook_edge::where('id', $edge->id)->update([
                                        'response' => $graphNode
                                    ]);
                                    DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

                                } catch (FacebookResponseException $e) {
                                    echo 'Graph returned an error: ' . $e->getMessage();
                                    facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                                        'response' => $e->getMessage()
                                    ]);
                                    DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

                                } catch (FacebookSDKException $e) {
                                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                                    facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                                        'response' => $e->getMessage()
                                    ]);
                                    DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');

                                }
                            } else {

                                if (($edge_owner->availability == 1) && ($to_post_content->affliated_regions == $edge_owner->region_id) && ($to_post !== null)) {

                                    try {
                                        // Returns a `Facebook\FacebookResponse` object
                                        $response = $this->fb()->post('/' . $edge->facebook_id . '/feed', $linkData, $edge_owner->token);
                                        $graphNode = $response->getGraphNode();

                                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                                            'response' => $graphNode
                                        ]);
                                        DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');
                                    } catch (FacebookResponseException $e) {
                                        echo 'Graph returned an error: ' . $e->getMessage();
                                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                                            'response' => $e->getMessage()
                                        ]);
                                        DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');
                                    } catch (FacebookSDKException $e) {
                                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                                        facebook_edge::where('facebook_id', $edge->facebook_id)->update([
                                            'response' => $e->getMessage()
                                        ]);
                                        DB::table('news_feed')->where('id', $to_post_content->id)->increment('shares');
                                    }


                                }


                            }
                        }*/


            DB::table('news_feed')->where('id', $to_post_content->id)->increment('facebook');

        }

    }
}
