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
        // $response = $this->client->get("/user/me?access_token={$accessToken}");
        // return json_decode($response->getBody());

        // Obtén todos los datos almacenados en la sesión
        $sessionData = $request->session()->all();
        return $sessionData;
    }

    public function createPlaylist(Request $request, $playlistTitle, $playlistDescription)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $response = $this->client->post('/user/me/playlists', [
            'query' => [
                'access_token' => $accessToken,
                'title' => $playlistTitle,
                'description' => $playlistDescription,
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function addTrackToPlaylist(Request $request, $playlistId, $songsId)
    {
        $accessToken = $request->session()->get('deezer_access_token');
        $success = true;
        $message = 'Canciones añadidas a la playlist con éxito';
    
        foreach ($songsId as $songId) {
            try {
                $response = $this->client->post("/playlist/{$playlistId}/tracks", [
                    'query' => [
                        'access_token' => $accessToken,
                        'songs' => $songId,
                    ],
                ]);
    
                if ($response->getStatusCode() !== 200) {
                    $success = false;
                    $message = 'Error al agregar una o más canciones a la playlist';
                    break;
                }
            } catch (\Exception $e) {
                $success = false;
                $message = 'Error al agregar una o más canciones a la playlist';
                break;
            }
        }
    
        if ($success) {
            return response()->json([
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'message' => $message,
            ], 500);
        }
    }

    public function searchTrack(Request $request, $songs)
    {
        $ids = [];

        foreach ($songs as $cancion) {
            $title = urlencode($cancion['title']);
            $artist = urlencode($cancion['artist']);
            $query = "{$title} {$artist}";
    
            $response = $this->client->get("/search", [
                'query' => [
                    'q' => $query
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
    
            if (isset($data['data'][0])) {
                $ids[] = $data['data'][0]['id'];
            } else {
                $ids[] = null; // Si no se encuentra el ID de la canción, añade un valor null
            }
        }
    
        return $ids;
    }

    public function getUserPlaylists(Request $request)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $response = $this->client->get('/user/me/playlists', [
            'query' => [
                'access_token' => $accessToken,
            ]
        ]);
        $playlists = json_decode($response->getBody())->data;

        $request->session()->put('deezer_playlists', $playlists);

        return view('deezer.playlists', ['playlists' => $playlists]);
    }

    public function getPlaylistTracks(Request $request, $playlistId)
    {
        $accessToken = $request->session()->get('deezer_access_token');
        $storedPlaylists = $request->session()->get('deezer_playlists');

        // Buscar la lista de reproducción específica utilizando el $playlistId
        $selectedPlaylist = null;
        foreach ($storedPlaylists as $playlist) {
            if ($playlist->id == $playlistId) {
                $selectedPlaylist = $playlist;
                break;
            }
        }

        $response = $this->client->get("/playlist/{$playlistId}/tracks", [
            'query' => [
                'access_token' => $accessToken,
            ]
        ]);

        $tracks = json_decode($response->getBody())->data;

        return view('deezer.songs', ['tracks' => $tracks, 'playlist' => $selectedPlaylist]);
    }

    public function sourcePlaylists(Request $request) {
        $accessToken = $request->session()->get('deezer_access_token');

        $response = $this->client->get('/user/me/playlists', [
            'query' => [
                'access_token' => $accessToken,
            ]
        ]);
        $playlists = json_decode($response->getBody())->data;

        return ['playlists' => $playlists];
    }

    public function sourceSongsForTansferForm(Request $request, $playlistId)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $response = $this->client->get("/playlist/{$playlistId}/tracks", [
            'query' => [
                'access_token' => $accessToken,
            ]
        ]);

        $tracks = json_decode($response->getBody())->data;

        return ['tracks' => $tracks];
    }
}
