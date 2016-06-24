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
                'app_id' => '1397993927197661',
                'app_secret' => 'c6a9ca4c1d3bd3f2b126f6d900fdb236'
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
        $username = $user->getUsername();
        $name = $user->getName();
        $email = $user->getEmail();
        $subscriber = subscribers::firstorNew([
            'user_id' => $logged_user->id
        ]);
        $set_token = $this->fb->getOAuth2Client()->getLongLivedAccessToken($token);
        $set_token = $set_token->getValue();

        $facebook_subscriber = subscriber_facebook::create([
            'name' => $name,
            'token' => $set_token,
            'refresh_token' => $refreshToken,
            'token_expiry' => $expiresIn,
            'facebook_id' => $facebbok_user_id,
            'email' => $email,
            'subscriber_id' => $subscriber->id
        ]);
        $app_token = '709163979223052|jEh2VexXQZZwpFLuUm8DBcwo38s';
        $this->fb->post(
            '/709163979223052/roles',
            [
                'user' => $facebbok_user_id,
                'role' => 'testers',
                $app_token

            ]
        );
        return view('autoposter.user.facebook_welcome', ['facebook'=>$facebook_subscriber]);


    }

}
