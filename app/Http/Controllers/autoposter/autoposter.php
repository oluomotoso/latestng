<?php

namespace newsbook\Http\Controllers\autoposter;

use Laravel\Socialite\Facades\Socialite;
use newsbook\Http\Controllers\Controller;
use newsbook\Http\Requests;

class autoposter extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.basic');

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
        $user = Socialite::driver('facebook')->user();

        // $user->token;
    }

}
