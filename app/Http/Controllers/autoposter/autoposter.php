<?php

namespace newsbook\Http\Controllers\autoposter;

use Facebook\Facebook;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use newsbook\autopost_models\subscriber_facebook;
use newsbook\autopost_models\subscribers;
use newsbook\Http\Controllers\Controller;
use newsbook\Http\Requests;

class autoposter extends Controller
{
    //
    public $fb;

    public function __construct()
    {
        $this->middleware('auth.basic');

        $this->fb = new Facebook(
            [
                'app_id' => '709163979223052',
                'app_secret' => 'ec61c85c45164ab9a5a605b81d1b4135'
            ]
        );

    }

    public function Dashboard()
    {
        return view('autoposter.user.dashboard');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectToFacebook2()
    {
        return Socialite::driver('facebook')->scopes(['email', 'manage_pages', 'publish_actions', 'publish_pages', 'user_groups', 'user_likes', 'user_managed_groups'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        session_start();
        $logged_user = Auth::user();
        $user = Socialite::driver('facebook')->user();
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;
        $facebbok_user_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $subscriber = subscribers::firstorCreate([
            'user_id' => $logged_user->id
        ]);
        $set_token = $this->fb->getOAuth2Client()->getLongLivedAccessToken($token);
        $set_token = $set_token->getValue();
        $sub = subscriber_facebook::where('facebook_id', $facebbok_user_id)->get();
        if (count($sub) > 0) {
            subscriber_facebook::where('facebook_id', $facebbok_user_id)->update([
                'token' => $token,
                'token_expiry' => $expiresIn

            ]);
            $facebook_subscriber = $sub;
        } else {
            $facebook_subscriber = subscriber_facebook::create([
                'name' => $name,
                'token' => $set_token,
                'refresh_token' => $refreshToken,
                'token_expiry' => $expiresIn,
                'facebook_id' => $facebbok_user_id,
                'email' => $email,
                'subscriber_id' => $subscriber->id
            ]);
        }
        $app_token = 'EAAKEZBxsRsAwBAGgVXVqatXF8YTP6DbsKQ7aZCF7ZC0qjbqVHjdfsvy5p8tX3B6TvrKC2y1aPVZCeTZCEZCdOJWXbaS99WNLpkoIcuNKHQZBhLumaFwbXiHHgncCAZAV5ENZCpDT7AjQKj0phYP2dw5OP';
        $this->fb->post(
            '/709163979223052/roles',
            [
                'user' => $facebbok_user_id,
                'role' => 'testers'


            ], $app_token
        );
        return view('autoposter.user.facebook_welcome', ['facebook' => $facebook_subscriber]);


    }

}
