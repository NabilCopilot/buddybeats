<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Google_Service_YouTube;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/youtube.readonly'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('google.redirect');
        }

        $googleClient = new Google_Client();
        $googleClient->setAccessToken($user->token);
        $youtube = new Google_Service_YouTube($googleClient);

        $playlists = $youtube->playlists->listPlaylists('id,snippet', [
            'mine' => true,
            'maxResults' => 10,
        ]);

        return view('youtubePlaylists', compact('playlists'));
    }
}

