<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpotifyAuthControllerNEW extends Controller
{

    public function redirectToSpotify()
    {
        $clientId = env('SPOTIFY_CLIENT_ID');
        $redirectUri = urlencode(env('SPOTIFY_REDIRECT_URI_NEW'));
        $scopes = urlencode('playlist-modify-public playlist-modify-private');

        $authUrl = "https://accounts.spotify.com/authorize?client_id={$clientId}&response_type=code&redirect_uri={$redirectUri}&scope={$scopes}";

        return redirect($authUrl);
    }

    public function handleCallback(Request $request)
    {
        $code = $request->input('code');

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => env('SPOTIFY_REDIRECT_URI_NEW'),
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $accessToken = $data['access_token'];
            $refreshToken = $data['refresh_token'];

            $request->session()->put('spotify_access_token', $accessToken);
            $request->session()->put('spotify_refresh_token', $refreshToken);

            return redirect('/home');
        } else {
            return redirect('/error');
        }
    }

    public function refreshAccessToken(Request $request)
    {
        $refreshToken = $request->session()->get('spotify_refresh_token');

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $newAccessToken = $data['access_token'];

            // Actualizar el token de acceso en la sesión
            $request->session()->put('spotify_access_token', $newAccessToken);

            return $newAccessToken;
        } else {
            throw new \Exception('Error al actualizar el token de acceso');
        }
    }

    public function createPlaylist(Request $request)
    {
        $accessToken = $request->session()->get('spotify_access_token');
        $userId = $this->getUserId($accessToken);

        if ($userId) {
            $response = Http::withToken($accessToken)
                ->post("https://api.spotify.com/v1/users/{$userId}/playlists", [
                    //TODO:: esto son valores de entrada, desde la url o el dom??
                    'name' => 'Mi nueva playlist',
                    'description' => 'Esta es una playlist creada desde mi aplicación Laravel',
                    'public' => true,
                ]);

            if ($response->successful()) {
                $playlistData = $response->json();

                dd($playlistData);
                return view('playlist_created', ['playlistData' => $playlistData]);
            } else {
                dd('Error al crear la playlist, manejar este caso');
            }
        } else {
            dd('Error al obtener el ID del usuario, manejar este caso');
        }
    }

    // Funcion para obtener el ID del usuario de Spotify
    private function getUserId($accessToken)
    {
        $response = Http::withToken($accessToken)->get('https://api.spotify.com/v1/me');

        if ($response->successful()) {
            $userData = $response->json();
            return $userData['id'];
        } else {
            return null;
        }
    }

    public function addToPlaylist(Request $request, $playlistId, $artistName, $trackName)
    // TODO: cuando me llegue el artista y la cancion, codificarlos para la url
    //si me llegan varios artistas y nombres, buscar una solucion -> arrays asociativos; cancion => artista
    {
        $accessToken = $request->session()->get('spotify_access_token');
        $trackId = $this->searchTrack($accessToken, $artistName, $trackName);

        if ($trackId) {
            $response = Http::withToken($accessToken)
                ->post("https://api.spotify.com/v1/playlists/{$playlistId}/tracks", [
                    'uris' => ["spotify:track:{$trackId}"],
                ]);

            if ($response->successful()) {
                dd('Canción agregada a la playlist' . $response);
                return view('track_added', ['playlistId' => $playlistId, 'trackId' => $trackId]);
            } else {
                dd('Error al agregar la canción a la playlist, manejar este caso');
            }
        } else {
            dd('No se encontró la canción, manejar este caso');
        }
    }

    private function searchTrack($accessToken, $artistName, $trackName)
    {
        $query = urlencode("artist:{$artistName} track:{$trackName}");
        $type = 'track';

        $response = Http::withToken($accessToken)
            ->get("https://api.spotify.com/v1/search", [
                'q' => $query,
                'type' => $type,
                'limit' => 1,
            ]);

        if ($response->successful()) {
            $searchResults = $response->json();
            $track = $searchResults['tracks']['items'][0] ?? null;

            return $track ? $track['id'] : null;
        } else {
            return null;
        }
    }


}

