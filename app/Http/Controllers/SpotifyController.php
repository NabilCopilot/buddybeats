<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\SpotifyService;

class SpotifyController extends Controller
{

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function showPlaylists(Request $request)
    {
        $accessToken = session('spotify_access_token');
        $spotifyService = new SpotifyService($accessToken);

        $playlists = $spotifyService->getUserPlaylists();

        session(['playlists' => $playlists]);

        return view('spotify.playlists', ['playlists' => $playlists]);
    }

    public function showPlaylistTracks(Request $request, $id)
    {
        $playlists = session('playlists');
        $playlist = collect($playlists)->firstWhere('id', $id);

        $accessToken = session('spotify_access_token');
        $spotifyService = new SpotifyService($accessToken);

        $tracks = $spotifyService->getPlaylistTracks($id);

        return view('spotify.songs', ['tracks' => $tracks, 'playlist' => $playlist]);
    }



}