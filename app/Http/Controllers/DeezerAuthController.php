<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DeezerAuthController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.deezer.com',
        ]);
    }

    public function redirectToDeezer()
    {
        $clientId = env('DEEZER_CLIENT_ID');
        $redirectUri = urlencode(env('DEEZER_REDIRECT_URI'));
        $url = "https://connect.deezer.com/oauth/auth.php?app_id={$clientId}&redirect_uri={$redirectUri}&perms=basic_access,manage_library,delete_library,email";

        return redirect($url);
    }

    public function handleDeezerCallback(Request $request)
    {
        $code = $request->input('code');
        $clientId = env('DEEZER_CLIENT_ID');
        $clientSecret = env('DEEZER_CLIENT_SECRET');
        $redirectUri = urlencode(env('DEEZER_REDIRECT_URI'));

        $response = $this->client->post("https://connect.deezer.com/oauth/access_token.php?app_id={$clientId}&secret={$clientSecret}&code={$code}&output=json");

        $accessToken = json_decode($response->getBody())->access_token;
        $request->session()->put('deezer_access_token', $accessToken);
    }

}
