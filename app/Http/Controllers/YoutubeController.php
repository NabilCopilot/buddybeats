<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;

class YouTubeController extends Controller
{
    
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        //TODO: contemplar las credenciales de otra manera
        $this->client->setAuthConfig('../client_secret_778437167428-j5pmpg4p37jmjfipoigcikbmqgs468p7.apps.googleusercontent.com.json');        $this->client->setRedirectUri(route('youtube.callback'));
        $this->client->setScopes([
            'https://www.googleapis.com/auth/youtube.readonly',
        ]);
    }

    public function auth()
    {
        if (session('youtube_access_token')) {
            return redirect('/youtube/playlists');
        }

        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        $this->client->authenticate($request->input('code'));
        $accessToken = $this->client->getAccessToken();
        $expiresIn = $this->client->getAccessToken()['expires_in'];
        session([
            'youtube_access_token' => $accessToken,
            'youtube_expires_at' => now()->addSeconds($expiresIn),
        ]);

        return redirect('/youtube/playlists');
    }

    public function getPlaylists()
    {
        if (now() >= session('youtube_expires_at')) {
            session()->forget('youtube_access_token');
            session()->forget('youtube_expires_at');
            return redirect('/youtube/auth');
        }

        $this->client->setAccessToken(session('youtube_access_token'));
        $youtube = new Google_Service_YouTube($this->client);

        $queryParams = [
            'mine' => true,
            'maxResults' => 50,
        ];

        $playlists = $youtube->playlists->listPlaylists('snippet,contentDetails', $queryParams);

        return view('youtube.playlists', compact('playlists'));
    }

    public function getPlaylistVideos($id)
{
    $this->client->setAccessToken(session('youtube_access_token'));
    $youtube = new Google_Service_YouTube($this->client);

    $queryParams = [
        'maxResults' => 50,
        'playlistId' => $id,
    ];

    $playlistItems = $youtube->playlistItems->listPlaylistItems('snippet,contentDetails', $queryParams);

    return view('youtube.songs', compact('playlistItems'));
}


}
