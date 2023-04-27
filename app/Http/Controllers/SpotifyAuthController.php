<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpotifyAuthController extends Controller
{

    public function redirectToProvider()
    {
        $clientId = config('services.spotify.client_id');
        $redirectUri = urlencode(config('services.spotify.redirect'));
        $scope = urlencode('playlist-read-private');
        $authUrl = "https://accounts.spotify.com/authorize?response_type=code&client_id={$clientId}&scope={$scope}&redirect_uri={$redirectUri}";

        return redirect($authUrl);
    }

    public function handleProviderCallback(Request $request)
    {
        $code = $request->input('code');
        $client = new Client();
        $response = $client->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => config('services.spotify.redirect'),
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(config('services.spotify.client_id') . ':' . config('services.spotify.client_secret')),
            ],
        ]);

        $data = json_decode((string)$response->getBody(), true);
        $accessToken = $data['access_token'];
        $refreshToken = $data['refresh_token'];

        // Almacenar los tokens en la sesión o en la base de datos para su uso posterior
        session([
            'spotify_access_token' => $accessToken,
            'spotify_refresh_token' => $refreshToken,
        ]);

        return redirect('/spotify/playlists');
    }

}
