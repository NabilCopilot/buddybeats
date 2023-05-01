<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DeezerController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.deezer.com',
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $response = $this->client->get("/user/me?access_token={$accessToken}");
        return json_decode($response->getBody());
    }

}
