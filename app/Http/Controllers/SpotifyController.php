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

    public function createPlaylist()
    {
        $accessToken = session('spotify_access_token');
        // $userId = 'your-user-id'; // Reemplaza esto con el ID del usuario de Spotify

        $client = new Client([
            'base_uri' => 'https://api.spotify.com',
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $response = $client->get('/v1/me');
        $userData = json_decode($response->getBody(), true);
        $userId = $userData['id'];

        try {
            $response = $client->post("/v1/users/{$userId}/playlists", [
                'json' => [
                    'name' => 'Nueva Playlist', // Cambia esto al nombre que quieras para la playlist
                    'description' => 'Mi playlist creada a través de la API de Spotify', // Cambia esto al descripción que quieras para la playlist
                ],
            ]);

            $playlistData = json_decode($response->getBody(), true);
            return 'Playlist creada con éxito. ID de la playlist: ' . $playlistData['id'];

        } catch (\Exception $e) {
            return 'Error al crear la playlist: ' . $e->getMessage();
        }
    }

}
