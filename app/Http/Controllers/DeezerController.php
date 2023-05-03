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

    public function createPlaylist(Request $request)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $playlistTitle = 'My New Playlist';
        $playlistDescription = 'A description of my new playlist';

        $response = $this->client->post('/user/me/playlists', [
            'query' => [
                'access_token' => $accessToken,
                'title' => $playlistTitle,
                'description' => $playlistDescription,
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function addTrackToPlaylist(Request $request)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $playlistId = '11334236044';
        $trackTitle = 'pnl';
        $artistName = 'blanka';

        $trackId = $this->searchTrack($request, $trackTitle, $artistName);

        $response = $this->client->post("/playlist/{$playlistId}/tracks", [
            'query' => [
                'access_token' => $accessToken,
                'songs' => $trackId,
            ]
        ]);

        $result = $response->getStatusCode() === 200;

        if ($result) {
            return ('Track added to playlist!');
        } else {
            return ('Error adding track to playlist.');
        }
    }

    public function searchTrack($request, $trackTitle, $artistName)
    {
        $accessToken = $request->session()->get('deezer_access_token');

        $query = urlencode("{$trackTitle} {$artistName}");
        $response = $this->client->get("/search", [
            'query' => [
                'access_token' => $accessToken,
                'q' => $query,
            ]
        ]);

        $searchResults = json_decode($response->getBody());

        $trackId = $searchResults->data[0]->id ?? null;

        return $trackId;
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
        //convertir a array
        // $playlists = json_decode(json_encode($playlists), true);
        // dd($playlists);

        // Guardar las listas de reproducción en la sesión
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

}
