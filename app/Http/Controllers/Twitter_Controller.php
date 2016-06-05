<?php

namespace newsbook\Http\Controllers;

include_once('codebird.php');

use newsbook\Http\Requests;

class Twitter_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    static function GetInstance()
    {

    }

    public function OluOmotoso()
    {
        \Codebird\Codebird::setConsumerKey('uVLxRuJlmLtGsLAdjxXjA9qFm','hr5VDEVwPULnBCX5uXRWwBEFrFFxWF4boHe60YbtTY5ZQj9Zxv');
        $cb= \Codebird\Codebird::getInstance();
        $cb->setToken('207614662-9Gm3VEASJGYuP8a3oH2KOlT1n5blMpUOrvpSDpnn', 'Vn62y8sQ4X0qOgmbvAvQDPlFcsUAK2CCdT6R8Ux6MXl1K');
        $cb->search_tweets([]);
    }

}
