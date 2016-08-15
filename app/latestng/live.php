<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 7/29/16
 * Time: 12:48 PM
 */

namespace newsbook\latestng;

use newsbook\Http\Requests;
use GuzzleHttp\Client;


class live
{
    protected $client;



    public function newPost()
    {
        $client=new Client(['headers' => ['Authorization' => 'Token 55DxPcRq4Q5uy9RatHG5HQihJedq2FWQAsa2AvKy']]);
        $res = $client->Request('POST', 'http://localhost/flarum/api/discussions');

        echo $res->getBody();

    }
} 